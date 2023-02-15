<div class="card-article style-one h-100">
    <div class="d-flex flex-column h-100 justify-content-between">
        <div class="bg-image"
             style="background-image: url(<?php $article['thumbnail']['url'] ?>);">
        </div>
        <div class="wrapper-content flex-grow-1 d-flex flex-column justify-content-between text-center">
            @if($article['title'])
                <h3 class="block-title">
                    <?php $article['title'] ?>
                </h3>
            @endif
            @if($article['excerpt'])
                <p class="excerpt">
                    <?php $article['excerpt'] ?>
                </p>
            @endif
            @if ($options_data['blog']['title_cta_article'])
                <div>
                    @if ($article['post-type'] === 'case_study')
                        @switch($article['type']->term_id)
                            @case (14)
                            <a href="<?php $article['permalink'] ?>" class="btn btn-animated pdf mx-auto">
                                <span style="background-color: #fff6f1"><?php $options_data['blog']['title_cta_folder'] ?></span>
                            </a>
                            @break
                            @default
                            <a href="<?php $article['permalink'] ?>" class="btn btn-animated mx-auto">
                                <span style="background-color: #fff6f1"><?php $options_data['blog']['title_cta_article'] ?></span>
                            </a>
                        @endswitch
                    @else
                        <a href="<?php $article['permalink'] ?>" class="btn btn-animated mx-auto">
                            <span style="background-color: #fff6f1"><?php $options_data['blog']['title_cta_article'] ?></span>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
