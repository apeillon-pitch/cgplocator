@if ($_POST['lat'] ?? false)
<script>
  window.cgps = @json($json);
</script>
@endif
@php global $wp_query; @endphp
<div class="row gx-0">
  <div class="col-12 col-sm-6 col-md-5 col-xl-4 position-relative">
    <div id="cgp-sidebar" class="d-flex flex-column pb-5">
      <div id="cgp-form" class="d-flex flex-column">
        <h1 class="section-title">Localiser un conseiller <br> en gestion de patrimoine :</h1>
        <form id="cgp-locator" class="d-flex flex-row justify-content-between g-0 mb-4" method="post">
          <div class="d-flex flex-grow-1">
            <input type="text" class="form-control h-100" placeholder="Adresse, Ville, Code postal" id="locationField" name="address" value="{!! $_POST['address'] ?? "" !!}">
            <input type="hidden" id="lat" name="lat" value="{!! $_POST['lat'] ?? 0 !!}">
            <input type="hidden" id="lng" name="lng" value="{!! $_POST['lng'] ?? 0 !!}">
          </div>
          <div class="d-flex">
            <button type="submit" class="btn btn-primary" id="cgp-search-submit"><i class="fa-regular fa-magnifying-glass"></i></button>
          </div>
        </form>
        <div class="d-none fs-6 pb-4" id="error-form-cgp">
          Veuillez saisir une adresse ou cliquer sur le bouton de géolocalisation.
        </div>
        <script>
          // Prevent sending form if coordinates are 0
          jQuery('#cgp-locator').submit(function(e) {
            console.log(jQuery('#lat').val(), jQuery('#lng').val());
            if (jQuery('#lat').val() == 0 && jQuery('#lng').val() == 0) {
              e.preventDefault();
              jQuery('#error-form-cgp').removeClass('d-none');
            }
          });
        </script>
        <button class="btn btn-primary" id="geolocation">
          <span id="geoButtonText">
            Géolocalisez-moi <i class="fa-regular fa-location-crosshairs"></i>
          </span>
          <div id="spinner" class="spinner-border spinner-border-sm text-light" style="display:none;" role="status">
            <span class="visually-hidden">Géolocalisation en cours...</span>
          </div>
        </button>
      </div>
      <div id="cgp-results" class="d-flex flex-column">
        <strong class="title">Les conseillers de notre réseau :</strong>
        @foreach($posts as $post)
        @include('partials.template-parts.cards.cgp.card-cgp')
        @endforeach
      </div>
      <button id="loadMore" class="btn btn-animated mx-auto mt-4" data-lat="{{@floatval($_POST['lat']) ?? 0}}" data-lng="{{@floatval($_POST['lng']) ?? 0}}" data-url="{{ admin_url( 'admin-ajax.php' ) }}" data-page="1" id="load-more"><span>Afficher plus de résultats</span></button>
    </div>
  </div>
  <div class="d-none d-sm-block col-sm-6 col-md-7 col-xl-8">
    <div class="acf-map" data-zoom="14" style="height: calc(100vh - 114px)">
    </div>
  </div>
</div>
<script type="text/javascript">
    async function initMap() {
      var $el = jQuery('.acf-map');

      var mapArgs = {
        zoom: $el.data('zoom') || 14,
        mapTypeId: google.maps.MapTypeId.LIGHT_POLITICAL
      };
      var map = new google.maps.Map($el[0], mapArgs);

      map.markers = [];
      const infoWindow = new google.maps.InfoWindow();

      if (window.cgps) {
        await Promise.all(window.cgps.map(async (cgp, index) => {
          var marker = new google.maps.Marker({
            position: {lat: parseFloat(cgp.lat), lng: parseFloat(cgp.lng)},
            map: map,
            icon: {
              url: "@asset('images/map-pin.svg')",
              scaledSize: new google.maps.Size(56, 56),
            }
          });

          map.markers.push(marker);
          console.log("Processing", cgp.title, "at latitude", cgp.lat, "and longitude", cgp.lng, "with index", index);

          marker.addListener('click', () => {
            map.setCenter(marker.getPosition());
            map.setZoom(19);
            infoWindow.close();
            infoWindow.setContent(cgp.tooltip);
            infoWindow.open(map, marker);
          })
        }));
      }

      map.addListener('click', () => {
        infoWindow.close();
        centerMap(map);
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

        // Case: No marker.
      } else if (map.markers.length == 0) {
        //Center on France
        map.setCenter({lat: 46.47638, lng: 2.213749});
        map.setZoom(6);
        // Case: Multiple markers.
      } else {
        map.fitBounds(bounds);
      }
    }
    window.initMap = initMap;
    window.centerMap = centerMap;
</script>
<script
  src="https://maps.googleapis.com/maps/api/js?key={{ acf_get_setting( 'google_api_key' )}}&libraries=places&callback=initMap">
</script>
