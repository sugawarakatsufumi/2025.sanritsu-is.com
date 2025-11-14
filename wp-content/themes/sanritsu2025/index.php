<?php get_template_part('template-parts/header'); ?>
<div class="container">
  <section class="lower-section width-col1">
    <?php if(is_404()): ?>
      <h1 class="lower-ttl-h1">ページが見つかりません</h1>
      <p>404ページエラーです。</p>
    <?php else: ?>
      <h1 class="lower-ttl-h1">
        <?php
          if ( is_category() ) {
            // カテゴリーアーカイブ
            single_cat_title();
          } elseif ( is_tag() ) {
            // タグアーカイブ
            single_tag_title();
          } elseif ( is_search() ) {
            // 検索結果ページ
            echo '「' . get_search_query() . '」の検索結果';
          } elseif ( is_day() ) {
            echo get_the_date('Y年m月d日') . ' の記事一覧';
          } elseif ( is_month() ) {
            echo get_the_date('Y年m月') . ' の記事一覧';
          } elseif ( is_year() ) {
            echo get_the_date('Y年') . ' の記事一覧';
          } elseif ( is_author() ) {
            echo '投稿者: ' . get_the_author();
          } elseif ( is_post_type_archive() ) {
            post_type_archive_title();
          } elseif ( is_tax() ) {
            single_term_title();
          } else {
            echo '新着情報';
          }
        ?>
      </h1>
      <?php if(have_posts()): ?>
        <ul class="cms-contents-list">
          <?php while(have_posts()): the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <i class="sr-icon-arrow-circle-right"></i>
                <time><?php the_time('y.m.d'); ?></time>
                <?php
                  $categories = get_the_category();
                  if ( ! empty( $categories ) ) {
                    echo '<span class="cms-contents-list-category"><i class="bi bi-folder"></i>&nbsp;'.esc_html( $categories[0]->cat_name ).'</span>';
                  }
                ?>
                <span class="cms-contents-list-title-text"><?php the_title(); ?></span>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
        <?php pagenation(); ?>
      <?php endif; ?>
    <?php endif; ?>
  </section>
</div>
<?php get_template_part('template-parts/footer'); ?>