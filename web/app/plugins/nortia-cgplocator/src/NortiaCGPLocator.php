<?php
namespace NortiaCGPLocator;

/**
 * Class NortiaCGPLocator
 *
 * This is the main plugin class which instantiates individual plugin components.
 */
class NortiaCGPLocator
{
    /**
     * @var NortiaCGPLocator;
     */
    protected static $instance;

    /**
     * Returns (and initializes once) an instance of the plugin class.
     *
     * @return NortiaCGPLocator
     */
    public static function get_instance() {
        if ( ! static::$instance ) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    /**
     * Register components upon plugin instantiation.
     */
    protected function __construct() {
        $this->register_components();
    }

    /**
     * Instantiate plugin components. Aim to encapsulate different concepts by "component".
     * For example, the default component that ships with WPGen is the 'SetupComponent'.
     * It is sub-namespaced ('Setup'), with a main plugin SetupComponent,
     * which handles all plugin-setup related functionality.
     */
    public function register_components() {
        new Setup\SetupComponent;
        new Admin\AdminComponent;
        new ExcelImport\ExcelImportComponent;
        new Geolocator\GeolocatorComponent;
        new API\ApiComponent;
    }
}