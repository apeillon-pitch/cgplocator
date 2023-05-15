<div class="modal fade" id="disclaimerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex flex-row w-100 justify-content-between align-items-center">
          <div class="d-flex">
            @if ($options_data['modal_disclaimer']['title'])
              <span class="section-title">{!! $options_data['modal_disclaimer']['title'] !!}</span>
            @endif
          </div>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-light fa-xmark"></i>
          </button>
        </div>
      </div>
      <div class="modal-body">
        @if ($options_data['modal_disclaimer']['text'])
          {!! $options_data['modal_disclaimer']['text'] !!}
        @endif
        @if ($options_data['modal_disclaimer']['label_btn'])
          <button class="btn btn-primary" data-bs-dismiss="modal"
                  aria-label="Close">{!! $options_data['modal_disclaimer']['label_btn'] !!}</button>
        @endif
      </div>
    </div>
  </div>
</div>
