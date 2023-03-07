<script>
  window.cgps = @json($json);
</script>
<div class="row gx-0">
  <div class="col-12 col-lg-4">
    <div class="d-flex flex-column">
      <div id="cgp-form" class="d-flex flex-column">
        <h1 class="section-title">Localiser un conseiller <br> en gestion de patrimoine :</h1>
        <form id="cgp-locator" class="d-flex flex-row justify-content-between g-0 mb-4" method="post">
          <div class="d-flex flex-grow-1">
            <input type="text" class="form-control h-100" placeholder="Adresse, Ville, Code postal" id="locationField">
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lng" name="lng">
          </div>
          <div class="d-flex">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-magnifying-glass"></i></button>
          </div>
        </form>
        <button class="btn btn-primary" id="geolocation">Géolocalisez-moi <i
            class="fa-regular fa-location-crosshairs"></i>
        </button>
      </div>
      <div id="cgp-results" class="d-flex flex-column">
        @foreach($posts as $post)
        @include('partials.template-parts.cards.cgp.card-cgp')
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-8">
    <div class="acf-map" data-zoom="14" style="height: calc(100vh - 114px)">
    </div>
  </div>
</div>
<script type="text/javascript">
    function initMap() {
      var $el = jQuery('.acf-map');

      var mapArgs = {
        zoom: $el.data('zoom') || 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var map = new google.maps.Map($el[0], mapArgs);

      map.markers = [];
      window.cgps.map((cgp) => {
        var marker = new google.maps.Marker({
          position: {lat: parseFloat(cgp.lat), lng: parseFloat(cgp.lng)},
          map: map
        });
        map.markers.push(marker);
      });

      centerMap(map);
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
</script>
<script
  src="https://maps.googleapis.com/maps/api/js?key={{ acf_get_setting( 'google_api_key' )}}&libraries=places&callback=initMap">
</script>
