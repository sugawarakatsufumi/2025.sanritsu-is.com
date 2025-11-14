<div class="container">
  <section class="lower-section">
    <h1 class="lower-ttl-h1"><?php single_term_title(); ?></h1>
    <?php
    $description = term_description();
    if ( ! empty( $description ) ) {
      echo '<div class="lower-desc">' . $description . '</div>';
    }
    ?>
    <?php if ( have_posts() ) : ?>
      <div class="prod-item-list-wrap">
        <ul class="prod-item-list">
          <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part('template-parts/product-list-item'); ?>
          <?php endwhile; ?>
        </ul>
      </div>
    <?php else : ?>
      <p>商品がありません。</p>
    <?php endif; ?>
  </section>
  <?php get_template_part('template-parts/product-aside'); ?>
</div>