<?php get_template_part('template-parts/header'); ?>
<?php
$term = get_queried_object();
$is_parent = false;

$child_terms = get_terms([
  'taxonomy'   => $term->taxonomy,
  'parent'     => $term->term_id,
  'hide_empty' => true,
  'fields'     => 'ids',
]);

if ( isset( $term->term_id ) && ! empty( $term->taxonomy ) ) {
  if ( $term->parent == 0 ) {
    $is_parent = true;
  } else {
    $is_parent = false;
  }
  if($is_parent && empty($child_terms)){
    //echo '親で子termなし';
    get_template_part('template-parts/product-taxonomy-other');
  }elseif ( $is_parent && !empty($child_terms) ) {
    //echo '親で子termあり';
    get_template_part('template-parts/product-taxonomy-parent');
  } else {
    //echo 'else';
    get_template_part('template-parts/product-taxonomy-other');
  }
}
?>
<?php get_template_part('template-parts/footer'); ?>