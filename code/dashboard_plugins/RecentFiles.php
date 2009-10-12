<?php

class RecentFiles extends DashboardPlugin {
	static $position = "snippet";
	static $sort = 1;
	static $title = "Recent files";
	static $link = "admin/assets/";
	static $limit_count = 10;
	static $caption = "Your site's most recently uploaded/edited files.";
	static $null_message = 'Your site currently has no files';
	static $edit_link = 'admin/assets/EditForm/field/Files/item';
	static $edit_popup = TRUE;

	public function GenericSnippetList() {
		$result = DataObject::get("File", "ClassName <> 'Folder'", "`LastEdited` DESC", NULL, "0,".self::$limit_count);
		
		return $result;
	}
}