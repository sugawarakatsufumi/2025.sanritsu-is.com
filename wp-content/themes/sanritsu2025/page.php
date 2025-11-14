<?php get_template_part('template-parts/header'); ?>
<div class="container">
  <section class="lower-section width-col1">
    <?php if(have_posts()): ?>
      <?php while(have_posts()): the_post(); ?>
        <h1 class="lower-ttl-h1"><?php the_title(); ?></h1>
        <div class="cms-content-inner">
          <?php the_content(); ?>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>
</div>
<?php get_template_part('template-parts/footer'); ?>