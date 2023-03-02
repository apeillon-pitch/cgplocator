<?php

namespace NortiaCGPLocator\Admin\Tabs;

use NortiaCGPLocator\Admin\AdminSettingsPageTabAbstract;
use Zawntech\WPAdminOptions\InputOption;
use Zawntech\WPAdminOptions\SelectOption;

/**
 * Geolocation tester tab.
 *
 * Class TestGeolocTab
 */
class TestGeolocTab extends AdminSettingsPageTabAbstract
{
    public $key = 'test_geoloc';

    public $label = 'Test Géolocalisation';

    public function render()
    {
    ?>
        <form method="post">
            <table class="form-table">
                <?php
                new InputOption([
                    'key' => 'lat',
                    'label' => 'Latitude',
                    'type' => 'text',
                ]);
                new InputOption([
                    'key' => 'lng',
                    'label' => 'Longitude',
                    'type' => 'text',
                ]);
                new SelectOption([
                    'key' => 'distance',
                    'label' => 'Rayon',
                    'context'   => 'admin-table',
                    'options' => [
                        '1' => '1 km',
                        '5' => '5 km',
                        '10' => '10 km',
                        '20' => '20 km',
                        '50' => '50 km',
                        '100' => '100 km',
                        '200' => '200 km',
                        '500' => '500 km',
                        '1000' => '1000 km',
                    ],
                ]);
                ?>
            </table>
            <button id="geolocate" type="button" class="button button-primary">Géolocalisez-moi</button>
            <?php $this->nonce_field(); ?>
            <button type="submit" class="button button-primary">Tester</button>
        </form>
        <script>
            jQuery(document).ready(function($) {
                $('#geolocate').click(function() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            $('#lat').val(position.coords.latitude);
                            $('#lng').val(position.coords.longitude);
                        });
                    } else {
                        alert('Votre navigateur ne supporte pas la géolocalisation.');
                    }
                });
            });
        </script>
<?php
    }

    public function save()
    {
        if (!$this->verify_nonce()) {
            $this->print_admin_notice('Nonce error...', 'error');
            return;
        }

        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $distance = $_POST['distance'];

        $data = \NortiaCGPLocator\Geolocator\GeolocatorComponent::get_posts_by_latlng($lat, $lng, $distance);

        if (empty($data)) {
            $this->print_admin_notice('Aucun résultat.', 'error');
            return;
        }

        $this->print_admin_notice(count($data) . " résultat(s) trouvé(s)", 'info');
    }
}
