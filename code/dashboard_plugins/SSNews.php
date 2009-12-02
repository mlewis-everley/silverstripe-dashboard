<?php

class SSNews extends DashboardPlugin {
	static $position = "left";
	static $sort = 1;
	static $title = "Silverstripe news";
	static $icon = "dashboard/images/22/feed.png";

	/**
	 * @var $rss_url = sets the url of the RSS feed
	 */
	static $rss_url = 'http://www.silverstripe.org/blog/rss';

	/**
	 * Uses SimplePie to pull in the news feed from $rss_url variable, process and cast it, then output it to a DataObjectSet
	 * 
	 * @return DataObjectSet 
	 */
	function LatestSSNews() {
		$sp23 = Director::getAbsFile(SAPPHIRE_DIR . '/thirdparty/simplepie/SimplePie.php');
		$sp24 = Director::getAbsFile(SAPPHIRE_DIR . '/thirdparty/simplepie/SimplePie.inc');
		
		if(file_exists($sp23))
			include_once $sp23;
		elseif(file_exists($sp24))
			include_once $sp24;
		
		$output = new DataObjectSet();
		
		$feed = new SimplePie(self::$rss_url, TEMP_FOLDER);
		$feed->init();
		if($items = $feed->get_items(0, 2)) {
			foreach($items as $item) {
				
				// Cast the Date
				$date = new Date('Date');
				$date->setValue($item->get_date());

				// Cast the Title
				$title = new Text('Title');
				$title->setValue($item->get_title());
				
				// Cast the description and strip
				$desc = new Text('Description');
				$desc->setValue(strip_tags($item->get_description()));

				$output->push(new ArrayData(array(
					'Title'			=> $title,
					'Date'			=> $date,
					'Link'			=> $item->get_link(),
					'Description'	=> $desc
				)));
			}
			return $output;
		}
	}  
}