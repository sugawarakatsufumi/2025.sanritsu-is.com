<?php get_template_part('template-parts/header'); ?>
<?php if(have_posts()): ?>
  <?php while(have_posts()): the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; ?>
<?php endif; ?>
</section>
<?php get_template_part('template-parts/footer'); ?>