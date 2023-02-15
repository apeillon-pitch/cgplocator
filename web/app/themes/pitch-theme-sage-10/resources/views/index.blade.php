@extends('layouts.app')

@section('content')
  <div class="section hero style-two">
    <div class="bg-color pastelBlue"></div>
    <div class="wrapper-content">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-11 col-lg-8 text-center">
            @if (is_post_type_archive('case_study'))
              <h1 class="section-title">Nos analyses d'experts.</h1>
            @else
              <h1 class="section-title">L'actualité Nortia.</h1>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    @if (!have_posts())
      <div class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
      {!! get_search_form(false) !!}
    @endif
    <div id="results" class="row justify-content-center justify-content-md-start">
      @php $i = 1; @endphp
      @while (have_posts()) @php the_post() @endphp
      @php $post_type = get_post_type(get_the_id()) @endphp
      @if ($post_type === 'case_study')
        @php
          $article = [
              'title' => get_the_title(),
              'type' => get_field('type'),
              'permalink' => get_the_permalink(),
              'post-type' => get_post_type($post->ID),
              'thumbnail' => get_field('thumbnail'),
              'date' => get_the_date(),
              'category' => get_field('category'),
              'excerpt' => get_field('excerpt'),
          ];
        @endphp
      @elseif($post_type === 'post')
        @php
          $article = [
              'title' => get_the_title(),
              'permalink' => get_the_permalink(),
              'post-type' => get_post_type($post->ID),
              'thumbnail' => get_field('thumbnail'),
              'date' => get_the_date(),
              'category' => get_field('category'),
              'excerpt' => get_field('excerpt'),
          ];
        @endphp
      @endif
      @if ($i == 1)
        <div class="d-none d-lg-block col-lg-12 mb-4">
          @include('partials.template-parts.cards.article.style-two')
        </div>
        <div class="col-11 col-lg-none mb-4">
          @include('partials.template-parts.cards.article.style-one')
        </div>
      @elseif($i > 1 && $i <= 5 )
        <div class="col-11 col-md-6 mb-4">
          @include('partials.template-parts.cards.article.style-one')
        </div>
      @elseif($i > 1 && $i > 5 )
        <div class="col-11 col-md-6 col-lg-4 mb-4">
          @include('partials.template-parts.cards.article.style-one')
        </div>
      @endif
      @php $i++; @endphp
      @endwhile
    </div>

    {!! get_the_posts_navigation() !!}
  </div>


@endsection
