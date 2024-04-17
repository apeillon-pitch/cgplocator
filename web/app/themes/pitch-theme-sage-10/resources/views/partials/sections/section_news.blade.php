<div id="section-{{ $row }}"
     class="section slideshow-news {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        <div class="row justify-content-center justify-content-lg-between">
            <div class="col-11 col-md-10 col-xl-8">
                <div class="heading-section">
                    @if ($section['section_title_group']['title'])
                        @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title' . ' mb-0'])
                    @endif
                </div>
            </div>
            <div class="d-none d-md-block d-lg-none col-md-2">
                <div class="slideshow-arrows">
                    <div class="d-flex flex-row justify-content-end">
                        <li class="slick-arrow-prev">
                            <img src="{{ get_template_directory_uri() }}/assets/images/slick-next.svg">
                        </li>
                        <li class="slick-arrow-next">
                            <img src="{{ get_template_directory_uri() }}/assets/images/slick-next.svg">
                        </li>
                    </div>
                </div>
            </div>
        </div>
        @switch ($section['selection'])
            @case('automatic')
            @php $post_per_page = 3; $news = getNews($post_per_page); @endphp
            @break
            @case('manual')
            @php $news = $section['news_selection'] @endphp
            @break
        @endswitch
        @if ($news)
            <div class="row">
                <div class="col-8 col-sm-9 col-md-7 col-lg-5 col-xl-4 p-lg-0">
                    <div class="slideshow">
                        @foreach ($news as $article)
                            @if ($section['selection'] === 'manual')
                                @php $post = getNewsById($article); $article = $post[0]; @endphp
                            @endif
                            <div class="slide">
                                @include('partials.template-parts.cards.article.style-one')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if ($section['cta_repeater'])
                <div class="row">
                    <div class="col-12">
                        <div class="wrapper-cta mt-50">
                            <div class="d-flex flex-row justify-content-center">
                                @foreach($section['cta_repeater'] as $cta)
                                    <div>
                                        @include('partials.template-parts.cta', ['item' => $cta, 'class' => $cta['link_style'] . ' ms-2 me-2'])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
