<div class="cgp-card d-flex flex-column">
  @php
    if(is_array($post)) {
      $id = $post['id'];
      $title = $post['title'];
    } else {
      $id = $post->ID;
      $title = $post->post_title;
    }
    $address = get_field('address', $id);
  @endphp
  <h2>{!! $title !!}</h2>
  @if ($address)
    <p>
      @if ($address['name'])
        {!! $address['name'] !!}<br>
      @endif
      @php echo $address['postal_code'] ?  $address['postal_code']. ' ' : ''; echo  $address['city'] ?  $address['city'] : ''; @endphp
    </p>
  @endif
  <div class="d-flex flex-row justify-content-between">
    <a href="{!! get_permalink($id) !!}" aria-label="Contacter le conseiller" class="btn btn-simple">
      Contacter le conseiller
    </a>
    <a href="{!! get_permalink($id) !!}"><i class="fa-solid fa-envelope"></i></a>
  </div>
</div>
