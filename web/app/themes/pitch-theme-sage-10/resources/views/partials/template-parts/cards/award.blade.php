<div class="card-award h-100">
    <div class="d-flex flex-column h-100 justify-content-between">
        <div class="wrapper-image">
            <img src="{{ $slide['image']['url'] }}" alt="{!! $slide['image']['alt'] !!}" class="img-fluid">
        </div>
        <div class="wrapper-text d-flex flex-column justify-content-between">
            <div>
                @if ($slide['slide_title_group']['title'])
                    @include('partials.template-parts.title', ['item' => $slide['slide_title_group'], 'class' => 'slide-title'])
                @endif
                @if ($slide['text'])
                    <p>{!! $slide['text'] !!}</p>
                @endif
            </div>
            @if($slide['category'])
                <div>
                    <strong>Catégorie :</strong> {!! $slide['category'] !!}
                </div>
            @endif
        </div>
    </div>
</div>