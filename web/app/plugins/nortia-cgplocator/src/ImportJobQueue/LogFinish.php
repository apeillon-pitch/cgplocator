<?php

namespace NortiaCGPLocator\ImportJobQueue;

use WP_Queue\Job;

class LogFinish extends Job
{

    public function __construct()
    {
    }

    public function handle()
    {
        $import_log = @file_put_contents(wp_upload_dir()['basedir'] . '/nortia-cgplocator/import.log', "Import terminé à " . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
    }
}
