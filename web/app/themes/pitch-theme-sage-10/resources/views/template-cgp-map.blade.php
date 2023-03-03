{{--
  Template Name: Template list CGP
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page-locator')
  @endwhile
@endsection
