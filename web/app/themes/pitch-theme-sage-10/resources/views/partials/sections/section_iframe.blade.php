<div id="section-{{ $row }}" class="section iframe {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-8">
                @if ($section['section_title_group']['title'])
                    <div class="heading-section">
                        @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
                    </div>
                @endif
                <div class="ratio ratio-16x9">
                    {!! $section['iframe'] !!}
                </div>
                @if ($section['cta_repeater'])
                    <div class="wrapper-cta mt-50">
                        <div class="d-flex flex-row justify-content-center">
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
    </div>
</div>