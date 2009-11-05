<?php
/**
 * Snippets have the following generic variables, that can be used in generic templates:
 * 
 * $Title
 * $URL
 * $Date
 * $ID
 * $EditLink
 * $DeleteLink
 */


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
		$output = new DataObjectSet();
		
		$items = DataObject::get("SiteTree", NULL, "`LastEdited` DESC", NULL, "0,".self::$limit_count);
		
		if($items) {
			foreach($items as $item) {
				$date = new Date('Date');
				$date->setValue($item->LastEdited);
				
				$output->push(new ArrayData(array(
					'URL'			=> Director::baseURL().$item->URLSegment,
					'Title'			=> $item->Title,
					'Date'			=> $date,
					'ID'			=> $item->ID,
					'EditLink'		=> self::$edit_link.'/'.$item->ID
				)));
			}
		}
		return $output;
	}
}