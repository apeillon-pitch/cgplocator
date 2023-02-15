@if ($data['flexible-sections'])
    @php $row = 1 @endphp
    @foreach($data['flexible-sections'] as $section)
        @include('partials/sections/' . $section['acf_fc_layout'], ['row' => $row, 'section' => $section])
        @php $row++ @endphp
    @endforeach
@endif
