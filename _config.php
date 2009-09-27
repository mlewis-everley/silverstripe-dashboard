<?php
Director::addRules(50, array(
	'admin/dashboard'	=> 'DashboardAdmin'
));

CMSMain::$url_segment = 'cms';

CMSMenu::replace_menu_item('CMSMain', 'Site Content', 'admin/cms/', null, 10);