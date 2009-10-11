<?php
class SSNController extends Extension {
	protected $dataRecord;

	public function __construct($dataRecord = null) {
		parent::__construct();
	}
	
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
			
			$this->owner->cmsLink = "admin/".CMSMain::$url_segment."/show";
			
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