<?php
/**
 * SSNController adds a new method to Content Controller, this replaces the default Silverstripe
 * Navigator. Instead of hard codede links, SSNavigator should allow URL's in the navigator to
 * be altered a bit more easily and should allow for custom templating within the users
 * Templates folder.
 * 
 * To add The new navigator bar, add $SSNavigator to your template, in place of the traditional
 * $Silverstripenavigator
 */
class SSNController extends Extension {
	protected $dataRecord;
	
	/**
	 * @var $adminLink Link to the main admin area 
	 */
	static $adminLink = 'admin';

	public function SSNavigator() {
		if(Director::isDev() || Permission::check('CMS_ACCESS_CMSMain')) {
			Requirements::css(SAPPHIRE_DIR . '/css/SilverStripeNavigator.css');

			Requirements::javascript(THIRDPARTY_DIR . '/behaviour.js');
			Requirements::customScript(<<<JS
				Behaviour.register({
					'#switchView a' :  {
						onclick : function() {
							var w = window.open(this.href,windowName(this.target));
							w.focus();
							return false;
						}
					}
				});

				function windowName(suffix) {
					var base = document.getElementsByTagName('base')[0].href.replace('http://','').replace(/\//g,'_').replace(/\./g,'_');
					return base + suffix;
				}
				window.name = windowName('site');
JS
			);
			
			$this->owner->cmsLink	= self::$adminLink."/".CMSMain::$url_segment."/show";
			$this->owner->adminLink	= self::$adminLink;
			
			if($date = Versioned::current_archived_date()) {
				$this->owner->DisplayMode ='Archived'; 
				$this->owner->ArDate = Object::create('Datetime', $date, null);
			} else
				$this->owner->DisplayMode = Versioned::current_stage();
			
			
			return $this->owner->renderWith('SSNavigator');
		}
	}
}
?>