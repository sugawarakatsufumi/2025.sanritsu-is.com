<?php get_template_part('template-parts/header'); ?>
<div class="container">
  <section class="lower-section width-col1">
    <?php if(have_posts()): ?>
      <?php while(have_posts()): the_post(); ?>
        <h1 class="lower-ttl-h1"><?php the_title(); ?></h1>
        <div class="post-meta">
          <span class="post-category">
            <?php
              $categories = get_the_category();
              if ( ! empty( $categories ) ) {
                echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="post-category">';
                echo '<i class="bi bi-folder"></i>&nbsp;' . esc_html( $categories[0]->cat_name );
                echo '</a>';
              }
            ?>
          </span>　
          <span class="post-date">
            <?php echo '<i class="bi bi-clock"></i>&nbsp;'.get_the_date('Y.m.d'); ?>
          </span>
        </div>
        <div class="cms-content-inner">
          <?php the_content(); ?>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
    <a href="/contents/" class="sr-btn-secondary">一覧に戻る<i class="sr-icon-right-arrow"></i></a>
  </section>
</div>
<?php get_template_part('template-parts/footer'); ?>