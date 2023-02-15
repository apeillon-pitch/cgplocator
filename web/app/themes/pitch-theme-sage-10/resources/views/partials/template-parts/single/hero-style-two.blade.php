<div id="section-0" class="section hero default-folder">
    <div class="wrapper-content">
        <div class="container-lg h-100">
            <div class="row gx-lg-0 h-100 align-items-center">
                <div class="col-12 d-lg-none order-1">
                    <div class="bg-image mobile" style="background-image: url({{ $article['thumbnail']['url'] }})"></div>
                </div>
                <div class="col-12 col-lg-6 pe-lg-0 order-2 order-lg-1">
                    <div class="d-flex flex-column text-center text-lg-start ps-4 pe-4 ps-lg-0 pe-lg-0">
                        <div class="wrapper-details">
                            <div class="d-none d-lg-flex flex-row">
                                <span>{!! $article['date'] !!}</span>
                                <span class="ms-1 me-1">-</span>
                                @if ($article['category'])
                                    <span>{!! $article['category']->name !!}</span>
                                @endif
                            </div>
                        </div>
                        @if ($article['title'])
                           <h1 class="section-title">{!! $article['title'] !!}</h1>
                        @endif
                        @if ($article['excerpt'])
                            {!! $article['excerpt'] !!}
                        @endif
                        <div class="wrapper-cta text-center text-md-start">
                            <a href="#section-contact-form" class="d-flex btn btn-animated pdf mx-auto mx-lg-0">
                                <span style="background-color: #fff6f1;">Télécharger le dossier</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none d-lg-block wrapper-bg-image w-100">
        <div class="row justify-content-end">
            <div class="col-6 position-relative">
                <div class="bg-image desktop" style="background-image: url({{ $article['thumbnail']['url'] }})"></div>
                <div class="rectangular-bars"></div>
            </div>
        </div>
    </div>
</div>
