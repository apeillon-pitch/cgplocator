<div id="section-contact-form"
     class="section contact-form {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-11 col-lg-12">
        <div class="wrapper">
          <div class="row justify-content-center">
            <div class="col-11 col-lg-6 text-center">
              @if ($section['section_title_group']['title'])
                @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title highlighted'])
              @endif
              <div class="d-flex flex-column">
                <form id="cgp-locator" class="d-flex flex-row justify-content-between g-0 mb-4" action="">
                  <div class="d-flex flex-grow-1">
                    <input type="text" class="form-control h-100" placeholder="Adresse, Ville, Code postal">
                  </div>
                  <div class="d-flex">
                    <button type="submit" class="btn btn-primary"><i class="fa-regular fa-magnifying-glass"></i>
                    </button>
                  </div>
                </form>
                <button class="btn btn-primary" id="geolocation">
                  <span id="geoButtonText">
                    Géolocalisez-moi <i class="fa-regular fa-location-crosshairs"></i>
                  </span>
                  <div id="spinner" class="spinner-border spinner-border-sm text-light" style="display:none;" role="status">
                    <span class="visually-hidden">Géolocalisation en cours...</span>
                  </div>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
