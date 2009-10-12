<?php

class RecentFiles extends DashboardPlugin {
  static $position = "snippet";
  static $sort = 1;
  static $title = "Recent files";
  static $link = "admin/assets/";

  /**
	 * @var $limit_files = The number of recently edited files that will be displayed
   */
	static $limit_files = 10;

	public function RecentFiles() {
		$pages = DataObject::get("File", "ClassName <> 'Folder'", "`LastEdited` DESC", NULL, "0,".self::$limit_files);
		return $pages;
	}

}