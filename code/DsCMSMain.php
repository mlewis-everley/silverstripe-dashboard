<?php
class DsCMSMain extends CMSMain {
	static $url_segment = 'content';
	
	static $menu_title = 'Site Content';
	
	public function init() {
		parent::init();

		Requirements::javascript('dashboard/javascript/DsCMSMain_left.js');
	}
	
}
/*
class DsCMSMain extends Extension {
	public function __construct(){
		Requirements::customScript(file_get_contents(Director::baseFolder() . '/dashboard/javascript/DsCMSMain_left.js'));
	}
}
*/
?>