<div class="d-flex flex-row style-two">
    @if ($block['image'])
        <div class="wrapper-picto">
            <img src="{{ $block['image']['url'] }}" alt="{!! $block['image']['alt'] !!}" class="img-fluid">
        </div>
    @endif
    <div class="d-flex flex-column">
        @if ($block['section_title_group']['title'])
            @include('partials.template-parts.title', ['item' => $block['section_title_group'], 'class' => 'block-title'])
        @endif
        @if ($block['text'])
            <p>{!! $block['text'] !!}</p>
        @endif
    </div>
</div>