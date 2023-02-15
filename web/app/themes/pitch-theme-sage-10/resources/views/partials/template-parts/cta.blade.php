@switch($item['link_type'])
    @case('internal')
    <a href="{{ $item['internal_link_url'] }}" class="btn {{ $class }}">
        <span>{!! $item['link_title'] !!}</span>
    </a>
    @break
    @case('external')
    <a href="{{ $item['external_link_url'] }}" class="btn {{ $class }}"
       target="_blank">
         <span>{!! $item['link_title'] !!}</span>
    </a>
    @break
@endswitch