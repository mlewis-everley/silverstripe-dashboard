<?php
$curUrl = explode("?",$_SERVER['REQUEST_URI']);

if(
    ($curUrl[0] == Director::baseURL() . 'admin/' ||
    $curUrl[0] == Director::baseURL() . 'admin') &&
    (substr_count(strtolower($curUrl[1]), 'locale') == 0)
)
{
    Director::addRules(50, array(
        'admin' => '->admin/dashboard/'
    ));
}

CMSMain::$url_segment = 'cms';
CMSMenu::replace_menu_item('CMSMain', 'Site Content', 'admin/cms/', 'CMSMain', 41);