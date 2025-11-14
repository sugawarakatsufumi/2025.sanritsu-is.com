<?php
/*
Template Name: 拡張1カラムページ(ギャラリー表示)
*/
?>
<?php get_template_part('template-parts/header'); ?>
<div class="container">
  <section class="lower-section width-col1">
    <?php if(have_posts()): ?>      
      <?php while(have_posts()): the_post(); ?>
        <h1 class="lower-ttl-h1"><?php the_title(); ?></h1>
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
          <?php the_content(); ?>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>
</div>
<?php if(is_page('wrapping-vm')): ?>
  <?php get_template_part('template-parts/cta', null, ['catch' => '<span class="main-cta-ttl-line">ラッピング実績多数！</span><br class="sp-only"><span class="main-cta-ttl-line">気軽にご相談ください</span>']); ?>
<?php elseif(is_page('original-label-sticker')): ?>
  <?php get_template_part('template-parts/cta', null, ['catch' => '<span class="main-cta-ttl-line">訴求力のあるダミーラベルで売上倍増！</span><br class="sp-only"><span class="main-cta-ttl-line">気軽にご相談ください</span>']); ?>
<?php endif; ?>
<?php get_template_part('template-parts/footer'); ?>