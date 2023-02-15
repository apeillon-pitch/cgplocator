@switch ($section['selection'])
    @case('folder')
    @php $articles = getCaseStudyById($section['study_case_selection'][0]); @endphp
    @break
    @case('article')
    @php $articles = getNewsById($section['article_selection'][0]); @endphp
    @break
@endswitch
@if ($articles)
    <div id="section-{{ $row }}"
         class="section promote-case-studies {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
        <div class="container">
            <div class="wrapper">
                <div class="row justify-content-center">
                    @foreach ($articles as $article)
                        <div class="d-none d-lg-block col-12">
                            @switch ($section['selection'])
                                @case('folder')
                                @include('partials.template-parts.cards.study-case-style-two')
                                @break
                                @case('article')
                                @include('partials.template-parts.cards.article.style-three')
                                @break
                            @endswitch
                        </div>
                        <div class="d-block d-lg-none col-11">
                            @include('partials.template-parts.cards.article.style-four')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif