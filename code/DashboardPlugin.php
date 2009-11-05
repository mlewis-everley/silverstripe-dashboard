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
	 * @var $limit_count = Limiter to set how many items should be displayed
	 */  
	static $limit_count;
  
	/**
	 * @var $caption = Short caption to appear at the top of your plugin
	 */  
	static $caption;
  
	/**
	 * @var $null_message = Short message to return if no data is returned
	 */  
	static $null_message;
  
	/**
	 * @var $edit_link = URL for edit button, if it exists
	 */  
	static $edit_link;
  
	/**
	 * @var $edit_popup = Boolean value of whether an edit link should generate a popup
	 */  
	static $edit_popup = FALSE;

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
	 * Getter for the $caption property. Allows you to add a quick caption to the top of your dash item
	 *
	 * @return string
	 */      
	public function getCaption() {
		return $this->stat('caption');
	}

	/**
	 * Getter for the $caption property. Allows you to add a quick caption to the top of your dash item
	 *
	 * @return string
	 */      
	public function getNullMessage() {
		return $this->stat('null_message');
	}

	/**
	 * Getter for the $edit_link property. Allows you to set the base url for an edit link 
	 *
	 * @return string
	 */      
	public function getEditLink() {
		return $this->stat('edit_link');
	}

	/**
	 * Getter for the $edit_popup. Sets whether the edit link will be in a popup
	 *
	 * @return string
	 */      
	public function getEditPopup() {
		return $this->stat('edit_popup');
	}

	/**
	 * For rendering the plugin. Assumes template name of plugin class name.
	 *
	 * @return string
	 */
	public function forTemplate() {
		switch($this->stat('position')) {
			case 'left':
				$genericTemplate = 'Generic_Left';
				break;
			case 'alerts':
				$genericTemplate = 'Generic_Alert';
				break;
			case 'snippet':
				$genericTemplate = 'Generic_Snippet_List';
				break;
			case 'full_width':
				$genericTemplate = 'Generic_Full_Width';
				break;
		}

		return $this->renderWith(array($genericTemplate,get_class($this)));
	}

}