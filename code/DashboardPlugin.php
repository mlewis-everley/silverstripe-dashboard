<?php
/**
 * Abstract class for dashboard plugins.
 * 
 * @package Dashboard
 */

abstract class DashboardPlugin extends ViewableData {
	/**
	 * @var $position = The position of this plugin on the dashboard. 
	 *                  Value must be contained in DashboardPlugin::$positions
	 */
	static $position = "snippet";

	/**
 	 * @var $sort = Index of where the plugin will appear in a given position.
	 */
	static $sort = 0;

	/**
	 * @var $positions = A lookup for the available positions of a plugin on the dashboard.
	 */
	static $positions = array('left','alerts','snippet','full_width');
	
	/**
	 * @var $disabled_plugins = A list of plugins that should not be included on the dashboard.
	 *                          By default, all DashboardPlugin subclasses are included.
	 */
	private static $disabled_plugins = array();
     
	/**
	 * @var $icon = Path to the icon that is embedded in the plugin heading
	 */
	static $icon;

	/**
	 * @var $Title = Title of the plugin on dashboard view
	 */
	static $title;

	/**
	 * @var $link = A link for more info embdedded in the header
	 */  
	static $link;
  
	/**
	 * @var $link_text = Text for the more info link
	 */  
	static $link_text = "View All";
  
	/**
	 * Sets a plugin class as disabled, so it will not appear on the dashboard.
	 *
	 * @return void
	 */
	public static function disable($plugin) {
		if(!in_array($plugin, self::$disabled_plugins))
			self::$disabled_plugins[] = $plugin;
	}
  
	/**
	 * Getter for $disabled_plugins
	 *
	 * @return array
	 */
	public static function get_disabled_plugins() {
		return self::$disabled_plugins;
	}
	
	/**
	 * Simple function to convert Title of Plugin to PluginClass.TITLEOFPLUGIN
	 *
	 * @return string
	 */  
	private function toLangVar($str) {
		$str = str_replace(" ", "", $str);
		return get_class($this).".".strtoupper(ereg_replace("[^A-Za-z]", "", $str));
	}
  
	/**
	 * Returns an inline style for the icon. Used on dashboard template.
	 *
	 * @return string
	 */
	public function IconCSS() {
		if($icon = $this->stat('icon'))
			return "style='background-image:url($icon); padding-left: 30px;'";
		return false;
	}

	/**
	 * Uses toLangVar() to translate a given property
	 *
	 * @return string
	 */  
	private function getTranslatedProperty($property) {
		if($val = $this->stat($property))
			return _t($this->toLangVar($val),$val);
	}

	/**
	 * Translates the $title property
	 *
	 * @return string
	 */    
	public function getTitle() {
		return $this->getTransLatedProperty('title');
	}
 
	/**
	 * Translates the $link_text property
	 *
	 * @return string
	 */      
	public function getLinkText() {
		return $this->getTranslatedProperty('link_text');
	}

	/**
	 * Getter for the $link property. Useful on templates, which don't have access to static vars.
	 *
	 * @return string
	 */      
	public function getLink() {
		return $this->stat('link');
	}

	/**
	 * For rendering the plugin. Assumes template name of plugin class name.
	 *
	 * @return string
	 */
	public function forTemplate() {
		return $this->renderWith(array(get_class($this)));
	}

}