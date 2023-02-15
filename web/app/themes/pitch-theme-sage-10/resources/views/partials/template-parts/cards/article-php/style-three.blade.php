<div class="card-article style-two">
    <div class="row h-100">
        <div class="col-6">
            <div class="wrapper-content h-100">
                <div class="d-flex flex-column justify-content-center h-100">
                    <div class="wrapper-details">
                        <div class="d-flex flex-row">
                            <span class="me-1">Actualité </span>
                            @if ($article['category'])
                                <span> - {!! $article['category']->name !!}</span>
                            @endif
                        </div>
                    </div>
                    @if($article['title'])
                        <h3 class="slide-title">
                            {!! $article['title'] !!}
                        </h3>
                    @endif
                    @if($article['excerpt'])
                        <p class="excerpt">
                            {!! $article['excerpt'] !!}
                        </p>
                    @endif
                    @if ($options_data['blog']['title_cta_article'])
                        <div>
                            <a href="{{ $article['permalink'] }}" class="btn btn-animated">
                                <span style="background-color: #fff6f1">{!! $options_data['blog']['title_cta_article'] !!}</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bg-image h-100"
                 style="background-image: url({{ $article['thumbnail']['url'] }});">
            </div>
        </div>
    </div>
</div>
