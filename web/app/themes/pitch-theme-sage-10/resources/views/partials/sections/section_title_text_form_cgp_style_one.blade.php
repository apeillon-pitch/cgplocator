<div id="section-{{ $row }}" class="section title-text-cta style-one">
  <script src="https://maps.googleapis.com/maps/api/js?key={{ acf_get_setting( 'google_api_key' )}}&libraries=places">  </script>

  <div class="container">
    <div class="wrapper">
      <div class="row justify-content-center">
        <div class="col-11 col-lg-6 col-xxl-5 text-center mb-3">
          @if ($section['section_title_group']['title'])
            @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
          @endif
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-11 col-lg-6 text-center">
          <div class="d-flex flex-column">
            @if ($section['text'])
              {!! $section['text'] !!}
            @endif
            <div class="d-flex flex-column mt-4">
              <form id="cgp-locator"
                    action="{!!wp_make_link_relative(get_permalink($options_data['cgp']['cgp_page'][0]->ID))!!}"
                    method="post">
                <div class="d-flex flex-row justify-content-between g-0 mb-4">
                  <div class="d-flex flex-grow-1">
                    <input type="text" class="form-control h-100" placeholder="Adresse, Ville, Code postal"
                           id="locationField">
                    <input type="hidden" id="lat" name="lat">
                    <input type="hidden" id="lng" name="lng">
                  </div>
                  <div class="d-flex">
                    <button type="submit" class="btn btn-primary"><i class="fa-regular fa-magnifying-glass"></i>
                    </button>
                  </div>
                </div>
                <button class="d-flex flex-row align-items-center btn btn-primary w-100 justify-content-center"
                        id="geolocation">
                  <span class="me-2" id="geoButtonText">Géolocalisez-moi <i class="fa-regular fa-location-crosshairs"></i></span>
                  <div id="spinner" class="spinner-border spinner-border-sm text-light" style="display:none;" role="status">
                    <span class="visually-hidden">Géolocalisation en cours...</span>
                  </div>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
