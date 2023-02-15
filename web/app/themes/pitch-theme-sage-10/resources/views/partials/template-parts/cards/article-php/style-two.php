
<div class="card-article style-two">
  <div class="row h-100">
    <div class="col-6">
      <div class="wrapper-content h-100">
        <div class="d-flex flex-column justify-content-center h-100">
          <div class="wrapper-details">
            <div class="d-flex flex-row">
              <span><?php echo $article['date'] ?></span>
              <span class="ms-1 me-1">-</span>
              <?php if ($article['category']) { ?>
                <span><?php echo $article['category']->name ?></span>
              <?php } ?>
            </div>
          </div>
          <?php if ($article['title']) { ?>
            <h3 class="slide-title">
              <?php echo $article['title'] ?>
            </h3>
          <?php } ?>
          <?php if ($article['excerpt']) { ?>
            <p class="excerpt">
              <?php echo $article['excerpt'] ?>
            </p>
          <?php } ?>
          <?php if ($options_data['blog']['title_cta_article']) { ?>
            <div>
              <?php if ($article['post-type'] === 'case_study') { ?>
                <?php switch ($article['type']->term_id) {
                  case 14 : ?>
                    <a href="<?php echo $article['permalink'] ?>" class="btn btn-animated pdf">
                      <span><?php echo $options_data['blog']['title_cta_folder'] ?></span>
                    </a>
                    <?php break; ?>
                  <?php default; ?>
                    <a href="<?php echo $article['permalink'] ?>" class="btn btn-animated">
                      <span><?php echo $options_data['blog']['title_cta_article'] ?></span>
                    </a>
                  <?php } ?>
              <?php } else { ?>
                <a href="<?php echo $article['permalink'] ?>" class="btn btn-animated">
                  <span><?php echo $options_data['blog']['title_cta_article'] ?></span>
                </a>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="bg-image h-100"
           style="background-image: url(<?php echo $article['thumbnail']['url'] ?>);">
      </div>
    </div>
  </div>
</div>
