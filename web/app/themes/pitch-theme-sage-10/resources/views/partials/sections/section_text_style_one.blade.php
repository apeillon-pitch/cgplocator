<div id="section-{{ $row }}" class="section text style-one">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-8">
                {!! $section['text'] !!}
            </div>
        </div>
        @if ($section['cta_repeater'])
            <div class="wrapper-cta mt-50">
                <div class="d-flex flex-row justify-content-center {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
                    @foreach($section['cta_repeater'] as $cta)
                        <div>
                            @include('partials.template-parts.cta', ['item' => $cta, 'class' => $cta['link_style'] . ' ms-2 me-2'])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>