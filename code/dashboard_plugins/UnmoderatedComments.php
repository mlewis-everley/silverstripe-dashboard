<?php
/**
 * Full width List items have the following general variables available:
 * 
 * $URL
 * $Author
 * $Date
 * $Title
 * $Content
 * 
 */
class UnmoderatedComments extends DashboardPlugin {
	static $position = "full_width";
	static $sort = 1;
	static $title = "Unmoderated comments";
	static $link = "admin/comments/";
	static $limit_count = 10;
	static $icon = "dashboard/images/22/chat.png";
	static $null_message = 'Your site currently has no unmoderated comments';

  
	public function GenericFullWidth() {
		$output = new DataObjectSet();
		
		$items = DataObject::get("PageComment", "NeedsModeration = '1'", "`Created` DESC", NULL, "0,".self::$limit_count);
		
		if($items) {
			foreach($items as $item) {
				$date = new Date('Date');
				$date->setValue($item->Created);
				
				$output->push(new ArrayData(array(
					'URL'		=> $item->CommenterURL,
					'Author'	=> $item->Name,
					'Date'		=> $date,
					'Content'	=> $item->Comment
				)));
			}
		}
		return $output;
	}
}