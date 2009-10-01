<?php
Object::add_extension('CMSMain', 'DsCMSMain');
CMSMain::$url_segment = 'cms';
CMSMenu::replace_menu_item('CMSMain', 'Site Content', 'admin/cms/', 'CMSMain', 41);