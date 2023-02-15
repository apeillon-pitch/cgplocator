@if($section['cta_group']['section_title_group']['title'] OR $section['cta_group']['introduction'])
    <div class="widget-contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-lg-12">
                    <div class="wrapper-section-cta">
                        <div class="d-flex flex-column">
                            @if ($section['cta_group']['section_title_group']['title'])
                                @include('partials.template-parts.title', ['item' => $section['cta_group']['section_title_group'], 'class' => 'section-title'])
                            @endif
                            @if ($section['cta_group']['introduction'])
                                <p class="mb-0">{!! $section['cta_group']['introduction'] !!}</p>
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
    </div>
@endif