<div id="section-{{ $row }}" class="section hero style-one bg-pastel {{ $section['padding_group']['padding_bottom']}}">
  <div class="wrapper-content">
    <div class="container-lg h-100">
      <div class="row justify-content-center justify-content-lg-start gx-0 h-100 align-items-center">
        <div class="col-12 d-lg-none order-1">
          <div class="bg-image mobile" style="background-image: url({{ $section['image']['url'] }})"></div>
        </div>
        <div class="col-10 col-lg-6 pe-0 order-2 order-lg-1">
          <div class="d-flex flex-column text-center text-lg-start">
            @if ($section['section_title_group']['title'])
              @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
            @endif
            @if ($section['introduction'])
              {!! $section['introduction'] !!}
            @endif
            <div class="row mt-2">
              <div class="col-11 col-lg-10">
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
                  <button class="btn btn-primary">Géolocalisez-moi <i class="fa-regular fa-location-crosshairs"></i>
                  </button>
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
