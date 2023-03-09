<div class="section hero default-article cgp">
  <div class="bg-color pastelBlue"></div>
  <div class="wrapper-content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-11 col-lg-7 col-xl-6 text-center">
          <div class="d-flex flex-column">
            <div class="wrapper-heading mb-0">
              @if ($cgp['title'])
                <h1 class="section-title mb-4">{!! $cgp['title'] !!}</h1>
              @endif
              @if ($cgp['address'])
                <p class="address">{!! $cgp['address']['address'] !!}</p>
              @endif
              @if ($cgp['email'] && $cgp['cgp-options']['cta_title'])
                <a href="#section-1" aria-label="{!! $cgp['cgp-options']['cta_title'] !!}" class="btn btn-simple">
                  {!! $cgp['cgp-options']['cta_title'] !!}
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @if ($cgp['address'])
    <div class="acf-map" data-zoom="16">
      <div class="marker" data-lat="<?php echo esc_attr($cgp['address']['lat']); ?>"
           data-lng="<?php echo esc_attr($cgp['address']['lng']); ?>"></div>
    </div>
  @endif
</div>


<script src="https://maps.googleapis.com/maps/api/js?key={{ acf_get_setting( 'google_api_key' )}}"></script>
<script type="text/javascript">
  (function ($) {

    /**
     * initMap
     *
     * Renders a Google Map onto the selected jQuery element
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @return  object The map instance.
     */
    function initMap($el) {

      // Find marker elements within map.
      var $markers = $el.find('.marker');

      // Create gerenic map.
      var mapArgs = {
        zoom: $el.data('zoom') || 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var map = new google.maps.Map($el[0], mapArgs);

      // Add markers.
      map.markers = [];
      $markers.each(function () {
        initMarker($(this), map);
      });

      // Center map based on markers.
      centerMap(map);

      // Return map instance.
      return map;
    }

    /**
     * initMarker
     *
     * Creates a marker for the given jQuery element and map.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @param   object The map instance.
     * @return  object The marker instance.
     */
    function initMarker($marker, map) {

      // Get position from marker.
      var lat = $marker.data('lat');
      var lng = $marker.data('lng');
      var latLng = {
        lat: parseFloat(lat),
        lng: parseFloat(lng)
      };

      // Create marker instance.
      var marker = new google.maps.Marker({
        position: latLng,
        map: map
      });

      // Append to reference for later use.
      map.markers.push(marker);

      // If marker contains HTML, add it to an infoWindow.
      if ($marker.html()) {

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
          content: $marker.html()
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function () {
          infowindow.open(map, marker);
        });
      }
    }

    /**
     * centerMap
     *
     * Centers the map showing all markers in view.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   object The map instance.
     * @return  void
     */
    function centerMap(map) {

      // Create map boundaries from all map markers.
      var bounds = new google.maps.LatLngBounds();
      map.markers.forEach(function (marker) {
        bounds.extend({
          lat: marker.position.lat(),
          lng: marker.position.lng()
        });
      });

      // Case: Single marker.
      if (map.markers.length == 1) {
        map.setCenter(bounds.getCenter());

        // Case: Multiple markers.
      } else {
        map.fitBounds(bounds);
      }
    }

// Render maps on page load.
    $(document).ready(function () {
      $('.acf-map').each(function () {
        var map = initMap($(this));
      });
    });

  })(jQuery);
</script>
