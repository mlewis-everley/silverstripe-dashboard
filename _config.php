<?php
$curUrl = explode("?",$_SERVER['REQUEST_URI']);

if(
	$curUrl[0] == Director::baseURL() . 'admin/' ||
	$curUrl[0] == Director::baseURL() . 'admin'
) {
	Director::addRules(50, array(
		'admin' => '->admin/dashboard/'
	));
}

CMSMain::$url_segment = 'cms';
CMSMenu::replace_menu_item('CMSMain', 'Site Content', 'admin/cms/', 'CMSMain', 41);

// Replace SilverstripeNavigator with SSNavigator
Object::add_extension('ContentController', 'SSNController');