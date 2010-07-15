<?php
/**
 * 
 */

class RecentPagesWidget extends Widget {
    static $link = "admin/cms/";
    static $edit_link = 'admin/cms/show';

    public static $cmsTitle = 'Recent Pages';
    public static $description = 'Display recent pages and generate edit and delete links';
    
    public static $db = array(
        'Title'         => 'Varchar',
        'NullMessage'   => 'Text',
        'Limit'         => 'Int'
    );

    public static $has_one = array(
        'Dashboard'     => 'Dashboard'
    );

    public static $defaults = array(
        'Title'     => 'Recent Pages'
    );

    public function Title() {
        return $this->Title ? $this->Title : $this->CMSTitle();
    }

    public function getCmsFields() {
        $fields = new FieldSet();

        return $fields;
    }
}

class RecentPagesWidget_Controller extends Widget_Controller {
    public function init() {
        parent::init();
    }

    public function GenericSnippetList() {
        $output = new DataObjectSet();
        $items = DataObject::get("SiteTree", NULL, "`LastEdited` DESC", NULL, "0,".self::$limit_count);

        if($items) {
            foreach($items as $item) {
                $date = new Date('Date');
                $date->setValue($item->LastEdited);

                $output->push(new ArrayData(array(
                    'URL'       => Director::baseURL().$item->URLSegment,
                    'Title'     => $item->Title,
                    'Date'      => $date,
                    'ID'        => $item->ID,
                    'EditLink'  => self::$edit_link.'/'.$item->ID
                )));
            }
        }
        
        return $output;
    }
}