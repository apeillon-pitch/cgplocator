<div id="section-{{ $row }}" class="section hero style-one bg-pastel {{ $section['padding_group']['padding_bottom']}}">
  <script src="https://maps.googleapis.com/maps/api/js?key={{ acf_get_setting( 'google_api_key' )}}&libraries=places">
  </script>
  <div class="wrapper-content">
    <div class="container-lg h-100">
      <div class="row justify-content-center justify-content-lg-start gx-0 h-100 align-items-center">
        <div class="col-12 d-lg-none order-1">
          <div class="bg-image mobile" style="background-image: url({{ $section['image']['url'] }})"></div>
        </div>
        <div class="col-10 col-lg-6 pe-0 order-2 order-lg-1 pb-4 pb-lg-0">
          <div class="d-flex flex-column text-center text-lg-start">
            @if ($section['section_title_group']['title'])
              @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
            @endif
            @if ($section['introduction'])
              {!! $section['introduction'] !!}
            @endif
            <div class="row justify-content-lg-start mt-2">
              <div class="col-12 col-lg-10">
                <div class="d-flex flex-column">
                  <form id="cgp-locator" action="{!!wp_make_link_relative(get_permalink($options_data['cgp']['cgp_page'][0]->ID))!!}" method="post">
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
                    <button class="d-flex flex-row align-items-center btn btn-primary w-100 justify-content-center" id="geolocation">
                      <span class="me-2">Géolocalisez-moi</span> <i class="fa-regular fa-location-crosshairs"></i>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-none d-lg-block wrapper-bg-image w-100">
    <div class="row justify-content-end">
      <div class="col-6 position-relative">
        <div class="bg-image desktop" style="background-image: url({{ $section['image']['sizes']['large'] }})"></div>
        <div class="rectangular-bars"></div>
      </div>
    </div>
  </div>
</div>
