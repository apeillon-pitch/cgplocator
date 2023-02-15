<div id="section-{{ $row }}" class="section block-repeater style-four {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        <div class="row justify-content-center justify-content-lg-start">
            @if ($section['block_repeater'])
                @foreach ($section['block_repeater'] as $block)
                    <div class="col-11 col-lg-6 block">
                        @if ($block['block_title_group']['title'])
                            @include('partials.template-parts.title', ['item' => $block['block_title_group'], 'class' => 'section-title'])
                        @endif
                        @if($block['text'])
                            {!! $block['text'] !!}
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>