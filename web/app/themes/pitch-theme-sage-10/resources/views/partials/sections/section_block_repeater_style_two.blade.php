<div id="section-{{ $row }}"
     class="section block-repeater style-two {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        @if ($section['section_title_group']['title'])
            <div class="heading-section">
                <div class="row justify-content-center">
                    <div class="col-11 col-lg-12 text-center">
                        @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
                    </div>
                </div>
            </div>
        @endif
        @if ($section['block_repeater'])
            <div class="row justify-content-center">
                <div class="col-11 col-lg-12">
                    <div class="row justify-content-center">
                        @foreach ($section['block_repeater'] as $block)
                            @if (count($section['block_repeater']) <= 3)
                                @php $class = "col-lg-4" @endphp
                            @else
                                @php $class = "col-lg-3" @endphp
                            @endif
                            <div class="col-6 {{ $class }} mb-4">
                                <div class="wrapper-text bg-pastel h-100">
                                    <div class="d-flex flex-column text-center ">
                                        @if ($block['key_figure'])
                                            <span class="key-figure">{!! $block['key_figure'] !!}</span>
                                        @endif
                                        @if ($block['label'])
                                            <span class="label {{ $block['font-size'] }}">{!! $block['label'] !!}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if ($section['legend'])
            <div class="row justify-content-center mt-3">
                <div class="col-11 col-lg-12 text-center">
                    <p class="mb-0"><em style="font-size: 0.75rem">{!! $section['legend'] !!}</em></p>
                </div>
            </div>
        @endif
    </div>
</div>
