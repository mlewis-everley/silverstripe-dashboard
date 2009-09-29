<?php
Director::addRules(50, array(
	'admin/content//$Action/$ID/$OtherID' => 'DsCMSMain'
));

CMSMenu::remove_menu_item('CMSMain');

/*
Object::add_extension('CMSMain', 'DsCMSMain');
Object::set_static('CMSMain', 'url_segment', 'cms');

CMSMenu::replace_menu_item('CMSMain', 'Site Content', 'admin/cms/');
*/