<?php
 
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
	
	public function SiteInfo() {
		$pages		= DataObject::get('SiteTree');
		$pages		= $pages ? $pages->Count() : 0;
		$pagesStr	= ($pages == 1) ? 'page' : 'pages';

		$files		= DataObject::get('File', "ClassName <> 'Folder'");
		$files		= $files ? $files->Count() : 0;
		$filesStr	= ($files == 1) ? 'file' : 'files';
		
		$members	= DataObject::get('Member');
		$members	= $members ? $members->Count() : 0;
		$membersStr	= ($members == 1) ? 'member' : 'members';

		$output = "$pages $pagesStr<br/>$files $filesStr<br/>$members $membersStr";
		
		return $output;
	}
	
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
}

?>