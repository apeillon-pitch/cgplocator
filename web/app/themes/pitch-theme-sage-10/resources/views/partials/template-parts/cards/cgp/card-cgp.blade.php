<div class="cgp-card d-flex flex-column">
  @php
    $address = get_field('address', $post->ID);
  @endphp
  <h2>{!! $post->post_title !!}</h2>
  @if ($address)
    <p>
      @if ($address['name'])
        {!! $address['name'] !!}<br>
      @endif
      @php echo $address['postal_code'] ?  $address['postal_code']. ' ' : ''; echo  $address['city'] ?  $address['city'] : ''; @endphp
    </p>
  @endif
  <div class="d-flex flex-row justify-content-between">
    <a href="{!! get_the_permalink($post->ID) !!}" aria-label="Contacter le conseiller" class="btn btn-simple">
      Contacter le conseiller
    </a>
    <a href="{!! get_the_permalink($post->ID) !!}"><i class="fa-solid fa-envelope"></i></a>
  </div>
</div>
