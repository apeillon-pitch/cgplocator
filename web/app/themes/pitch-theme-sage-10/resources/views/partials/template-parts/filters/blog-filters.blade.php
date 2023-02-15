@if (isset($_COOKIE["category"]))
    @php $cookie_category = json_decode(stripslashes($_COOKIE["category"])) @endphp
@endif
@if (isset($_COOKIE["year"]))
    @php $cookie_year = json_decode(stripslashes($_COOKIE["year"])) @endphp
@endif
@if (isset($_COOKIE["month"]))
    @php $cookie_month = json_decode(stripslashes($_COOKIE["month"])) @endphp
@endif

<div id="wrapper-blog-filter" class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-between">
    <strong id="title" class="mb-4 mb-lg-0">
        @if (isset($_COOKIE["category"]) && $cookie_category != 'all')
            @php $term = get_term_by('id', $cookie_category, 'category'); @endphp
            {!! $term->name !!}
        @else
            Les dernières actualités
        @endif
    </strong>
    <form id="blog-filter">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
            @php
                $terms = get_terms( array(
                'taxonomy' => 'category',
                'hide_empty' => true,
                ));
            @endphp
            @if ($terms)
                <div class="d-flex flex-row align-items-center mb-2 mb-md-0">
                    <span class="d-block title">Catégorie :</span>
                    <div class="d-flex flex-row align-items-center">
                        <select id="category" class="form-select form-select-lg">
                            <option value="all"
                                    @php echo isset($cookie_category) && $cookie_category == 'all' ? 'selected' : ''; @endphp>
                                Sélectionner une catégorie
                            </option>
                            @foreach ($terms as $term)
                                <option
                                        value="{{ $term->term_id }}"
                                        @php echo isset($cookie_category) && $cookie_category == $term->term_id ? 'selected' : ''; @endphp>
                                    {!! $term->name !!}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <span class="d-block title">Accéder aux archives :</span>
                    <div class="d-flex flex-row align-items-center">
                        @php
                            $i = 1;
                            $month = strtotime('2022-01-01');
                            $end = strtotime('2022-12-31');
                        @endphp
                        <select id="month" class="form-select form-select-lg">
                            <option value="all" @php echo isset($cookie_month) && $cookie_month == 'all' ? 'selected' : ''; @endphp>
                                Mois
                            </option>
                            @while ($month < $end)
                                <option value="{{ $i }}"
                                        @php echo isset($cookie_month) && $cookie_month == $i ? 'selected' : ''; @endphp>
                                    @php setlocale( LC_TIME, 'fr_FR.utf8', 'fra' ); echo ucfirst(strftime("%B", $month)); @endphp
                                </option>
                                @php $month = strtotime("+1 month", $month); $i++; @endphp
                            @endwhile
                        </select>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        @php
                            $year = strtotime('2022-01-01');
                            $end = strtotime('today UTC');
                        @endphp
                        <select id="year" class="form-select form-select-lg">
                            <option
                                    value="all"
                                    @php echo isset($cookie_year) && $cookie_year == 'all' ? 'selected' : ''; @endphp>
                                Année
                            </option>
                            @while ($end > $year)
                                <option
                                        value="@php echo date('Y', $year); @endphp"
                                        @php echo isset($cookie_year) && $cookie_year ==  date('Y', $year) ? 'selected' : ''; @endphp>
                                    @php echo date('Y', $year), PHP_EOL; @endphp
                                </option>
                                @php $year = strtotime("+1 year", $year); @endphp
                            @endwhile
                        </select>
                    </div>
                </div>
            @endif
        </div>
        @if (isset($_COOKIE["category"][0]) OR isset($_COOKIE["year"][0]) OR isset($_COOKIE["month"][0]) )
            @if (json_decode(stripslashes($_COOKIE["category"])) != 'all' OR json_decode(stripslashes($_COOKIE["year"])) != 'all' OR json_decode(stripslashes($_COOKIE["month"])) != 'all')
                @php $class = 'd-block'; @endphp
            @else
                @php $class = 'd-none'; @endphp
            @endif
        @else
            @php $class = 'd-none'; @endphp
        @endif
        <div id="reset" class="{{ $class }}">
            <div class="d-flex flex-row justify-content-start justify-content-lg-end">
                <a href="">Effacer les filtres <i class="fa-light fa-circle-x"></i></a>
            </div>
        </div>
    </form>
</div>