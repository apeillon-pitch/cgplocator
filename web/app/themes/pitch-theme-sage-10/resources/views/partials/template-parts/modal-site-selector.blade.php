@if ($options_data['modal_site_selector'])
  <div id="site-selector" class="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
       aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-6 col-sm-7 col-lg-12 text-center">
              <img src="@asset('images/nortia-white.svg')" alt="" class="img-fluid mb-5 pb-4">
            </div>
            @if ($options_data['modal_site_selector']['block_repeater'])
              @foreach($options_data['modal_site_selector']['block_repeater'] as $item)
                <div class="col-12 col-md-6 text-center mb-5 pb- mb-md-0">
                  <div class="wrapper-block bg-{{ $item['bg_color'] }} h-100">
                    @if ($item['icon'])
                      <div class="wrapper-icon">
                        <img src="{!! $item['icon']['url'] !!}" class="img-fluid" alt="{!! $item['icon']['alt'] !!}">
                      </div>
                    @endif
                    <div class="d-flex flex-column h-100 justify-content-between">
                      @if ($item['title'])
                        <strong>{!! $item['title'] !!}</strong>
                      @endif
                      @if ($item['link_title'])
                        <div>
                          @switch($item['current_link_url'])
                            @case(true)
                              <a class="btn btn-primary text-center" data-bs-dismiss="modal"
                                 aria-label="Close">{!! $item['link_title'] !!}</a>
                              @break
                            @default
                              <a href="{{ $item['link_url'] }}"
                                 class="btn btn-primary text-center">{!! $item['link_title'] !!}</a>
                          @endswitch
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
          @if ($options_data['modal_site_selector']['mention'])
            <div class="row mt-sm-4">
              <div class="col-12 text-white">
                <p>{!! $options_data['modal_site_selector']['mention'] !!}</p>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endif
