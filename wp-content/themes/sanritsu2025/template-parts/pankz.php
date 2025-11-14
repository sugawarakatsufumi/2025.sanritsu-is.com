<?php
global $post;
$separator = ""; // Simply change the separator to what ever you need e.g. / or >
//変数を言語別にセットする場合はこちら
$productsList_ID =  '25';
if(is_tax('vending')){
  $productsList_ID =  '4841';
}
echo '<nav class="pankz"><ul temscope itemtype="http://schema.org/BreadcrumbList">';
if (!is_front_page()) {
  echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="';
  echo get_option('home')."/before/";
  echo '">';
  echo '<span itemprop="name">'.get_bloginfo('name').'</span>';
  echo "</a><meta itemprop='position' content='1' /></li> ".$separator;
  if(is_singular('product')){//製品詳細    
    $goods_term = get_the_terms($post->ID, 'parts');
    if(empty($goods_term) || is_wp_error($goods_term)){
      $goods_term = get_the_terms($post->ID, 'vending');
      $productsList_ID =  '4841';
    }
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink($productsList_ID)."'>".'<span itemprop="name">'.get_the_title($productsList_ID)."</span></a><meta itemprop='position' content='2' /></li>";
    if( ! empty($goods_term) && isset($goods_term[0]) && $goods_term[0]->parent != 0){
      $parent_term = get_term( $goods_term[0]->parent, $goods_term[0]->taxonomy );
      $parent_term_link = get_term_link( $parent_term->term_id );
      $parent_term_name = $parent_term->name;
      echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".$parent_term_link."'>".'<span itemprop="name">'.$parent_term_name."</span></a><meta itemprop='position' content='3' /></li>";
    }
    $goods_term = $goods_term[0];
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_term_link($goods_term)."'>".'<span itemprop="name">'.__($goods_term->name)."</span></a><meta itemprop='position' content='4' /></li>";
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink()."'>".'<span itemprop="name">'.__(get_the_title()).'</span>'."</a><meta itemprop='position' content='5' /></li>";
  }elseif ( is_category() || is_single() ) {//カテゴリー又は記事詳細
    echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $categories = get_the_category();
    echo '<a href="'.get_term_link($categories[0]->slug,'category').'" itemprop="item"><span itemprop="name">'.$categories[0]->name.'</span></a>';
    echo '<meta itemprop="position" content="2" /></li>';
    if ( is_single() ) {
      echo $separator;
      echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink()."'>".'<span itemprop="name">'.get_the_title()."</span></a><meta itemprop='position' content='3' /></li>";
    }
  }elseif(is_tax('parts') || is_tax('vending') ){//製品自販機パーツtax
    $query_obj = get_queried_object();
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink($productsList_ID)."'>".'<span itemprop="name">'.__(get_the_title($productsList_ID))."</span></a><meta itemprop='position' content='2' /></li>";
    $goods_term = get_term($query_obj->term_id, 'parts');
    if(empty($goods_term) || is_wp_error($goods_term)){
      $goods_term = get_term($query_obj->term_id, 'vending');
    }
    if( ! empty($goods_term) && isset($goods_term) && $goods_term->parent != 0){
      $parent_term = get_term( $goods_term->parent, $goods_term->taxonomy );
      $parent_term_link = get_term_link( $parent_term->term_id );
      $parent_term_name = $parent_term->name;
      echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".$parent_term_link."'>".'<span itemprop="name">'.$parent_term_name."</span></a><meta itemprop='position' content='3' /></li>";
    }
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_term_link($goods_term->term_id)."'>".'<span itemprop="name">'.__($goods_term->name)."</span></a><meta itemprop='position' content='4' /></li>";    
  }elseif ( is_page() && $post->post_parent ) {
    $home = get_page(get_option('page_on_front'));
    for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
      if (($home->ID) != ($post->ancestors[$i])) {
        echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="';
        echo __(get_permalink($post->ancestors[$i])); 
        echo '">';
        echo '<span itemprop="name">'.__(get_the_title($post->ancestors[$i])).'</span>';
        echo "</a><meta itemprop='position' content='2' /></li>".$separator;
      }
    }
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink()."'>".'<span itemprop="name">'.get_the_title()."</span></a><meta itemprop='position' content='3' /></li>";
  } elseif (is_page()) {
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink()."'>".'<span itemprop="name">'.get_the_title()."</span></a><meta itemprop='position' content='2' /></li>";
  } elseif (is_home()){
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink(get_option('page_for_posts'))."'>".'<span itemprop="name">'.get_the_title(get_option('page_for_posts'))."</span></a><meta itemprop='position' content='2' /></li>";
  } elseif (is_404()) {
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'>"."404"."</li>";
  }
} else {
  echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink()."'>".'<span itemprop="name">'.get_bloginfo('name')."</span></a> <meta itemprop='position' content='2' /></li>";
}
echo '</ul></nav>';