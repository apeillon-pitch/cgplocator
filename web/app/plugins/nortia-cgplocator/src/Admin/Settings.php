<?php
namespace NortiaCGPLocator\Admin;

/**
 * Nortia — CGP Locator Settings helper class.
 *
 * Class Settings
 */
class Settings
{
    /**
     * The option key for Nortia — CGP Locator settings.
     */
    const OPTION_KEY = 'NORTIACGP_SETTINGS';

    /**
     * @return array The plugin defaults.
     */
    protected function get_defaults() {
        $settings = [
            'is_importing' => false,
            'total_rows' => 0,
            'current_row' => 0,
        ];
        return apply_filters( 'nortia_cgp_default_settings', $settings );
    }

    /**
     * Get filtered setting.
     *
     * @param $key string Setting key.
     * @return mixed
     */
    protected function get_setting( $key ) {
        $value = $this->all()[$key];
        return apply_filters( 'nortia_cgp_get_setting', $value, $key );
    }

    /**
     * Casts the return of get_setting( $key ) as an array.
     * Returns an empty array if the returned value is not already an array.
     *
     * @param $key
     * @return array
     */
    protected function get_setting_as_array( $key ) {
        $value = $this->get_setting( $key );
        if ( ! is_array( $value ) ) {
            return [];
        }
        return $value;
    }

    /**
     * @var array An array of all options.
     */
    protected $all = [];

    /**
     * @return Settings Get a new, preloaded instance of settings.
     */
    public static function get() {
        return new static;
    }

    /**
     * @param array $values An array of new values to store.
     */
    public function set( $values = [] ) {
        if ( empty( $values ) ) {
            return;
        }
        foreach( $values as $key => $value ) {
            $this->all[$key] = $value;
        }
        update_option( static::OPTION_KEY, $this->all );
    }

    /**
     * Settings constructor. Fetch and set options to object.
     */
    protected function __construct() {
        // Get options array.
        $options = get_option( static::OPTION_KEY );
        // Define default plugin keys and values.
        $this->all = wp_parse_args( $options, $this->get_defaults() );
    }

    /**
     * @return array An array of all options.
     */
    public function all() {
        return $this->all;
    }
}