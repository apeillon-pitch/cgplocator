<?php

namespace NortiaCGPLocator\Setup;

class ActivatePlugin
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'maybe_activate_plugin']);
    }

    public function maybe_activate_plugin()
    {
        $option_key = 'NORTIACGP_ACTIVATE';
        $option = get_option($option_key);
        if (!empty($option)) {
            $this->activate_plugin();
            delete_option($option_key);
        }
    }

    public function activate_plugin()
    {
        global $wpdb;
        $wpdb->query(
            "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}queue_jobs (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                job longtext NOT NULL,
                attempts tinyint(3) NOT NULL DEFAULT 0,
                reserved_at datetime DEFAULT NULL,
                available_at datetime NOT NULL,
                created_at datetime NOT NULL,
                PRIMARY KEY  (id)
            )"
        );
        $wpdb->query(
            "CREATE TABLE {$wpdb->prefix}queue_failures (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                job longtext NOT NULL,
                error text DEFAULT NULL,
                failed_at datetime NOT NULL,
                PRIMARY KEY  (id)
            )"
        );
        $upload = wp_upload_dir();
        $upload_dir = $upload['basedir'];
        $upload_dir = $upload_dir . '/nortia-cgplocator';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0700);
        }
    }
}
