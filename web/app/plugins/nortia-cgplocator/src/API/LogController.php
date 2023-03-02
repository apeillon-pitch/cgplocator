<?php
namespace NortiaCGPLocator\API;

use NortiaCGPLocator\Admin\Settings;

class LogController extends AbstractApiController
{
    public function register_routes() {

        // POST {$base}/example-action
        register_rest_route( $this->namespace, 'get-import-log', [
            'methods' => 'GET',
            'callback' => [$this, 'get_import_log'],
            'permission_callback' => [$this, 'check_permissions'],
        ] );
    }

    public function get_import_log() {
        // Get the import log from file.
        $settings = Settings::get();
        $import_log = @file_get_contents( wp_upload_dir()['basedir'] . '/nortia-cgplocator/import.log' );
        if( $import_log === false ) {
            $import_log = 'Pas de log d\'import.';
        }
        $response = new \StdClass();
        $response->current_row = $settings->all()['current_row'];
        $response->total_rows = $settings->all()['total_rows'];
        $response->log = $import_log;
        return rest_ensure_response($response);
    }

    public function check_permissions() {
        return current_user_can( 'manage_options' );
    }
}