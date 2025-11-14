<?php
class utilShortcodeRender {
  public static function sanritsuNewsList( $atts ) {
    $atts = shortcode_atts( array(), $atts, 'sanritsu_news_list' );
    $output = '<ul class="news-list">';
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'orderby'   => 'date',
        'order'     => 'DESC',
        'category_name' => 'news',
    );
    $title_length = 40; // タイトルの文字数制限
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $title = get_the_title();
            if (mb_strlen($title) > $title_length) {
              $truncated_title = mb_substr($title, 0, $title_length) . '...';
              $title = esc_html($truncated_title);
            } else {
              $title = esc_html($title);
            }
            $output .= '<li class="news-list__item">';
            $output .= '<a href="' . esc_url( get_permalink() ) . '">';
            $output .= '<span class="news-date">' . get_the_date( 'Y/m/d' ) . '</span>';
            $output .= '<p class="news-text"><span>' . $title . '</span></p>';
            $output .= '</a>';
            $output .= '</li>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<li class="news-list__item">ニュースはありません。</li>';
    }
    $output .= '</ul>';
    return $output;
  }
  public static function sanritsuMediaList( $atts ) {
    $atts = shortcode_atts(
      array(
        'view_mode'=>'init'
      ), 
      $atts, 
      'sanritsu_media_list'
    );
    $output = '<ul class="media-list">';
    // WP_Queryで投稿を取得
    $args = [
      'post_type' => 'post',
      'posts_per_page' => 4,
      'order'     => 'DESC',   // 降順 (新しい順)
      'category_name' => 'pages',
    ];
    if($atts["view_mode"] == 'recommend'){
      $args['meta_key'] = 'recommend_flag';
      $args['orderby'] = ['date' => 'DESC', 'meta_value_num'=>'DESC'];
      $args['meta_query'] = [
        'key' => 'recommend_flag',
        'value' => '1',
        'compare' => '='
      ];
    }else{
      $args['orderby'] = 'date';
    }
    $query = new WP_Query( $args );
    $title_length = 46; // タイトルの文字数制限
    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post();
        $title = get_the_title();
        if (mb_strlen($title) > $title_length) {
          $truncated_title = mb_substr($title, 0, $title_length) . '...';
          $title = esc_html($truncated_title);
        } else {
          $title = esc_html($title);
        }
        $output .= '<li class="media-list__item list-item-large hover-img-zoom-up">';
        $output .= '<a href="' . esc_url( get_permalink() ) . '" class="media-link">';
        if ( has_post_thumbnail() ) {
            $output .= '<figure class="media-list__item-image">';
            $output .= get_the_post_thumbnail( get_the_ID(), 'medium' ); // アイキャッチ画像を表示
            $output .= '</figure>';
        }else{
          $output .= '<figure class="media-list__item-image">';
          $output .= '<img src="/wp-content/plugins/wako2025/assets/img/OGP.webp" alt='.$title.'サムネール ">';
          $output .= '</figure>';
        }
        $output .= '<div class="media-list__item-content">';
        $output .= '<h3 class="media-list__item-ttl">' . $title . '</h3>';
        $output .= '</div>';
        $output .= '<p class="pc-only media-list__item-btn wk-btn-secondary">さらに詳しくはこちら<i class="wk-icon-right-arrow"></i></p>';
        $output .= '</a>';
        $output .= '</li>';
      }
      wp_reset_postdata(); // クエリの影響をリセット
    } else {
      $output .= '<li class="media-list__item">メディアはありません。</li>';
    }
    $output .= '</ul>';
    return $output;
  }
  public static function sanritsuMediaWPPList( $atts ) {
    // 属性のデフォルト値 (ここでは何も設定しない)
    $atts = shortcode_atts( array(), $atts, 'sanritsu_media_wpp_list' );
    $output = '<ul class="media-list">';
    $args = array(
        'limit' => 4,
        'range' => 'all',
        'order_by' => 'views',
        'post_type' => 'post',
        'cat' => '2'
    );
    $wpp_query = new \WordPressPopularPosts\Query($args);
    $wpp_posts = $wpp_query->get_posts();
    $title_length = 46; // タイトルの文字数制限 (元のコードに合わせて46)
    if ($wpp_posts) {
      foreach ($wpp_posts as $post) { 
        $title = get_the_title($post->id);
        if (mb_strlen($title) > $title_length) {
          $truncated_title = mb_substr($title, 0, $title_length) . '...';
          $title = esc_html($truncated_title);
        } else {
          $title = esc_html($title);
        }
        $output .= '<li class="media-list__item list-item-large hover-img-zoom-up">';
        $output .= '<a href="' . esc_url(get_permalink($post->id)) . '" class="media-link">';
        if (has_post_thumbnail($post->id)) {
          $output .= '<figure class="media-list__item-image">';
          $output .= get_the_post_thumbnail($post->id, 'medium'); // アイキャッチ画像を表示
          $output .= '</figure>';
        } else {
          $output .= '<figure class="media-list__item-image">';
          $output .= '<img src="/wp-content/plugins/wako2025/assets/img/OGP.webp" alt="' . $title . ' サムネール">';
          $output .= '</figure>';
        }
        $output .= '<div class="media-list__item-content">';
        $output .= '<h3 class="media-list__item-ttl">' . $title . '</h3>';
        $output .= '</div>';
        $output .= '<p class="pc-only media-list__item-btn wk-btn-secondary">さらに詳しくはこちら<i class="wk-icon-right-arrow"></i></p>';
        $output .= '</a>';
        $output .= '</li>';
      }
    } else {
      $output .= '<li class="media-list__item">人気のメディアはありません。</li>';
    }
    $output .= '</ul>';
    return $output;
  }
}
?>