<footer class="content-info overflow-hidden">
  <div class="container">
    <div class="d-flex flex-column flex-lg-row justify-content-between">
      <div class="d-flex flex-column col ps-lg-0 pe-lg-4">
        <a href="{{ home_url() }}">
          <img src="{!! $footer_data['data']['first_col_group']['logo']['url'] !!}" class="img-fluid logo"
               alt="{!! $footer_data['data']['first_col_group']['logo']['alt'] !!}">
        </a>
        @if ($footer_data['data']['first_col_group']['text'])
          <h6 class="baseline">{!! $footer_data['data']['first_col_group']['text'] !!}</h6>
        @endif
        @if ($footer_data['data']['first_col_group']['social_network_repeater'])
          <div class="d-flex flex-row">
            @foreach ($footer_data['data']['first_col_group']['social_network_repeater'] as $item)
              <a href="{{ $item['link_url'] }}" target="_blank">
                <img src="{{ $item['logo']['url'] }}" class="me-2 mt-2"
                     alt="{!! $item['logo']['alt'] !!}">
              </a>
            @endforeach
          </div>
        @endif
      </div>
      @if ($footer_data['data']['col_repeater'])
        @foreach($footer_data['data']['col_repeater'] as $col)
          <div class="d-flex flex-column col pe-1">
            <div class="wrapper">
              @if ($col['title'])
                <span class="title">{!! $col['title'] !!}</span>
              @endif
              <ul>
                @foreach($col['link-repater'] as $link)
                  @switch($link['link_type'])
                    @case('internal')
                      @php $target = "self"; $url = $link['internal_link_url'] @endphp
                      @break
                    @case('external')
                      @php $target = "blank";  $url = $link['external_link_url'] @endphp
                      @break
                  @endswitch
                  <li><a href="{{ $url }}" target="_{{ $target }}">{!! $link['link_title'] !!}</a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        @endforeach
      @endif
    </div>
    <div class="legal-section">
      <div class="d-flex flex-column flex-lg-row align-items-center justify-content-lg-between">
        @if ($footer_data['data']['copyright'])
          <span>{!! $footer_data['data']['copyright'] !!}</span>
        @endif
        <div class="d-flex flex-column flex-lg-row align-items-center">
          @foreach( $footer_data['data']['link_repeater'] as $link)
            <a href="{!! $link['link_url'] !!}">{!! $link['link_title'] !!}</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</footer>
@include('components.mobile-menu')
@include('partials.template-parts.modal-login')
@include('partials.template-parts.modal-site-selector')
