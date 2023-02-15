<div id="section-{{ $row }}"
     class="section slideshow-awards {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        <div class="wrapper">
            @if (count($section['slideshow_repeater']) > 3)
                @php $arrow = true; @endphp
            @else
                @php $arrow = false; @endphp
            @endif
            @include('partials.template-parts.slideshow.wrapper-heading', ['arrow' => $arrow])
            <div class="row">
                <div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4 p-lg-0">
                    <div class="slideshow p-0">
                        @foreach ($section['slideshow_repeater'] as $slide)
                            <div class="slide">
                                @include('partials.template-parts.cards.award')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
