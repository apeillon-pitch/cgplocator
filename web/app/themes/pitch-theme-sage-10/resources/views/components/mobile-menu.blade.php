<nav id="c-menu--slide-right" class="c-menu c-menu--slide-right">
  <div class="container-fluid h-100">
    <div class="row justify-content-center">
      <div class="col-11">
        <div class="d-flex flex-row justify-content-between">
          <a href="{{ site_url() }}">
            <img src="{!! $header_data['data']['logo']['url'] !!}" class="img-fluid logo mx-auto d-block">
          </a>
          <button class="c-menu__close">
            <i class="fa-light fa-xmark"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="row justify-content-center h-100">
      <div class="col-11">
        <nav id="menu-mobile-data" class="nav-primary navbar">
          @if (has_nav_menu('primary_mobile_navigation'))
            {!! wp_nav_menu($mobilemenu) !!}
          @endif
        </nav>
        @if($header_data['data']['cta_repeater'])
          <div class="d-flex flex-column w-100">
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
  </div>
</nav>
<div id="c-mask" class="c-mask"></div>
