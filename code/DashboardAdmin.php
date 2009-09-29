<?php
 /**
  * Main dashboard class. Auto creates a link in the CMS by being extended from LeftAndMain.
  * 
  * @package Dashboard
  */
class DashboardAdmin extends LeftAndMain {
	static $url_segment = '';
	static $menu_title = 'Dashboard';
	static $menu_priority = 99;
	static $url_priority = 41;

	/**
	 * Initialisation method called before accessing any functionality that RandomLinksAdmin has to offer
	 */
	public function init() {
		parent::init();
		
		Requirements::css('dashboard/css/Dashboard.css');
		Requirements::customScript(file_get_contents(Director::baseFolder() . '/dashboard/javascript/Dashboard.js'));
	}
	
	/**
	 * SiteInfo gets a wuick summary of all items in SiteTree, all Files (excluding folders) and members.
	 * 
	 * @return DataObjectSet
	 */
	public function SiteInfo() {
		$output = new DataObjectSet();
		
		$pages		= DataObject::get('SiteTree');
		$pages		= $pages ? $pages->Count() : 0;
		$pagesStr	= ($pages == 1) ? 'page' : 'pages';
		$output->push(new ArrayData(array(
			'Number' => $pages,
			'Item' => $pagesStr
		)));

		$files		= DataObject::get('File', "ClassName <> 'Folder'");
		$files		= $files ? $files->Count() : 0;
		$filesStr	= ($files == 1) ? 'file' : 'files';
		$output->push(new ArrayData(array(
			'Number' => $files,
			'Item' => $filesStr
		)));
		
		$members	= DataObject::get('Member');
		$members	= $members ? $members->Count() : 0;
		$membersStr	= ($members == 1) ? 'member' : 'members';
		$output->push(new ArrayData(array(
			'Number' => $members,
			'Item' => $membersStr
		)));
		
		return $output;
	}
	
	/**
	 * RecentPages, RecentFiles, CommentUMod all get a list of dataobjects, either 10 most recent pages, 10 most recent files
	 * or 10 most recent unmoderated comments.
	 * 
	 * @return DataObjectSet 
	 */
	public function RecentPages() {
		$pages = DataObject::get("SiteTree", NULL, "`LastEdited` DESC", NULL, "0, 10");
		return $pages;
	}
	
	public function RecentFiles() {
		$pages = DataObject::get("File", "ClassName <> 'Folder'", "`LastEdited` DESC", NULL, "0, 10");
		return $pages;
	}
	
	public function CommentUMod() {
		$pages = DataObject::get("PageComment", "NeedsModeration = '1'", "`Created` DESC", NULL, "0, 10");
		return $pages;
	}
	
	/**
	 * Uses SimplePie to pull in the Silverstripe news feed, process and cast it, then output it to a DataObjectSet
	 * 
	 * @return DataObjectSet 
	 */
	
	function LatestSSNews() {
		$output = new DataObjectSet();
		
		include_once(Director::getAbsFile(SAPPHIRE_DIR . '/thirdparty/simplepie/SimplePie.php'));
		
		$t1 = microtime(true);
		$feed = new SimplePie('http://www.silverstripe.org/blog/rss', TEMP_FOLDER);
		$feed->init();
		if($items = $feed->get_items(0, 2)) {
			foreach($items as $item) {
				
				// Cast the Date
				$date = new Date('Date');
				$date->setValue($item->get_date());

				// Cast the Title
				$title = new Text('Title');
				$title->setValue($item->get_title());
				
				// Cast the description and strip
				$desc = new Text('Description');
				$desc->setValue(strip_tags($item->get_description()));

				$output->push(new ArrayData(array(
					'Title'			=> $title,
					'Date'			=> $date,
					'Link'			=> $item->get_link(),
					'Description'	=> $desc
				)));
			}
			return $output;
		}
	}
}

?>