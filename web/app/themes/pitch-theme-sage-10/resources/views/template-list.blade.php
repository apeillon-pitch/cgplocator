{{--
  Template Name: Template list
--}}

@extends('layouts.app')

@switch ($template_list['post-type'])
    @case('post')
    @php $news = getNewsBlogList(); @endphp
    @break
    @case('case-study')
    @php $news = getCaseStudiesBlogList(); @endphp
    @break
@endswitch

@section('content')
    <div class="section hero style-two">
        <div class="bg-color pastelBlue"></div>
        <div class="wrapper-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-11 col-lg-8 text-center">
                        <h1 class="section-title">{!! get_the_title() !!}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        @switch ($template_list['post-type'])
            @case('post')
            @include('partials.template-parts.filters.blog-filters')
            @break
            @case('case-study')
            @include('partials.template-parts.filters.case-studies-filters')
            @break
        @endswitch

        <div id="results" class="row justify-content-center justify-content-md-start">
            @php $i = 1; @endphp
            @foreach($news as $article)
                @if ($news[0]['query']->query["paged"] <= 1)
                    @if ($i == 1)
                        <div class="d-none d-lg-block col-lg-12 mb-4 mb-lg-5">
                            @include('partials.template-parts.cards.article.style-two')
                        </div>
                        <div class="col-12 d-lg-none mb-4 mb-lg-5">
                            @include('partials.template-parts.cards.article.style-one')
                        </div>
                    @elseif($i > 1 && $i <= 5 )
                        <div class="col-12 col-md-6 mb-4 mb-lg-5">
                            @include('partials.template-parts.cards.article.style-one')
                        </div>
                    @elseif( $i > 5 )
                        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-5">
                            @include('partials.template-parts.cards.article.style-one')
                        </div>
                    @endif
                @else
                    @if($i >= 1 && $i <= 5 )
                        <div class="col-12 col-md-4 mb-4 mb-lg-5">
                            @include('partials.template-parts.cards.article.style-one')
                        </div>
                    @elseif( $i > 5 )
                        <div class="col-12 col-md-4 mb-4 mb-lg-5">
                            @include('partials.template-parts.cards.article.style-one')
                        </div>
                    @endif
                @endif
                @php $i++; @endphp
            @endforeach
            @if ($news)
                <div class="col-12 mt-5 mb-50">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <span class="mb-4">{{ $news[0]['query']->found_posts }} articles disponibles</span>
                        @php $url = get_the_permalink(); $query = $news[0]['query']; pagination_simple($query, $url); @endphp
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
