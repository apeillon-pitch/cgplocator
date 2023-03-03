<div class="row gx-0">
  <div class="col-12 col-lg-4">
    <div class="d-flex flex-column">
      <div id="cgp-form" class="d-flex flex-column">
        <h1 class="section-title">Localiser un conseiller <br> en gestion de patrimoine :</h1>
        <form id="cgp-locator" class="d-flex flex-row justify-content-between g-0 mb-4" action="">
          <div class="d-flex flex-grow-1">
            <input type="text" class="form-control h-100" placeholder="Adresse, Ville, Code postal" id="locationField">
          </div>
          <div class="d-flex">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-magnifying-glass"></i></button>
          </div>
        </form>
        <button class="btn btn-primary" id="geolocation">Géolocalisez-moi <i class="fa-regular fa-location-crosshairs"></i>
        </button>
      </div>
      <div id="cgp-results" class="d-flex flex-column">
        @foreach($posts as $post)
          @include('partials.template-parts.cards.cgp.card-cgp')
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6"></div>
</div>
