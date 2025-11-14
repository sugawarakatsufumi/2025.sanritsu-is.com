<li>
  <a href="<?php echo esc_url( get_permalink() ); ?>">
    <figure class="prod-pic" data-title="<?php echo esc_attr( get_the_title() ); ?>">
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
      <?php else : ?>
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/common/no-image.webp' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
      <?php endif; ?>
    </figure>
    <h2 class="prod-title"><?php the_title(); ?></h2>
  </a>
</li>