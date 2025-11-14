<?php get_template_part('template-parts/header'); ?>
<div class="container">
  <section class="lower-section">
    <h1 class="lower-ttl-h1">自販機パーツ取り扱い一覧</h1>
    <p class="lower-desc">自販機を安定させる固定金具やレベリングスクリューといった設置部材か　ら、ファンモーターやコインパネルなど、自販機の稼働に不可欠な各種パーツまで、幅広い製品をご提供しています。</p>
    <div class="prod-item-list-wrap">
      <?php
        $term_args = array(
          'taxonomy'   => 'parts',
          'fields'     => 'all',
          'hide_empty' => true,
          'parent'     => 0, 
          'orderby'    => 'name',
          'order'      => 'DESC',
        );
        $terms = get_terms( $term_args );
        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) :
          echo '<ul class="prod-item-list">';
          foreach ( $terms as $term ) :
            $term_link = esc_url( get_term_link( $term ) );
            $unit_str = '点';

            // --- 子カテゴリも含めた投稿数を取得（product 投稿タイプに限定）
            $child_ids = get_term_children( $term->term_id, 'parts' );
            $term_ids = array_merge( array( $term->term_id ), $child_ids ? $child_ids : array() );

            $count_query_args = array(
              'post_type'      => 'product',
              'posts_per_page' => 1,
              'tax_query'      => array(
                array(
                  'taxonomy' => 'parts',
                  'field'    => 'term_id',
                  'terms'    => $term_ids,
                  'operator' => 'IN',
                ),
              ),
              'no_found_rows'  => false,
              'fields'         => 'ids',
            );
            $count_q = new WP_Query( $count_query_args );
            $total_count = intval( $count_q->found_posts );
            wp_reset_postdata();
            // --- 件数取得ここまで

            echo '<li>';
            echo '<a href="' . $term_link . '">';

            // サムネイルは該当カテゴリに紐づく投稿を1件取得して表示
            $post_args = array(
              'post_type'      => 'product',
              'posts_per_page' => 1,
              'orderby'        => 'date',
              'tax_query'      => array(
                array(
                  'taxonomy' => 'parts',
                  'field'    => 'term_id',
                  'terms'    => $term->term_id,
                ),
              ),
            );
            $posts_array = get_posts( $post_args );
            echo '<figure class="prod-pic" data-title="' . esc_attr( $term->name ) . '">';
            if ( $posts_array ) :
              $post = $posts_array[0];
              setup_postdata( $post );
              $thumb = get_the_post_thumbnail_url( $post->ID, 'medium' );
              if ( $thumb ) {
                echo '<img src="' . esc_url( $thumb ) . '" alt="' . esc_attr( get_the_title( $post ) ) . '">';
              } else {
                echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/img/common/no-image.webp' ) . '" alt="no image">';
              }
              wp_reset_postdata();
            else :
              echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/img/common/no-image.webp' ) . '" alt="no image">';
            endif;
            echo '</figure>';

            echo '<h2 class="prod-title">' . esc_html( $term->name ) . ' (' . esc_html( $total_count ) . $unit_str . ')</h2>';
            echo '</a>';
            echo '</li>';
          endforeach;
          echo '</ul>';
        else :
          echo '<p>製品が見つかりません。</p>';
        endif;
      ?>
    </div><!--/.prod-item-list-wrap-->
  </section><!--/.lower-section-->
</div>
<?php get_template_part('template-parts/cta', null, ['catch' => '<span class="main-cta-ttl-line">欲しい商品はありましたか？<br class="pc-only">無い場合は気軽にご相談ください！</span>']); ?>
<?php get_template_part('template-parts/footer'); ?>