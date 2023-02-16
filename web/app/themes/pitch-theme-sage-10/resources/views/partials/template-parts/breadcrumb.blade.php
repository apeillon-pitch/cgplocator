@if (!is_front_page())
  <div class="breadcrumb">
    <div class="container">
      @if (is_singular('cgp'))
        <a href="javascript:history.back()" class="d-flex flex-row align-items-center">
          <div class="wrapper-icon d-flex justify-content-center align-items-center me-2">
            <i class="fas fa-chevron-left"></i>
          </div>
          <span>Retour à la recherche</span>
        </a>
      @else
        <a href="javascript:history.back()" class="d-flex flex-row align-items-center">
          <div class="wrapper-icon d-flex justify-content-center align-items-center me-2">
            <i class="fas fa-chevron-left"></i>
          </div>
          <span>Retour</span>
        </a>
      @endif
    </div>
  </div>
@endif
