@switch ($section['selection'])
  @case('automatic')
    @php $products = getProducts(); @endphp
    @break
  @case('manual')
    @php $products = $section['product_selection'] @endphp
    @break
@endswitch
@if ($products)
  @if ($section['cta_slideshow'] === 'true' OR (!empty($section['cta_slideshow']) && $section['cta_group']['section_title_group']['title']))
    @php $bg = 'color'; @endphp
  @else
    @php $bg = 'white'; @endphp
  @endif
  <div id="section-{{ $row }}"
       class="section slideshow-products bg-{{ $bg }} {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    @if ($section['cta_slideshow'] === 'true' OR (!empty($section['cta_slideshow']) && $section['cta_group']['section_title_group']['title']))
      @include('partials.template-parts.section-cta-contact')
    @endif
    <div class="container">
      <div class="wrapper">
        @if (count($products) > 4)
          @php $arrow = true; @endphp
        @else
          @php $arrow = false; @endphp
        @endif
        @include('partials.template-parts.slideshow.wrapper-heading', ['arrow' => $arrow])
        <div class="row">
          <div class="col-9 col-sm-7 col-md-5 col-lg-4 col-xl-3 ps-sm-4 p-md-0">
            <div class="slideshow p-0">
              @foreach ($products as $product)
                @if ($section['selection'] === 'manual')
                  @php $post = getProductById($product); $product = $post[0]; @endphp
                @endif
                <div class="slide">
                  @include('partials.template-parts.cards.product')
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
