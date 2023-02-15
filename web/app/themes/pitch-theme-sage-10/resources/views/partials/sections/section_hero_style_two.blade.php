<div id="section-{{ $row }}" class="section hero style-two {{ $section['padding_group']['padding_bottom']}}">
    <div class="bg-color {{ $section['bg_color'] }}"></div>
    <div class="wrapper-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-lg-8 text-center">
                    <div class="d-flex flex-column">
                        <div class="wrapper-heading @php echo ($section['introduction']) ? 'title-margin' : ''; @endphp">
                            @if ($section['logo'])
                                <img src="{!! $section['logo']['url'] !!}" alt="{!! $section['logo']['alt'] !!}" class="img-fluid logo mb-4">
                            @endif
                            @if ($section['section_title_group']['title'])
                                @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
                            @endif
                            @if ($section['introduction'])
                                {!! $section['introduction'] !!}
                            @endif
                        </div>
                        @if ($section['image'])
                            <div class="bg-image" style="background-image: url({{ $section['image']['url'] }})"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>