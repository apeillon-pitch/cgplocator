<header id="o-wrapper" class="banner">
  <div class="d-flex flex-row justify-content-between align-items-center">
    <div class="d-flex flex-row align-items-center">
      <div class="d-block d-md-none me-4 me-lg-0">
        <div id="menu-button">
          <div class="c-buttons">
            <a id="c-button--slide-right" class="hamburger c-button">
              <div class="top-bun"></div>
              <div class="meat"></div>
              <div class="bottom-bun"></div>
            </a>
          </div>
        </div>
      </div>
      <div class="toggle-switch-container">
        <div class="toggle-switch switch-vertical">
          <input id="toggle-a" type="radio" name="switch"/>
          <label for="toggle-a">Je suis un conseiller</label>
          <input id="toggle-b" type="radio" name="switch" checked="checked"/>
          <label for="toggle-b">Je suis un particulier</label>
          <span class="toggle-outside">
        <span class="toggle-inside"></span>
      </span>
        </div>
      </div>
    </div>
    <div class="d-flex">
      <a href="{{ home_url() }}">
        <img src="{!! $header_data['data']['logo']['url'] !!}" class="img-fluid logo d-block mx-auto"
             alt="{!! $header_data['data']['logo']['alt'] !!}">
      </a>
    </div>
    <div class="d-none d-md-flex flex-row align-items-center">
      @if($header_data['data']['cta_repeater'])
        <div
          class="d-none d-md-flex flex-column flex-lg-row justify-content-end align-items-end align-items-lg-center me-5 me-md-0">
          @foreach($header_data['data']['cta_repeater'] as $cta)
            @switch($cta['link_type'])
              @case('internal')
                <a href="{{ $cta['internal_link_url'] }}" target="_self"
                   class="{{ $cta['link_style'] }}  @php echo $cta['link_style'] === 'btn-primary' ? ' btn' : '' @endphp">{!! $cta['link_title'] !!}</a>
                @break
              @case('external')
                <a href="{{ $cta['external_link_url'] }}" target="_blank"
                   class="{{ $cta['link_style'] }} @php echo $cta['link_style'] === 'btn-primary' ? ' btn' : '' @endphp">{!! $cta['link_title'] !!}</a>
                @break
              @case('modal')
                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                   class="{{ $cta['link_style'] }} @php echo $cta['link_style'] === 'btn-primary' ? ' btn' : '' @endphp">{!! $cta['link_title'] !!}</a>
                @break
            @endswitch

          @endforeach
        </div>
      @endif
    </div>
  </div>
  @if($mainMenu)
    <div class="d-none d-md-flex flex-row justify-content-center mt-2">
      <div id="nav-wrapper">
        <nav class="nav-primary navbar navbar-expand-md">
          {!! wp_nav_menu($mainMenu) !!}
        </nav>
      </div>
    </div>
  @endif
</header>
@include('partials.template-parts.breadcrumb')
