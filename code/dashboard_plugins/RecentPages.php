<?php

class RecentPages extends DashboardPlugin {
	static $position = "snippet";
	static $sort = 0;
	static $title = "Recent pages";
	static $link = "admin/cms/";
	static $limit_count = 10;
	static $caption = "Your site's most recently edited pages.";
	static $null_message = 'You site currently has no pages';
	static $edit_link = 'admin/cms/show';

	public function GenericSnippetList() {
		$result = DataObject::get("SiteTree", NULL, "`LastEdited` DESC", NULL, "0,".self::$limit_count);
		return $result;
	}
}