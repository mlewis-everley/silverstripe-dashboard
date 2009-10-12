<?php

class UnmoderatedComments extends DashboardPlugin {
	static $position = "full_width";
	static $sort = 2;
	static $title = "Unmoderated comments";
	static $link = "admin/comments/";
	static $limit_count = 10;
	static $icon = "dashboard/images/22/chat.png";
	static $null_message = 'Your site currently has no unmoderated comments';

  
	public function GenericFullWidth() {
		$pages = DataObject::get("PageComment", "NeedsModeration = '1'", "`Created` DESC", NULL, "0,".self::$limit_count);
		return $pages;
	}
}