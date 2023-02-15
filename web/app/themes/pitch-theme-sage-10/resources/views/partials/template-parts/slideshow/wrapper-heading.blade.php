<div class="row justify-content-center justify-content-md-between">
    <div class="col-11 col-md-10 col-xl-8">
        <div class="heading-section @php echo ($section['introduction']) ? 'title-margin' : ''; @endphp">
            <div class="d-flex flex-column">
                @if ($section['section_title_group']['title'])
                    @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
                @endif
                @if ($section['introduction'])
                    <p class="mb-0">{!! $section['introduction'] !!}</p>
                @endif
            </div>
        </div>
    </div>
    @if ($arrow == true)
        <div class="d-none d-md-block col-md-2">
            <div class="slideshow-arrows">
                <div class="d-flex flex-row justify-content-end">
                    <li class="slick-arrow-prev">
                        <img src="{{ get_template_directory_uri() }}/resources/images/slick-next.svg">
                    </li>
                    <li class="slick-arrow-next">
                        <img src="{{ get_template_directory_uri() }}/resources/images/slick-next.svg">
                    </li>
                </div>
            </div>
        </div>
    @endif
</div>
