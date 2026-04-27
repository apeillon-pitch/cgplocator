<div id="section-{{ $row }}" class="section hero style-one four  {{ $section['padding_group']['padding_bottom']}}">
  <div class="wrapper-content">
    <div class="container-lg h-100">
      <div class="row justify-content-center justify-content-lg-start gx-0 h-100 align-items-center">
        <div class="col-10 col-lg-6 pe-0 order-2 order-lg-1 pb-4 pb-lg-0">
          <div class="d-flex flex-column text-center text-lg-start">
            @if ($section['section_title_group']['title'])
              @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title'])
            @endif
            @if ($section['introduction'])
              {!! $section['introduction'] !!}
            @endif
            @if ($section['cta_app_repeater'])
              <div class="wrapper-cta mt-2 mb-2">
                <div class="d-flex flex-row">
                  @foreach($section['cta_app_repeater'] as $cta)
                    <a href="{{ $cta['external_link_url'] }}" target="_blank" aria-label="App Store">
                      {!! wp_get_attachment_image( $cta['link_logo']['id'], 'full', '', array( "class" => "img-fluid me-3 mb-2") ) !!}
                    </a>
                  @endforeach
                </div>
              </div>
            @endif
            @if($section['link'])
              <div class="d-flex flex-row">
                <a href="{{ $section['link']['url'] }}" target="_blank" class="btn btn-primary">
                  {!! $section['link']['title'] !!}
                </a>
              </div>
            @endif
          </div>
        </div>
        <div class="col-12 col-lg-6 order-1 order-lg-2">
          <div class="d-flex flex-row justify-content-center justify-content-lg-end">
            <img src="{{ $section['image']['sizes']['large'] }}">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
