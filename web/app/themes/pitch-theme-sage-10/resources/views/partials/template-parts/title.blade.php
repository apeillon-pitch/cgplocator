@php echo !empty($item['heading_value']) ? '<' . $item['heading_value'] . ' class="' . $class . '">' : '<span class="' . $class . '">'; @endphp
{!! $item['title'] !!}
@php echo !empty($item['heading_value']) ? '</' . $item['heading_value'] . '>' : '</span>'; @endphp