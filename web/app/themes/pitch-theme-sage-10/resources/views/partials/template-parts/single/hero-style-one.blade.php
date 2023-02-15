<div class="section hero default-article">
    <div class="bg-color pastelBlue"></div>
    <div class="wrapper-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-lg-8 text-center">
                    <div class="d-flex flex-column">
                        <div class="wrapper-details">
                            <div class="d-flex flex-row justify-content-center">
                                <span>{!! $article['date'] !!}</span>
                                <span class="ms-1 me-1">-</span>
                                @if ($article['category'])
                                    <span>{!! $article['category']->name !!}</span>
                                @endif
                            </div>
                        </div>
                        <div class="wrapper-heading title-margin">
                            @if ($article['title'])
                                <h1 class="section-title">{!! $article['title'] !!}</h1>
                            @endif
                            @if ($article['excerpt'])
                                <p class="excerpt">{!! $article['excerpt'] !!}</p>
                            @endif
                            <div id="social-networks" class="text-center">
                                @php
                                    $permalink = get_permalink();
                                    $title = get_the_title();
                                @endphp
                                <div class="d-flex flex-row justify-content-center">
                                    <div class="share-button st-custom-button ms-2 me-2 social"
                                         data-network="linkedin"><i class="fab fa-linkedin-in"></i>
                                    </div>
                                    <div class="share-button st-custom-button ms-2 me-2 social"
                                         data-network="facebook"><i class="fab fa-facebook"></i>
                                    </div>
                                    <div class="share-button st-custom-button ms-2 me-2 social"
                                         data-network="twitter"><i class="fab fa-twitter"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($article['thumbnail'])
                            <div class="bg-image"
                                 style="background-image: url({{ $article['thumbnail']['url'] }})"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>