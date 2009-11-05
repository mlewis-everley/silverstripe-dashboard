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

		self::load_plugins();
	}
	
	/**
	 * load_plugins gets all of the DashboardPlugin subclasses and loads them into the
	 * $plugins class property.
	 *
	 * @return void
	 */
	private static function load_plugins() {
		foreach(DashboardPlugin::$positions as $pos) 
			self::$plugins[$pos] = array();
			
		$classes = ClassInfo::subclassesFor("DashboardPlugin");
		
		if(is_array($classes)) {
			foreach($classes as $class) {
				if($class != "DashboardPlugin" && !in_array($class,DashboardPlugin::get_disabled_plugins())) {
					$SNG = singleton($class);
					self::add_plugin($class, $SNG->stat('position'), $SNG->stat('sort'));
				}
			}
		}
	}

	/**
	 * Adds a plugin to the $plugins array, indexed by position, then sorted by class.
	 *
	 * @return void
	 */	
	private static function add_plugin($class, $pos, $sort) {
		if(!is_string($pos) || !in_array(strtolower($pos), DashboardPlugin::$positions))
			$pos = self::$default_position;

		if(!is_numeric($sort))
			$sort = 0;

		while(isset(self::$plugins[$pos][$sort]))
			$sort++;

		self::$plugins[$pos][$sort] = $class;
	}

	/**
	 * Gets all plugins by the specified position, retaining sort given in load_plugins
	 *
	 * @return array
	 */				
	private static function get_plugins_by_position($pos) {
		return self::$plugins[$pos];
	}

	/**
	 * Gets all of the output of plugins of a given position. Helper for template functions
	 *
	 * @return DataObjectSet
	 */	
	private function Plugins($pos) {
		if($plugins = self::get_plugins_by_position($pos)) {
			ksort($plugins);
			$data = new DataObjectSet();
			
			foreach($plugins as $plugin) {
				$data->push(new ArrayData(array(
					'Plugin' => new $plugin(),
					'Class' => $plugin
				)));
			}
						
			return $data;
	   }
	   
	   return false;	
	}

	/**
	 * Gets all of the output from the plugins with $position property set to that of $pos.
	 * These must be valid possitions found within DashboardPlugin::$positions
	 *
	 * @return DataObjectSet
	 */
	public function get_plugins($pos = 'left') {
		return $this->Plugins($pos);
	}
	
	/**
	 * Returns the base site URL, that can be accessed from the template
	 * @return String - Site URL 
	 */
	public function visit_site_link() {
		return Director::baseURL();
	}
}

?>