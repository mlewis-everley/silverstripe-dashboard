<?php
/**
 * Full width List items have the following general variables available:
 * 
 * $URL
 * $Author
 * $Date
 * $Title
 * $Content
 */
class RecentComments extends DashboardPlugin {
	static $position = "full_width";
	static $sort = 0;
	static $title = "Recent comments";
	static $link = "admin/comments/";
	static $limit_count = 10;
	static $icon = "dashboard/images/22/chat.png";
	static $null_message = 'Your site currently has no comments';

  
	public function GenericFullWidth() {
		$output = new DataObjectSet();
		
		$items = DataObject::get("PageComment", "NeedsModeration = '0'", "`Created` DESC", NULL, "0,".self::$limit_count);
		
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