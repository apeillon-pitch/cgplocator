<div id="section-{{ $row }}" class="section title-text-cta style-one">
  <div class="container">
    <div class="wrapper">
      <div class="row justify-content-center">
        <div class="col-11 col-lg-6 col-xxl-5 text-center mb-3">
            @if ($section['section_title_group']['title'])
              @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
            @endif
        </div>
        <div class="col-11 col-lg-8 text-center">
          <div class="d-flex flex-column">
            @if ($section['text'])
              {!! $section['text'] !!}
            @endif
            @if ($section['cta_repeater'])
              <div class="wrapper-cta mt-4">
                <div
                  class="d-flex flex-row justify-content-center {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
                  @foreach($section['cta_repeater'] as $cta)
                    <div>
                      @include('partials.template-parts.cta', ['item' => $cta, 'class' => $cta['link_style'] . ' ms-2 me-2'])
                    </div>
                  @endforeach
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
