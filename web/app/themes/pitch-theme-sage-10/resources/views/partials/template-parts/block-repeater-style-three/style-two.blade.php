<div class="row justify-content-center style-two">
    <div class="col-12 col-lg-5 @php echo $block['position'] == 'left' ? 'order-1' : 'order-1 order-lg-2' @endphp">
        <div class="bg-image" style="background-image: url({!! $block['image']['url'] !!})">
        </div>
    </div>
    <div class="col-12 col-lg-6 @php echo $block['position'] == 'left' ? 'order-2' : 'order-2 order-lg-1' @endphp">
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
                                    @include('partials.template-parts.cta', ['item' => $cta, 'class' => $cta['link_style'] . ' mt-3'])
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>