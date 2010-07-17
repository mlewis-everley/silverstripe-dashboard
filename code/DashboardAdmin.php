<?php
 /**
  * Main dashboard class. Auto creates a link in the CMS by being extended from LeftAndMain.
  * 
  * @package Dashboard
  */
class DashboardAdmin extends LeftAndMain {
	static $url_segment = 'dashboard';
	static $menu_title = 'Dashboard';
	static $menu_priority = 99;
	static $url_priority = 41;

	/**
	 * @var $plugins = A colection of all the plugins available to the Dashboard. 
	 *                 Loads all subclasses of DashboardPlugin
	 */
	static $plugins = array();
	
	/**
	 * @var $default_position = Default position that a plugin will have
	 */
	static $default_position = 0;

	static $allowed_actions = array(
		'EditForm'
	);

	/**
	 * Initialisation method called before accessing any functionality that RandomLinksAdmin has to offer
	 */
	public function init() {
		parent::init();

		$vars = array(
                    'Base' => Director::baseURL()
		);
		
		Requirements::css('dashboard/css/Dashboard.css');
		Requirements::insertHeadTags('<!--[if IE 6]><link type="text/css" href="dashboard/css/ie6.css" rel="stylesheet" media="screen" /><![endif]-->');

		
		Requirements::javascript('dashboard/javascript/greybox.js');
		Requirements::javascriptTemplate('dashboard/javascript/Dashboard.js',$vars);
	}

        public function getEditForm($id) {
            $record = DataObject::get_one('Dashboard');

            $fields = $record->getCMSFields();

            $actions = new FieldSet(
                new FormAction('save',_t('DashboardAdmin.Save','Save'))
            );

            $form = new Form($this, "EditForm", $fields, $actions);
            $form->loadDataFrom($record);

            return $form;
        }
	
	/**
	 * Returns the base site URL, that can be accessed from the template
	 * @return String - Site URL 
	 */
	public function visit_site_link() {
		return Director::baseURL();
	}

        public function save($data,$form) {
            $record = DataObject::get_one('Dashboard');

            $form->saveInto($record, true);
            $record->write();

            FormResponse::status_message('Layout Updated', 'good');
            FormResponse::add("$('Form_EditForm').resetElements();");

            return FormResponse::respond();
        }
}

?>