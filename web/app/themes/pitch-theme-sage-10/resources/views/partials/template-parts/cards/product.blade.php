<div class="card-product">
    <div class="d-flex flex-column justify-content-between h-100">
        <div class="bg-image"
             style="background-image: url({{ $product['thumbnail']['url'] }});">
        </div>
        <div class="wrapper-logo" style="background-color: {{ $product['color'] }}">
            <img src="{{ $product['logo-white']['url'] }}" alt="{!!  $product['logo-white']['alt'] !!}" class="img-fluid">
        </div>
        <div class="wrapper-content d-flex flex-column justify-content-between">
            @if($product['short-title'])
                <h3 class="slide-title">
                    {!! $product['short-title'] !!}
                </h3>
            @endif
            <div>
                <a href="{{ $product['permalink'] }}" class="btn btn-simple">
                    En savoir plus</a>
            </div>
        </div>
    </div>
</div>