<?php get_template_part('template-parts/header'); ?>
<div class="container">
  <section class="lower-section">
    <h1 class="lower-ttl-h1"><?php the_title(); ?></h1>
    <div class="prod-cta-btn-wrap">
      <a class="sr-btn-primary" href="<?php echo get_the_permalink(124)."?post_id=".$post->ID; ?>">製品の見積もりお問い合わせへ<i class="sr-icon-right-arrow"></i></a>
    </div>
    <?php
      $images = get_field('goods_gallery');
      if ( $images ) {
        $img_counter    = 1;
        $goods_gallery  = '<figure class="product-gallery" id="product-gallery">' . "\n";
        foreach ( $images as $image ) {
          if ( $img_counter == 1 ) {
            $alt_title = get_the_title();
          } else {
            $alt_title = get_the_title() . $img_counter;
          }
          $full_size_img   = wp_get_attachment_image_url( $image['ID'], 'full' );
          $thumbnail_img   = $full_size_img; // ※必要であればリサイズ処理を入れてください
          $goods_gallery  .= "<a href='" . esc_url($full_size_img) . "' data-type=\"image\" data-fancybox='gallery'>";
          $goods_gallery  .= "<img src='" . esc_url($thumbnail_img) . "' alt='" . esc_attr($alt_title) . "'>";
          $goods_gallery  .= "</a>\n";
          $img_counter++;
        }
        $goods_gallery .= "</figure>\n";
      } else {
        $goods_gallery = "";
      }
      echo $goods_gallery;
    ?>
    <div class="cms-content-inner">
      <?php
        $terms = get_the_terms( get_the_ID(), 'parts' );
        if ( $terms && ! is_wp_error( $terms ) ) {
          $term = $terms[0]; // 最初のタームを使用（複数ある場合は必要に応じて調整）
          if ( ! empty( $term->description ) ) : ?>
            <aside class="product-outline-description">
              <h2><?php echo $term->name; ?>概要</h2>
              <p><?php echo $term->description; ?></p>
            </aside>
          <?php endif;
        }
      ?>
      <?php echo the_content(); ?>
    </div>
    <div class="prod-cta-btn-wrap">
      <a class="sr-btn-primary" href="<?php echo get_the_permalink(124)."?post_id=".$post->ID; ?>">製品の見積もりお問い合わせへ<i class="sr-icon-right-arrow"></i></a>
    </div>
  </section>
  <?php get_template_part('template-parts/product-aside'); ?>
</div>
<?php get_template_part('template-parts/footer'); ?>