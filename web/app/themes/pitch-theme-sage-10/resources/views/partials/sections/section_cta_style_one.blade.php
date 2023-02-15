<div id="section-{{ $row }}" class="section cta style-one {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-12">
                <div class="wrapper-content text-center">
                    @if ($section['cta_group']['section_title_group']['title'])
                        @include('partials.template-parts.title', ['item' => $section['cta_group']['section_title_group'], 'class' => 'section-title'])
                    @endif
                    @if ($section['cta_group']['cta_repeater'])
                        <div class="wrapper-cta">
                            <div class="d-flex flex-row justify-content-center">
                                @foreach($section['cta_group']['cta_repeater'] as $cta)
                                    <div>
                                        @include('partials.template-parts.cta', ['item' => $cta, 'class' => $cta['link_style'] . ' ms-2 me-2'])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>