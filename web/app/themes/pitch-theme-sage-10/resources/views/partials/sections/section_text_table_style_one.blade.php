@if($section['item_repeater'])
  <div id="section-{{ $row }}"
       class="section text-table style-two {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-11 col-lg-8">
          <div class="d-flex flex-column wrapper-section">
            <div class="wrapper-text d-flex flex-column">
              @foreach($section['item_repeater'] as $item)
                @if($item['menu_title'])
                  <a href="#subsection-{{ $row }}-{{ $loop->iteration }}">{!! $item['menu_title'] !!}</a>
                @endif
              @endforeach
            </div>
            <div class="wrapper-content">
              @foreach($section['item_repeater'] as $item)
                <div id="subsection-{{ $row }}-{{ $loop->iteration }}">
                  @if ($item['section_title']['title'])
                    <div class="heading-section d-flex flex-column">
                      @include('partials.template-parts.title', ['item' => $item['section_title'], 'class' => 'section-title'])
                    </div>
                  @endif
                  @if($item['content'])
                    @foreach($item['content'] as $content)
                      @if($content['acf_fc_layout'] == 'block_text')
                        {!! $content['text'] !!}
                      @elseif($content['acf_fc_layout'] == 'table')
                        <table class="table table-hover table-responsive">
                          <thead>
                          <tr>
                            @foreach($content['col_repeater'] as $col)
                              <th scope="col"><strong>{!! $col['title'] !!}</strong></th>
                            @endforeach
                          </tr>
                          </thead>
                          @php $col = count($content['col_repeater']) - 1; @endphp
                          <tbody>
                          @php $c = 0; @endphp
                          @foreach($content['col_repeater'][0]['row_repeater'] as $item)
                            <tr>
                              @for($i = 0; $i <= $col; $i++)
                                <td>
                                  {!! $content['col_repeater'][$i]['row_repeater'][$c]['text'] !!}
                                </td>
                            @endfor
                            <tr>
                            @php $c++ @endphp
                          @endforeach
                          </tbody>
                        </table>
                      @endif
                    @endforeach
                  @endif
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
