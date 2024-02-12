<?php

namespace NortiaCGPLocator\Admin\Tabs;

use NortiaCGPLocator\Admin\AdminSettingsPageTabAbstract;
use NortiaCGPLocator\ExcelImport\ExcelImportComponent;
use Zawntech\WPAdminOptions\InputOption;

use NortiaCGPLocator\Admin\Settings;

/**
 * Import tab.
 *
 * Class ImportTab
 */
class ImportTab extends AdminSettingsPageTabAbstract
{
    public $key = 'import';

    public $label = 'Import';

    public function render()
    {
        $settings = Settings::get();
        // Calculate progress percentage.
        $total_rows = $settings->all()['total_rows'];
        $current_row = $settings->all()['current_row'];
        if ($total_rows === 0) {
            $progress = 0;
        } else {
            $progress = @round($current_row / $total_rows * 100, 0) ?: 0;
        }

?>
        <style>
            textarea {
                width: 100%;
                height: 200px;
                resize: none;
            }

            progress {
                position: relative;
            }

            progress[value] {
                width: 100%;
                height: 48px;
            }

            progress::after {
                content: attr(value) '%';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                text-align: center;
                line-height: 48px;
                color: #fff;
                font-weight: bold;
            }
        </style>
        <textarea disabled></textarea>
        <progress class="progress-bar" value="<?php echo $progress; ?>" max="100" id="import-progress"></progress>
        <input type="checkbox" name="freeze-scroll" id="freeze-scroll" />
        <label for="freeze-scroll">Geler le défilement</label>
        <script>
            // Wait until WP-API is loaded.
            jQuery(document).ready(function($) {
                $('textarea').val('...');
                // Keep textarea scrolled to bottom.
                $.ajax({
                    url: '<?php echo \NortiaCGPLocator\API\LogController::base_url(); ?>get-import-log',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
                    },
                    method: 'GET',
                    success: function(data) {
                        $('textarea').val(data.log);
                        let progress = Math.round(data.current_row / data.total_rows * 100);
                        $('#import-progress').val(progress);
                    }
                }).then(() => {
                    $('textarea').scrollTop($('textarea')[0].scrollHeight);
                });
            });
            // Refresh the textarea every 5 seconds.
            setInterval(function() {
                jQuery(document).ready(function($) {
                    $.ajax({
                        url: '<?php echo \NortiaCGPLocator\API\LogController::base_url(); ?>get-import-log',
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
                        },
                        method: 'GET',
                        success: function(data) {
                            $('textarea').val(data.log);
                            let progress = Math.round(data.current_row / data.total_rows * 100);
                            $('#import-progress').val(progress);
                        }
                    }).then(() => {
                        if ($('input[name="freeze-scroll"]').prop('checked') === false) {
                            $('textarea').scrollTop($('textarea')[0].scrollHeight);
                        }
                    });
                });
            }, 5000);
        </script>
        <form method="post" enctype="multipart/form-data">
            <table class="form-table">
                <?php
                new InputOption([
                    'key' => 'import_file',
                    'label' => 'Fichier à importer',
                    'type' => 'file',
                ]);
                ?>
            </table>
            <?php $this->nonce_field(); ?>
            <button type="submit" class="button button-primary">Importer</button>
        </form>
<?php
    }

    public function save()
    {
        $settings = Settings::get();

        if (!$this->verify_nonce()) {
            $this->print_admin_notice('Nonce error...', 'error');
            return;
        }


        $file = $_FILES['import_file'];

        if ($file['error'] !== 0) {
            $this->print_admin_notice('Error uploading file...', 'error');
            return;
        }

        $handle = new ExcelImportComponent();

        try {
            $data = $handle->extract($file);
        } catch (\Exception $e) {
            $this->print_admin_notice($e->getMessage(), 'error');
            return;
        }

        $settings->set(['total_rows' => count($data) - 1, 'current_row' => 0]);

        // Clear log file on new import.
        if (@filesize(wp_upload_dir()['basedir'] . '/nortia-cgplocator/import.log') !== 0) {
            @unlink(wp_upload_dir()['basedir'] . '/nortia-cgplocator/import.log');
        }
        file_put_contents(wp_upload_dir()['basedir'] . '/nortia-cgplocator/import.log', "***Import démarré à " . date('Y-m-d H:i:s') . "***" . PHP_EOL);


        foreach ($data as $row) {
            wp_queue()->push(new \NortiaCGPLocator\ImportJobQueue\ImportJob($row));
        }

        $this->print_admin_notice('Import en cours de ' . count($data) - 1 . ' entrées...', 'info');
    }
}
