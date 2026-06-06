@if (!empty($siteAlert))
  <aside class="site-alert" data-site-alert data-site-alert-id="{{ esc_attr($siteAlert['id']) }}" role="region" aria-label="Alerte du site">
    <div class="site-alert__inner">
      <div class="site-alert__content">
        <p class="site-alert__title">{{ $siteAlert['title'] }}</p>
        <div class="site-alert__text">
          {!! wp_kses_post($siteAlert['text']) !!}
        </div>
      </div>
      <button class="site-alert__close" type="button" data-site-alert-close aria-label="Fermer le bandeau d'alerte">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </aside>
@endif
