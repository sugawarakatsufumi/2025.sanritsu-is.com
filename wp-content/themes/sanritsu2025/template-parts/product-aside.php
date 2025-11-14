<aside class="aside">
  <nav class="side-prod-nav">
   <?php
      // 現在のタクソノミー・ターム取得
      $queried_term = null;
      if ( is_tax() ) {
        $queried_term = get_queried_object();
        $taxonomy = $queried_term->taxonomy;
      } elseif ( is_singular() ) {
        $terms = get_the_terms( get_the_ID(), 'parts' );
        $queried_term = ( ! empty( $terms ) && ! is_wp_error( $terms ) ) ? $terms[0] : null;
        $taxonomy = $queried_term ? $queried_term->taxonomy : 'parts';
      } else {
        $taxonomy = 'parts';
      }
      // 表示用の見出し（タクソノミー名）
      $tax_obj = get_taxonomy( $taxonomy );
      $tax_name = $tax_obj ? $tax_obj->labels->name : 'カテゴリ';
    ?>
    <h2><i class="sr-icon-category"></i>&nbsp;<?php echo esc_html( $tax_name ); ?></h2>
    <?php
      $term_parents_args = array(
        'taxonomy'   => $taxonomy,
        'parent'     => 0,
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'DESC',
      );
      $terms = get_terms( $term_parents_args );
      if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) :
        foreach ( $terms as $term ) :
          $link = esc_url( get_term_link( $term ) );
          $label = esc_html( $term->name );
          $term_link = esc_url( get_term_link( $term ) );
          // --- 子カテゴリも含めた投稿数を取得（product 投稿タイプに限定）
          $child_ids = get_term_children( $term->term_id, $taxonomy );
          $term_ids = array_merge( array( $term->term_id ), $child_ids ? $child_ids : array() );
          $count_query_args = array(
            'post_type'      => 'product',
            'posts_per_page' => 1,
            'tax_query'      => array(
              array(
                'taxonomy' => $taxonomy,
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
          ?>
          <a href="<?php echo $link; ?>" class="cat-child"><?php echo $label; ?>(<?php echo $total_count; ?>件)</a>
          <?php
        endforeach;
      else :
        echo '<p>カテゴリが見つかりません。</p>';
      endif;
    ?>
  </nav>
</aside>