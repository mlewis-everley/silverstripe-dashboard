<?php

class Updates extends DashboardPlugin {
	static $position = "alerts";
	static $sort = 0;

	/**
	 * @var $ss_link = The link to download the latest Silverstripe
	 */
	static $ss_link = 'http://www.silverstripe.org/stable-download/';
	/**
	 * This GenericAlert method screenscrapes the html interface of the silverstripe SVN repo and retrieves the latest
	 * version number, then compares that to the current version number. If the SVN version is greater, it flags an
	 * update message. 
	 * 
	 * @return A message with info about updating.
	 */
	
	public function GenericAlert() {
		// Initial variables about SVN location and Current version
		$verList = $aItems = array();
		$curVersion = LeftAndMain::CMSVersion();
		//$curVersion = "2.3.1";
		$curVersion = floor(str_replace(array('.','/'),'',$curVersion));

		// Get HTML from Silverstripe SVN browser, then pull out all A tags
		$sRequest = HTTP::sendRequest('svn.silverstripe.com', '/open/modules/sapphire/tags/', null);
		preg_match_all('#<a[^<]*>([^<]*)</a>#i', $sRequest, $aItems, PREG_SET_ORDER);
		
		// Loop trough all A tags and attempt to convert their value to Int. If success
		// add the value to $verList array.
		foreach($aItems as $aItem) {
			$result = $aItem[1];
			$strip = str_replace(array('.','/'), '', $result);
			
			if(floor($strip))
				array_push($verList,$result);
		}
		
		// Retrieve the last item in the $verList array and converty to int
		$latest = floor(str_replace(array('.','/'), '', $verList[count($verList) - 1]));
		
		// If latest version if later than current version, return an update message.
		if($latest > $curVersion)
			return 'Silverstripe ' . str_replace('/','',$verList[count($verList) - 1]) . ' is available. The latest version can be found <a href="' . self::$ss_link . '" title="Silverstripe download page">here</a>, or update your SVN.';
		else
			return false;
   }
}