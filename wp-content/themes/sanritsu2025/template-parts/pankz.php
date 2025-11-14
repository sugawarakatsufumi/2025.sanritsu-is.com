<?php
global $post;
$separator = ""; // Simply change the separator to what ever you need e.g. / or >
//変数を言語別にセットする場合はこちら
if( preg_match('/en_US/',get_locale()) ){
  $productsList_ID =  '2563';
}elseif( preg_match('/th/',get_locale()) ){
  $productsList_ID =  '2564';
}else{
  $productsList_ID =  '25';
}
echo '<nav class="pankz"><ul temscope itemtype="http://schema.org/BreadcrumbList">';
if (!is_front_page()) {
  echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="';
  echo get_option('home')."/before/";
  echo '">';
  echo '<span itemprop="name">'.get_bloginfo('name').'</span>';
  echo "</a><meta itemprop='position' content='1' /></li> ".$separator;
  if(is_singular('product')){//製品詳細
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink($productsList_ID)."'>".'<span itemprop="name">'.get_the_title($productsList_ID)."</span></a><meta itemprop='position' content='2' /></li>";
    $goods_term = get_the_terms($post->ID, 'parts');
    $goods_term = $goods_term[0];
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_term_link($goods_term)."'>".'<span itemprop="name">'.__($goods_term->name)."</span></a><meta itemprop='position' content='3' /></li>";
    $goods_child_term = get_the_terms($post->ID, 'parts');
    $goods_child_term = $goods_child_term[0];
    //echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_term_link($goods_child_term)."'>".'<span itemprop="name">'.__($goods_child_term->name)."</span></a><meta itemprop='position' content='4' /></li>";
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
  }elseif(is_tax('goods')){//グッツ親分類
    $query_obj = get_queried_object();
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink($productsList_ID)."'>".'<span itemprop="name">'.__(get_the_title($productsList_ID))."</span></a><meta itemprop='position' content='2' /></li><li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'>"."<a href='".get_term_link($query_obj->slug,'goods')."' itemprop='item' ><span itemprop='name'>".__(single_term_title('',false))."</span></a><meta itemprop='position' content='3' /></li>";
  }elseif(is_tax('goods_child')){//グッツ子分類
    $query_obj = get_queried_object();
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink($productsList_ID)."'>".'<span itemprop="name">'.__(get_the_title($productsList_ID))."</span></a><meta itemprop='position' content='2' /></li>";
    $goods_tax = get_posts(array(
      'posts_per_page' => 1,
      'post_type' => 'goodslist',
    ));
    $goods_tax = $goods_tax[0];
    $goods_tax = get_the_terms($post->ID, 'goods');
    $goods_tax = $goods_tax[0];
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_term_link($goods_tax)."'>".'<span itemprop="name">'.__($goods_tax->name)."</span></a><meta itemprop='position' content='3' /></li>";
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_term_link($query_obj->slug,'goods_child')."'>".'<span itemprop="name">'.__(single_term_title('',false))."</span></a><meta itemprop='position' content='4' /></li>";
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
  } elseif (is_404()) {
    echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'>"."404"."</li>";
  }
} else {
  echo "<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".get_the_permalink()."'>".'<span itemprop="name">'.get_bloginfo('name')."</span></a> <meta itemprop='position' content='2' /></li>";
}
echo '</ul></nav>';