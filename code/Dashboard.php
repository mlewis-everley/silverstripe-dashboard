<?php
/**
 * The core controller for the actual Dashboard
 */
class Dashboard extends Controller {
	public function SiteInfo() {
		$pages = DataObject::get('SiteTree');
		$pages = $pages ? $pages->Count() : 0;

		$files = DataObject::get('File', "ClassName <> 'Folder'");
		$files = $files ? $files->Count() : 0;
		
		$members = DataObject::get('Member');
		$members = $members ? $members->Count() : 0;

		$output = "$pages pages, $files files, $members members";
		
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

	/**
	 * Return the rendered Dashboard
	 */
	public function forTemplate(){
		return $this->renderWith($this->class);
	}
}

/**
 * Extends CMSMain to add the dashboard method
 */
class Dashboard_Extension extends Extension {
	public function __construct(){
		Requirements::css('dashboard/css/Dashboard.css');
		Requirements::customScript(file_get_contents(Director::baseFolder() . '/dashboard/javascript/Dashboard.js'));
	}
	
	/**
	 * Returns the rendered dashboard
	 */
	public function Dashboard(){
		return singleton('Dashboard');
	}
}