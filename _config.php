<?php
Director::addRules(100, array(
	'admin/0' => 'Dashboard'
));

Object::add_extension('CMSMain', 'Dashboard_Extension');