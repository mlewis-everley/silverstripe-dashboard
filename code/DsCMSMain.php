<?php
class DsCMSMain extends Extension {
	public function __construct(){
		$params = Director::urlParams();
		
		if($params['Controller'] == 'CMSMain')
			Requirements::customScript(file_get_contents(Director::baseFolder() . '/dashboard/javascript/DsCMSMain_left.js'));
	}
}
?>