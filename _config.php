<?php
DashboardAdmin::$visit_site_link = Director::baseURL();

Object::add_extension('CMSMain', 'DsCMSMain');
CMSMain::$url_segment = 'cms';
CMSMenu::replace_menu_item('CMSMain', 'Site Content', 'admin/cms/', 'CMSMain', 41);

// Replace SilverstripeNavigator with SSNavigator
Object::add_extension('ContentController', 'SSNController');