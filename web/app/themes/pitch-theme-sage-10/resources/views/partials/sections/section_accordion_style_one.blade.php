<div id="section-{{ $row }}"
     class="section section-accordion style-one {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-10 text-center">
                @if ($section['section_title_group']['title'])
                    @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
                @endif
            </div>
            <div class="col-11 col-lg-10 mt-50">
                @php $i = 1; @endphp
                <div class="accordion" id="accordion-{{ $row }}">
                    @foreach($section['block_repeater'] as $block)
                        <div class="accordion-item">
                            <{{ $block['section_title_group']['heading_value'] }} class
                            ="accordion-header mb-0" id="heading-{{ $row }}-{{ $i }}">
                            <a class="accordion-button collapsed @php echo empty($block['text']) ? 'empty-text' : '' @endphp" data-bs-toggle="collapse"
                               data-bs-target="#collapse-{{ $row }}-{{ $i }}" aria-expanded="false"
                               aria-controls="collapse-{{ $row }}-{{ $i }}">
                                <span>@php echo ($i < 10) ? '0' . $i . '.' : $i .'.' @endphp </span>{!! $block['section_title_group']['title'] !!}
                            </a>
                        </{{ $block['section_title_group']['heading_value'] }}>
                        @if ( $block['text'])
                            <div id="collapse-{{ $row }}-{{ $i }}" class="accordion-collapse collapse"
                                 aria-labelledby="heading-{{ $row }}-{{ $i }}" data-bs-parent="#accordion-{{ $row }}">
                                <div class="accordion-body">
                                    {!! $block['text'] !!}
                                </div>
                            </div>
                        @endif
                </div>
                @php $i++; @endphp
                @endforeach
            </div>
        </div>
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