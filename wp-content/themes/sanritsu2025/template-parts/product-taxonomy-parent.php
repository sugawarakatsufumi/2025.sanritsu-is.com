<div class="container">
  <section class="lower-section">
    <h1 class="lower-ttl-h1"><?php single_term_title(); ?></h1>
    <?php
    $description = term_description();
    if ( ! empty( $description ) ) {
      echo '<div class="lower-desc">' . $description . '</div>';
    }
    ?>
    <?php
      $queried_term = get_queried_object();
      if ( $queried_term && ! is_wp_error( $queried_term ) ) {
        $child_args = array(
          'taxonomy'   => $queried_term->taxonomy,
          'parent'     => $queried_term->term_id,
          'hide_empty' => true,
          'orderby'    => 'name',
          'order'      => 'DESC',
        );
        $children = get_terms( $child_args );
          if ( ! is_wp_error( $children ) && ! empty( $children ) ) {
            echo '<dl class="prod-child-list">
            <dt><i class="sr-icon-category"></i>&nbsp' . single_term_title('', false) . ' カテゴリー別</dt>
            <dd>';
            foreach ( $children as $child ) {
              $link  = esc_url( get_term_link( $child ) );
              $count = intval( $child->count );
              echo '<a href="' . $link . '">' . esc_html( $child->name ) . ' (' . $count . "点" . ')</a>';
            }
            echo '</dd></dl>';
          } else {
            echo '';
          }
        } else {
          echo '';
      }
    ?>
    <?php
      $queried_term = get_queried_object();
      if ( $queried_term && ! is_wp_error( $queried_term ) ) {
        $child_args = array(
          'taxonomy'   => $queried_term->taxonomy,
          'parent'     => $queried_term->term_id,
          'hide_empty' => true,
          'orderby'    => 'name',
          'order'      => 'DESC',
        );
        $children = get_terms( $child_args );
          if ( ! is_wp_error( $children ) && ! empty( $children ) ) {
            foreach ( $children as $child ) {
              $link  = esc_url( get_term_link( $child ) );
              $count = intval( $child->count );
              echo '<h2 class="lower-ttl-h2">'.esc_html( $child->name ).' (' . $count . '点' . ')'.'</h2>';
              // 子カテゴリ内の投稿を取得（最大9件取得して8件超えを判定）
              $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 13,
                'tax_query'      => array(
                  array(
                    'taxonomy' => $child->taxonomy,
                    'field'    => 'term_id',
                    'terms'    => $child->term_id,
                  ),
                ),
              );
              $query = new WP_Query( $args );
              if ( $query->have_posts() ) {
                $count = $query->found_posts;
                $link  = esc_url( get_term_link( $child ) );
                echo '<div class="prod-item-list-wrap">';
                echo '<ul class="prod-item-list">';
                $i = 0;
                while ( $query->have_posts() && $i < 12 ) {
                  $query->the_post();
                  get_template_part( 'template-parts/product-list-item' );
                  $i++;
                }
                echo '</ul>';

                // もし10件以上あるなら「一覧はこちら」リンクを表示
                if ( $count > 13 ) {
                  echo '<a class="sr-btn-secondary" href="' . $link . '">一覧はこちら<i class="sr-icon-right-arrow"></i></a>';
                }

                echo '</div>';
                wp_reset_postdata();
              }

            }
          } else {
            echo '';
          }
        } else {
          echo '';
      }
    ?>
  </section>
  <?php get_template_part('template-parts/product-aside'); ?>
</div>