<?php
/*
Plugin Name: sanritsu2025 機能拡張プラグイン
Description: ※ACFに依存します 機能:AuthorThumbnail表示 SeoDesc管理 OGP管理 canonical表示 json表示 SeoTitle表示 パンクズを[pnkz]で表示 管理画面一覧におすすめ記事の表示 共通コンテンツ
Author: カッツプロダクション 菅原勝文
Version: 1.0
*/
class sanritsu2025Plugin {
  public function __construct(){
    add_shortcode( 'sanritsu_news_list', array($this, 'sanritsu_news_list') );
    add_filter( 'wp_unique_post_slug', array($this,'custom_auto_post_slug'), 10, 4 );
  }
  // ニュースリストをレンダリングするメソッド
  public function sanritsu_news_list($atts) {
    require_once dirname( __FILE__ ) . '/includes/util-shortcode-render.php';
    return utilShortcodeRender::sanritsuNewsList($atts);
  }
  // %postname%の時のみ有効 slug自動生成の形式をpost-[id] に変更 日本語URL防止対策
  public function custom_auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( $post_type == 'post' ) {
      $slug = 'post-' . $post_ID;
    }
    return $slug;
  }
  //フィードにnoindexを追加
  public function set_noindex_for_header() {
    if (is_feed() && !headers_sent()) {
      header('X-Robots-Tag: noindex, nofollow', true);
    }
  }
}

$base_information = new sanritsu2025Plugin();

//keniの共通コンテンツを移植 関数被りを防ぐために変数名をkeni_cc_customと変更
require_once dirname( __FILE__ ) . '/includes/common-content.php';