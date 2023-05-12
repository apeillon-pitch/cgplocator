<div class="modal fade" id="disclaimerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex flex-row w-100 justify-content-between align-items-center">
                    <div class="d-flex">
                        <a href="{{ site_url() }}">
                            <img src="{!! $header_data['data']['logo']['url'] !!}" class="img-fluid logo"
                                 alt="{!! $header_data['data']['logo']['alt'] !!}">
                        </a>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-light fa-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        @if ($options_data['modal_login']['group_repeater'])
                            @foreach($options_data['modal_login']['group_repeater'] as $group)
                                @if($group['section_title'])
                                    <div class="col-12 text-center">
                                        <span class="section-title">{!! $group['section_title'] !!}</span>
                                    </div>
                                @endif
                                @foreach($group['link_repeater'] as $block)
                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="wrapper d-flex flex-column h-100 justify-content-between">
                                            @if ($block['title'])
                                                <h3 class="block-title">{!! $block['title'] !!}</h3>
                                            @endif
                                            @if ($block['text'])
                                                <p>{!! $block['text'] !!}</p>
                                            @endif
                                            @if ($block['link_url'] && $block['link_title'])
                                                <div>
                                                    <a href="{{ $block['link_url'] }}" class="btn btn-primary arrow" target="_blank">
                                                        {!! $block['link_title'] !!}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
