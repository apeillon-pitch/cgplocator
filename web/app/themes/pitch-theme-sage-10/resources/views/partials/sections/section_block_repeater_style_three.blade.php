<div id="section-{{ $row }}" class="section block-repeater style-three {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        @if ($section['section_title_group']['title'] OR $section['introduction'])
            <div class="row justify-content-center">
                <div class="col-11 col-lg-12">
                    <div class="heading-section  @php echo ($section['introduction']) ? 'title-margin' : ''; @endphp">
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
        @endif
        @if ($section['block_repeater'])
            @foreach ($section['block_repeater'] as $block)
                @switch ($section['style'])
                    @case('style-one')
                    @include('partials.template-parts.block-repeater-style-three.style-one')
                    @break
                    @case('style-two')
                        @include('partials.template-parts.block-repeater-style-three.style-two')
                    @break
                @endswitch
            @endforeach
        @endif
    </div>
</div>