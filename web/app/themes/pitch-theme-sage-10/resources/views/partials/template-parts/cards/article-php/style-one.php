<div class="card-article style-one h-100">
  <div class="d-flex flex-column h-100 justify-content-between">
    <div class="bg-image"
         style="background-image: url(<?php echo $article['thumbnail']['url'] ?>);">
    </div>
    <div class="wrapper-content flex-grow-1 d-flex flex-column justify-content-between">
      <div>
        <div class="wrapper-details mb-4">
          <div class="d-flex flex-row">
            <span><?php echo $article['date'] ?></span>
            <span class="ms-1 me-1">-</span>
            <span><?php echo $article['category']->name ?></span>
          </div>
        </div>

        <h3 class="block-title">
          <?php echo $article['title'] ?>
        </h3>
        <p class="excerpt">
          <?php echo $article['excerpt'] ?>
        </p>
      </div>
      <?php if ($options_data['blog']['title_cta_article']) { ?>
        <div>
          <?php if ($article['post-type'] === 'case_study') { ?>
            <?php switch ($article['type']->term_id) {
              case 14 : ?>
                <a href="<?php echo $article['permalink'] ?>" class="btn btn-simple pdf">
                  <?php echo $options_data['blog']['title_cta_folder'] ?>
                </a>
                <?php break; ?>
              <?php default; ?>
                <a href="<?php echo $article['permalink'] ?>" class="btn btn-simple">
                  <?php echo $options_data['blog']['title_cta_article'] ?>
                </a>
              <?php } ?>
          <?php } else { ?>
            <a href="<?php echo $article['permalink'] ?>" class="btn btn-simple">
              <?php echo $options_data['blog']['title_cta_article'] ?>
            </a>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
