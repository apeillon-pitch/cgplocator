<div id="section-{{ $row }}" class="section hero style-one bg-pastel {{ $section['padding_group']['padding_bottom']}}">
    <div class="wrapper-content">
        <div class="container-lg h-100">
            <div class="row justify-content-center justify-content-lg-start gx-0 h-100 align-items-center">
                <div class="col-12 d-lg-none order-1">
                    <div class="bg-image mobile" style="background-image: url({{ $section['image']['url'] }})"></div>
                </div>
                <div class="col-10 col-lg-6 pe-0 order-2 order-lg-1">
                    <div class="d-flex flex-column text-center text-lg-start">
                        @if ($section['section_title_group']['title'])
                            @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
                        @endif
                        @if ($section['introduction'])
                            {!! $section['introduction'] !!}
                        @endif
                        @if ($section['cta_repeater'])
                            <div class="wrapper-cta">
                                <div class="d-flex flex-column">
                                    @foreach($section['cta_repeater'] as $cta)
                                        <div>
                                            @include('partials.template-parts.cta', ['item' => $cta, 'class' => $cta['link_style']])
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
    <div class="d-none d-lg-block wrapper-bg-image w-100">
        <div class="row justify-content-end">
            <div class="col-6 position-relative">
                <div class="bg-image desktop" style="background-image: url({{ $section['image']['sizes']['large'] }})"></div>
                <div class="rectangular-bars"></div>
            </div>
        </div>
    </div>
</div>
