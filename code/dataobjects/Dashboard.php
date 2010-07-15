<?php
/**
 * Description of Dashboard
 *
 * @author Mo
 */
class Dashboard extends DataObject {
    public static $db = array(
        "Title" => "Varchar(255)"
    );

    public static $has_one = array(
        'LeftWidgets'       => 'WidgetArea',
        'HalfWidthWidgets'  => 'WidgetArea',
        'FullWidthWidgets'  => 'WidgetArea'
    );

    /**
     * Setup a default Dashboard record if none exists
     */
    public function requireDefaultRecords() {
            parent::requireDefaultRecords();
            $dashboard = DataObject::get_one('Dashboard');
            if(!$dashboard) {
                    self::make_dashboard();
                    DB::alteration_message("Added base Dashboard","created");
            }
    }

    static function make_dashboard($locale = null) {
        if(!$locale) $locale = Translatable::get_current_locale();

        $dashboard = new Dashboard();
        $dashboard->Title = 'Dashboard';

        if($dashboard->hasExtension('Translatable'))
                $dashboard->Locale = $locale;

        $dashboard->write();

        return $dashboard;
    }
}
?>
