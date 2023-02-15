<div id="section-{{ $row }}" class="section block-repeater style-six {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        @if ($section['section_title_group']['title'])
            <div class="row justify-content-center">
                <div class="col-11 col-lg-12">
                    <div class="heading-section title-margin">
                        <div class="d-flex flex-column text-center">
                            @if ($section['section_title_group']['title'])
                                @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($section['block_repeater'])
            @foreach ($section['block_repeater'] as $block)
                    <div class="row justify-content-center align-items-center style-one">
                        <div class="d-none d-lg-block col-lg-3 col-xl-2 @php echo $block['position'] == 'left' ? 'order-1' : 'order-1 order-lg-2' @endphp">
                            <img src="{!! $block['image']['url'] !!}" class="w-100 img-fluid" alt="{!! $block['image']['alt'] !!}">
                        </div>
                        <div class="col-11 col-lg-7 col-xl-6 @php echo $block['position'] == 'left' ? 'order-2' : 'order-2 order-lg-1' @endphp">
                            <div class="wrapper-text">
                                <div class="d-flex flex-column h-100 justify-content-center">
                                    @if ($block['block_title_group']['title'])
                                        @include('partials.template-parts.title', ['item' => $block['block_title_group'], 'class' => 'block-title'])
                                    @endif
                                    @if ($block['text'])
                                        {!! $block['text'] !!}
                                    @endif
                                    @if ($block['cta_repeater'])
                                        <div class="wrapper-cta">
                                            <div class="d-flex flex-column">
                                                @foreach($block['cta_repeater'] as $cta)
                                                    <div>
                                                        @include('partials.template-parts.cta', ['item' => $cta, 'class' => $cta['link_style'] . ' mt-2 mt-sm-3'])
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        @endif
    </div>
</div>
