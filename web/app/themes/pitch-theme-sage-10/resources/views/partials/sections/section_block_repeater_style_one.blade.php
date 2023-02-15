<div id="section-{{ $row }}"
     class="section block-repeater style-one {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="heading-section  @php echo ($section['introduction']) ? 'title-margin ' . $section['style'] : $section['style']; @endphp">
                    <div class="d-flex flex-column text-center">
                        @if ($section['section_title_group']['title'])
                            @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
                        @endif
                        @if ($section['introduction'])
                            <p class="mb-0">{!! $section['introduction'] !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($section['block_repeater'])
            <div class="d-none d-lg-block">
                <div class="row justify-content-center">
                    @foreach ($section['block_repeater'] as $block)
                        <div class="col-12 col-lg-6 mb-4 ps-5 pe-5">
                            @switch($section['style'])
                                @case('style-one')
                                @include('partials.template-parts.block-repeater-style-one.style-one')
                                @break
                                @case('style-two')
                                @include('partials.template-parts.block-repeater-style-one.style-two')
                                @break
                            @endswitch
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-block d-lg-none">
                <div class="row justify-content-center">
                    <div class="col-11">
                        @php $i = 1; @endphp
                        <div class="accordion" id="accordion-{{ $row }}">
                            @foreach($section['block_repeater'] as $block)
                                <div class="accordion-item">
                                    <a class="accordion-button collapsed" data-bs-toggle="collapse"
                                       data-bs-target="#collapse-{{ $row }}-{{ $i }}" aria-expanded="false"
                                       aria-controls="collapse-{{ $row }}-{{ $i }}">
                                        @if ($block['image'])
                                            <img src="{{ $block['image']['url'] }}" alt="{!! $block['image']['alt'] !!}" class="me-4">
                                        @endif
                                        {!! $block['section_title_group']['title'] !!}
                                    </a>
                                    <div id="collapse-{{ $row }}-{{ $i }}" class="accordion-collapse collapse"
                                         aria-labelledby="heading-{{ $row }}-{{ $i }}" data-bs-parent="#accordion-{{ $row }}">
                                        <div class="accordion-body">
                                            {!! $block['text'] !!}
                                        </div>
                                    </div>
                                </div>
                                @php $i++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($section['cta_repeater'])
            <div class="wrapper-cta mt-4">
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