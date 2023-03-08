<div class="cgp-card d-flex flex-column">
  <h2><?php echo $article['title']; ?></h2>
  <?php if ($article['address']) { ?>
    <p>
      <?php
      if ($article['address']['name']) {
        echo $article['address']['name'] . '<br>';
      }
      echo $article['address']['postal_code'] ? $article['address']['postal_code'] . ' ' : '';
      echo $article['address']['city'] ? $article['address']['city'] : '';
      ?>
    </p>
  <?php } ?>
  <div class="d-flex flex-row justify-content-between">
    <a href="<?php echo $article['permalink'] ?>" aria-label="Contacter le conseiller" class="btn btn-simple">
      Contacter le conseiller
    </a>
    <a href="<?php echo $article['permalink'] ?>"><i class="fa-solid fa-envelope"></i></a>
  </div>
</div>
