<div id="section-{{ $row }}"
     class="section cta-newsletter {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    @include('partials.template-parts.section-cta-contact')
    {{--@if($section['newsletter_group']['section_title_group']['title'] OR $section['newsletter_group']['introduction'])
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-lg-10">
                    <div class="wrapper-section-newsletter">
                        <div class="d-flex flex-column align-items-center text-center text-lg-start">
                            @if ($section['newsletter_group']['section_title_group']['title'])
                                @include('partials.template-parts.title', ['item' => $section['newsletter_group']['section_title_group'], 'class' => 'section-title text-center'])
                            @endif
                            @if ($section['newsletter_group']['introduction'])
                                <p class="mb-0">{!! $section['newsletter_group']['introduction'] !!}</p>
                            @endif
                            @if ($section['newsletter_group']['form_id'])
                                <div class="form-newsletter mb-4">
                                    {{ gravity_form( $section['newsletter_group']['form_id'], false, false, false, '', true, 12 ) }}
                                </div>
                                @if ($options_data['other']['legal_mention_newsletter'])
                                    <div class="newsletter-text-legal">{!! $options_data['other']['legal_mention_newsletter'] !!}</div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif--}}
</div>
