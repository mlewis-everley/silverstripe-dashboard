<?php
/**
 * Snippets have the following generic variables, that can be used in generic templates:
 * 
 * $Title
 * $URL
 * $Date
 * $ID
 */

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
		$output = new DataObjectSet();
		
		$items = DataObject::get("File", "ClassName <> 'Folder'", "`LastEdited` DESC", NULL, "0,".self::$limit_count);
		
		if($items) {
			foreach($items as $item) {
				$date = new Date('Date');
				$date->setValue($item->LastEdited);
				
				$output->push(new ArrayData(array(
					'URL'		=> Director::baseURL().$item->Filename,
					'Title'		=> $item->Title,
					'Date'		=> $date,
					'ID'		=> $item->ID
				)));
			}
		}
		return $output;
	}
}