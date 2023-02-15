<div class="card-article style-one h-100">
    <div class="d-flex flex-column h-100 justify-content-between">
        <div class="bg-image"
             style="background-image: url({{ $article['thumbnail']['url'] }});">
        </div>
        <div class="wrapper-content flex-grow-1 d-flex flex-column justify-content-between">
            <div>
                <div class="wrapper-details mb-4">
                    <div class="d-flex flex-row">
                        <span>{!! $article['date'] !!}</span>
                        <span class="ms-1 me-1">-</span>
                        @if ($article['category'])
                            <span>{!! $article['category']->name !!}</span>
                        @endif
                    </div>
                </div>

                @if($article['title'])
                    <h3 class="block-title">
                        {!! $article['title'] !!}
                    </h3>
                @endif
                @if($article['excerpt'])
                    <p class="excerpt">
                        {!! $article['excerpt'] !!}
                    </p>
                @endif
            </div>
            @if ($options_data['blog']['title_cta_article'])
                <div>
                    @if ($article['post-type'] === 'case_study')
                        @switch($article['type']->term_id)
                            @case (14)
                            <a href="{{ $article['permalink'] }}" class="btn btn-simple pdf">
                                {!! $options_data['blog']['title_cta_folder'] !!}
                            </a>
                            @break
                            @default
                            <a href="{{ $article['permalink'] }}" class="btn btn-simple">
                                {!! $options_data['blog']['title_cta_article'] !!}
                            </a>
                        @endswitch
                    @else
                        <a href="{{ $article['permalink'] }}" class="btn btn-simple">
                            {!! $options_data['blog']['title_cta_article'] !!}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
