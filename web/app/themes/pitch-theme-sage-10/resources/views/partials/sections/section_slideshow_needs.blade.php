@switch ($section['selection'])
    @case('automatic')
    @php $needs = getNeeds(); @endphp
    @break
    @case('manual')
    @php $needs = $section['need_selection'] @endphp
    @break
@endswitch
@if ($needs)
    <div id="section-{{ $row }}" class="section slideshow-needs {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
        <div class="container">
            <div class="wrapper">
                @if (count($needs) > 3)
                    @php $arrow = true; @endphp
                @else
                    @php $arrow = false; @endphp
                @endif
                @include('partials.template-parts.slideshow.wrapper-heading', ['arrow' => $arrow])
                <div class="row">
                    <div class="col-8 col-sm-9 col-md-7 col-lg-5 col-xl-4 p-md-0">
                        <div class="slideshow">
                            @foreach ($needs as $slide)
                                @if ($section['selection'] === 'manual')
                                    @php $post = getNeedById($slide); $slide = $post[0]; @endphp
                                @endif
                                <div class="slide">
                                    @include('partials.template-parts.cards.need')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif