<?php
Director::addRules(50, array(
	'admin/content//$Action/$ID/$OtherID' => 'DsCMSMain'
));

CMSMenu::remove_menu_item('CMSMain');