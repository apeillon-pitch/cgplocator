@switch ($section['selection'])
    @case('automatic')
    @php $case_studies = getCaseStudies(); @endphp
    @break
    @case('manual')
    @php $case_studies = $section['study_case_selection'] @endphp
    @break
@endswitch
@if ($case_studies)
    <div id="section-{{ $row }}"
         class="section slideshow-case-studies {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
        <div class="container">
            <div class="wrapper">
                @if (count($case_studies) > 1)
                    @php $arrow = true; @endphp
                @else
                    @php $arrow = false; @endphp
                @endif
                @include('partials.template-parts.slideshow.wrapper-heading', ['arrow' => $arrow])
                <div class="row">
                    <div class="col-10 col-lg-9 ps-3 p-md-0">
                        <div class="slideshow">
                            @foreach ($case_studies as $article)
                                @if ($section['selection'] === 'manual')
                                    @php $post = getCaseStudyById($article); $article = $post[0]; @endphp
                                @endif
                                <div class="slide">
                                    <div class="d-none d-lg-block h-100">
                                        @include('partials.template-parts.cards.study-case')
                                    </div>
                                    <div class="d-block d-lg-none h-100">
                                        @include('partials.template-parts.cards.article.style-one')
                                    </div>
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
            </div>
        </div>
    </div>
@endif