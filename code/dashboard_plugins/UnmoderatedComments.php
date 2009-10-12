<?php

class UnmoderatedComments extends DashboardPlugin
{
  static $position = "full_width";
  static $sort = 2;
  static $title = "Unmoderated comments";
  static $link = "admin/comments/";
  static $icon = "dashboard/images/22/chat.png";
  

  /**
	 * @var $limit_ucomments = The number of unmodderated comments that will appear
   */
	static $limit_ucomments = 10;
  
 	public function CommentUMod() {
		$pages = DataObject::get("PageComment", "NeedsModeration = '1'", "`Created` DESC", NULL, "0,".self::$limit_ucomments);
		return $pages;
	}
}