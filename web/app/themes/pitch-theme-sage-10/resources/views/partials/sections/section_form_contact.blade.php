<div id="section-contact-form"
     class="section contact-form {{ $section['padding_group']['padding_top'] }} {{ $section['padding_group']['padding_bottom']}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-12">
                <div class="wrapper">
                    <div class="row justify-content-center">
                        <div class="col-11 col-lg-8 text-center">
                            @if ($section['section_title_group']['title'])
                                @include('partials.template-parts.title', ['item' => $section['section_title_group'], 'class' => 'section-title ' . $section['section_title_group']['style']])
                            @endif
                        </div>
                        <div class="col-11 col-lg-8">
                            @if ($section['form_id'])
                                {{ gravity_form( $section['form_id'], false, false, false, '', true, 12 ) }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>