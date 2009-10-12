<?php

class RecentPages extends DashboardPlugin
{
  static $position = "snippet";
  static $sort = 0;
  static $title = "Recent pages";
  static $link = "admin/cms/";

  /**
	 * @var $limit_pages = The number of recently edited pages that will be displayed
   */
	static $limit_pages = 10;
  
 	public function RecentPages() {
		$pages = DataObject::get("SiteTree", NULL, "`LastEdited` DESC", NULL, "0,".self::$limit_pages);
		return $pages;
	}
}