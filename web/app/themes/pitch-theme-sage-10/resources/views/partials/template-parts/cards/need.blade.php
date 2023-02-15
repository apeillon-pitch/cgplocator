<div class="card-need h-100">
    <div class="d-flex flex-column justify-content-between h-100">
        <div class="bg-image"
             style="background-image: url({{ $slide['thumbnail']['url'] }});">
        </div>
        <div class="wrapper-content d-flex flex-column justify-content-between">
            @if($slide['short-title'])
                <h3 class="slide-title">
                    {!! $slide['short-title'] !!}
                </h3>
            @endif
            <div>
                <a href="{{ $slide['permalink'] }}" class="btn btn-simple">En savoir
                    plus</a>
            </div>
        </div>
    </div>
</div>