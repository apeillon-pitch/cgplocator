@if (is_singular('case_study'))
  @if ($article['type']->term_id == '14')
    @include('partials.template-parts.single.hero-style-two')
  @else
    @include('partials.template-parts.single.hero-style-one')
  @endif
@else
  @include('partials.template-parts.single.hero-style-one')
@endif

@if ($data['flexible-sections'])
  @php $row = 1 @endphp
  @foreach($data['flexible-sections'] as $section)
    @include('partials/sections/' . $section['acf_fc_layout'], ['row' => $row, 'section' => $section])
    @php $row++ @endphp
  @endforeach
@endif

@if (is_singular('case_study'))

  @php $post_per_page = 3; $id = get_the_ID(); $case_studies = getCaseStudiesByCategory($post_per_page, $article['category'], $id); @endphp
  @if ($case_studies)
    <div id="section-{{ $row }}" class="section slideshow-case-studies">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-11 col-lg-12">
            @if ($options_data['blog']['title_section_related_article'])
              <div class="row">
                <div class="col-12">
                  <div class="heading-section">
                    <h2 class="section-title">{!! $options_data['blog']['title_section_related_article'] !!}</h2>
                  </div>
                </div>
              </div>
            @endif
            @if($case_studies)
              <div class="row">
                <div class="col-9 p-0">
                  <div class="slideshow">
                    @foreach ($case_studies as $article)
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
              @if ($options_data['blog']['case_studies_link_url'])
                <div class="row">
                  <div class="col-12">
                    <div class="wrapper-cta mt-50">
                      <div class="d-flex flex-row justify-content-center">
                        <a href="{{ $options_data['blog']['case_studies_link_url'] }}"
                           class="btn btn-animated">
                          <span>{!! $options_data['blog']['title_cta_related_study_case'] !!}</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @endif
          </div>
        </div>
      </div>
    </div>
  @endif
@else
  <div class="section slideshow-related-news">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-11 col-lg-12">
          @if ($options_data['blog']['title_section_related_article'])
            <div class="row">
              <div class="col-12">
                <div class="heading-section">
                  <h2 class="section-title">{!! $options_data['blog']['title_section_related_article'] !!}</h2>
                </div>
              </div>
            </div>
          @endif

          @php $post_per_page = 3; $id = get_the_ID(); $articles = getNewsRelated($post_per_page, $article['category'], $id); @endphp

          @if ($articles)
            <div class="row">
              <div class="slideshow p-0">
                @foreach ($articles as $article)
                  <div class="slide">
                    @include('partials.template-parts.cards.article.style-one')
                  </div>
                @endforeach
              </div>
            </div>
            @if ($options_data['blog']['blog_link_url'])
              <div class="row">
                <div class="col-12">
                  <div class="wrapper-cta mt-50">
                    <div class="d-flex flex-row justify-content-center">
                      <a href="{{ $options_data['blog']['blog_link_url'] }}"
                         class="btn btn-animated">
                        @if (is_singular('case_study'))
                          <span style="background-color: #fff6f1;">{!! $options_data['blog']['title_cta_related_study_case'] !!}</span>
                        @else
                          <span style="background-color: #fff6f1;">{!! $options_data['blog']['title_cta_related_article'] !!}</span>
                        @endif
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endif
        </div>
      </div>
    </div>
  </div>
@endif
