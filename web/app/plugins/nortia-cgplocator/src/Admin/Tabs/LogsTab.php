<?php

namespace NortiaCGPLocator\Admin\Tabs;

use NortiaCGPLocator\Admin\AdminSettingsPageTabAbstract;
use NortiaCGPLocator\Admin\Settings;

/**
 * Logs tab.
 *
 * Class LogsTab
 */
class LogsTab extends AdminSettingsPageTabAbstract
{
    public $key = 'logs';

    public $label = 'Logs';

    public function render()
    {
        $settings = Settings::get();
        // Calculate progress percentage.
        $total_rows = $settings->all()['total_rows'];
        $current_row = $settings->all()['current_row'];
        $progress = round($current_row / $total_rows * 100, 0);
?>
        <style>
            textarea {
                width: 100%;
                height: 450px;
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
<?php
    }

    public function save()
    {
    }
}
