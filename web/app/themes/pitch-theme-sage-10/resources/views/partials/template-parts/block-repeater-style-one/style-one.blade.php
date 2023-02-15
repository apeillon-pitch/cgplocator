<div class="d-flex flex-column text-center">
    @if ($block['image'])
        <div class="wrapper-image">
            <img src="{{ $block['image']['url'] }}" alt="{!! $block['image']['alt'] !!}">
        </div>
    @endif
    @if ($block['section_title_group']['title'])
        @include('partials.template-parts.title', ['item' => $block['section_title_group'], 'class' => 'block-title'])
    @endif
    @if ($block['text'])
        <p>{!! $block['text'] !!}</p>
    @endif
</div>