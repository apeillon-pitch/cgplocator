@include('partials.template-parts.single.hero-style-three')

<div id="section-1" class="section form-cgp">
  <div class="container">
    @if ($cgp['email'])
      <div class="wrapper bg-pastel">
        <div class="row justify-content-center">
          @if ($cgp['cgp-options']['form_title'])
            <div class="col-11 col-lg-7 text-center">
              <h2 class="section-title mb-5 ms-5 me-5">{!! $cgp['cgp-options']['form_title'] !!}</h2>
            </div>
          @endif
          <div class="col-11 col-lg-8">
            @php echo do_shortcode('[gravityforms id="3" title="false" field_values="company=' . get_the_title() . '&email=' . $cgp['email'] . '"]') @endphp
          </div>
        </div>
        @endif
      </div>
  </div>
</div>
