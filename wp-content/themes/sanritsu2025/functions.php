<?php
//define( 'MWFORM_DEBUG', true );

if ( ! function_exists( 'sanritsu_setup' ) ) :
	function sanritsu_setup() {
		load_theme_textdomain( 'sanritsu', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus();
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'sanritsu_setup' );

/*JS-CSSファイル読み込み*/
function sanritsu_scripts() {
	wp_enqueue_style( 'sanritsu-style', get_stylesheet_uri() );
	//wp_register_style( 'mw-wp-form' );
}
add_action( 'wp_enqueue_scripts', 'sanritsu_scripts' );

/*プラグイン関連不要JSを削除*/
function sanritus_plugin_scripts(){
	wp_dequeue_script( 'mw-wp-form' );
}
add_action( 'wp_footer', 'sanritus_plugin_scripts' );

/*固定ページ整形をOFF*/
function remove_wpautop() {
  if (is_page()) {
		remove_filter('the_content', 'wpautop');
		remove_filter('the_excerpt', 'wpautop');
  }
}
add_action( 'wp_head', 'remove_wpautop');

function my_mwform_enqueue_scripts() {
	wp_enqueue_script('test','test.css');
}
add_action( 'mwform_enqueue_scripts_mw-wp-form-xxx', 'my_mwform_enqueue_scripts' );

//カテゴリ1個しか選択出来ない様にする処理
function limit_category_select() {
	?>
	<script type="text/javascript">
		jQuery(function($) {
				// 投稿画面のカテゴリー選択を制限
				var cat_checklist = $('.categorychecklist input[type=checkbox]');
				cat_checklist.click( function() {
						$(this).parents('.categorychecklist').find('input[type=checkbox]').attr('checked', false);
						$(this).attr('checked', true);
				});
				
				// クイック編集のカテゴリー選択を制限
				var quickedit_cat_checklist = $('.cat-checklist input[type=checkbox]');
				quickedit_cat_checklist.click( function() {
						$(this).parents('.cat-checklist').find('input[type=checkbox]').attr('checked', false);
						$(this).attr('checked', true);
				});
				
				$('.categorychecklist>li:first-child, .cat-checklist>li:first-child').before('<p style="padding-top:5px;">カテゴリーは1つしか選択できません</p>');
		});
	</script>
	<?php
}
add_action( 'admin_print_footer_scripts', 'limit_category_select' );

//カスタムたくそのみーデフォルト設定
function add_default_term_setting_item() {
	$post_types = get_post_types( array( 'public' => true, 'show_ui' => true ), false );
	if ( $post_types ) {
		foreach ( $post_types as $post_type_slug => $post_type ) {
			$post_type_taxonomies = get_object_taxonomies( $post_type_slug, false );
			if ( $post_type_taxonomies ) {
				foreach ( $post_type_taxonomies as $tax_slug => $taxonomy ) {
					if ( ! ( $post_type_slug == 'post' && $tax_slug == 'category' ) && $taxonomy->show_ui ) {
						add_settings_field( $post_type_slug . '_default_' . $tax_slug, $post_type->label . '用' . $taxonomy->label . 'の初期設定' , 'default_term_setting_field', 'writing', 'default', array( 'post_type' => $post_type_slug, 'taxonomy' => $taxonomy ) );
					}
				}
			}
		}
	}
}
add_action( 'load-options-writing.php', 'add_default_term_setting_item' );


function default_term_setting_field( $args ) {
	$option_name = $args['post_type'] . '_default_' . $args['taxonomy']->name;
	$default_term = get_option( $option_name );
	$terms = get_terms( $args['taxonomy']->name, 'hide_empty=0' );
	if ( $terms ) : 
	?>
	<select name="<?php echo $option_name; ?>">
		<option value="0">設定しない</option>
		<?php foreach ( $terms as $term ) : ?>
		<option value="<?php echo esc_attr( $term->term_id ); ?>"<?php echo $term->term_id == $default_term ? ' selected="selected"' : ''; ?>><?php echo esc_html( $term->name ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php
	else:
	?>
	<p><?php echo esc_html( $args['taxonomy']->label ); ?>が登録されていません。</p>
	<?php
	endif;
}


function allow_default_term_setting( $whitelist_options ) {
	$post_types = get_post_types( array( 'public' => true, 'show_ui' => true ), false );
	if ( $post_types ) {
		foreach ( $post_types as $post_type_slug => $post_type ) {
			$post_type_taxonomies = get_object_taxonomies( $post_type_slug, false );
			if ( $post_type_taxonomies ) {
				foreach ( $post_type_taxonomies as $tax_slug => $taxonomy ) {
					if ( ! ( $post_type_slug == 'post' && $tax_slug == 'category' ) && $taxonomy->show_ui ) {
						$whitelist_options['writing'][] = $post_type_slug . '_default_' . $tax_slug;
					}
				}
			}
		}
	}
	return $whitelist_options;
}
add_filter( 'whitelist_options', 'allow_default_term_setting' );


function add_post_type_default_term( $post_id, $post ) {
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || $post->post_status == 'auto-draft' ) { return; }
	$taxonomies = get_object_taxonomies( $post, false );
	if ( $taxonomies ) {
		foreach ( $taxonomies as $tax_slug => $taxonomy ) {
			$default = get_option( $post->post_type . '_default_' . $tax_slug );
			if ( ! ( $post->post_type == 'post' && $tax_slug == 'category' ) && $taxonomy->show_ui && $default && ! ( $terms = get_the_terms( $post_id, $tax_slug ) ) ) {
				if ( $taxonomy->hierarchical ) {
					$term = get_term( $default, $tax_slug );
					if ( $term ) {
						wp_set_post_terms( $post_id, array_filter( array( $default ) ), $tax_slug );
					}
				} else {
					$term = get_term( $default, $tax_slug );
					if ( $term ) {
						wp_set_post_terms( $post_id, $term->name, $tax_slug );
					}
				}
			}
		}
	}
}
add_action( 'wp_insert_post', 'add_post_type_default_term', 10, 2 );


//カスタム投稿一覧taxonomyでソート機能
function custome_post_list_sort() {
	global $post_type, $locale;
	if ( $post_type !='goodslist' ){
		return "";
	}
	$taxonomy = 'goods_child';
	$terms = get_terms($taxonomy);
	if ( empty($terms) ) {
		return "" ;
	}
	$selected = get_query_var($taxonomy);
	$options = '';
	foreach ($terms as $term) {
		if(preg_match('/\[:ja\]([^\[\]]+)\[:/', $term->name, $term_name )){
			$term_name = $term_name[1];
		}else{
			$term_name =$term->name;
		}
		$options .= sprintf('<option value="%s" %s>%s</option>'
		,$term->slug
		,($selected==$term->slug) ? 'selected="selected"' : ''
		,$term_name
		);
	}
	$select = '<select name="%s"><option value="">小カテゴリー選択</option>%s</select>';
	printf($select, $taxonomy, $options);
}
add_action('restrict_manage_posts', 'custome_post_list_sort');

function goods_desc_ja(){
    global $term, $taxonomy, $locale;
    if($taxonomy == "goods" && $locale=="ja"){
        $currentTaxonomy = $taxonomy;//カレントのtaxonomy
        $currentTerm = $term;//カレントのterm
        $postTypeName = 'goodslist';//投稿タイプの名前
        $taxonomy_for_desc = 'goods_child';//タクソノミー名
        $num = -1;//表示する投稿の数 -1で全部
        $terms = get_terms($taxonomy_for_desc);
        foreach( $terms as $term_for_desc ){
            $args = array(
            'posts_per_page' => $num,
            'post_type' => $postTypeName,
            'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => $taxonomy_for_desc,
                        'field' => 'slug',
                        'terms' => $term_for_desc->slug,
                    ),
                    array(
                        'taxonomy' => $currentTaxonomy,
                        'field' => 'slug',
                        'terms' => $currentTerm,
                    )
                )
            );
            $myPost = get_posts($args);
            //var_dump($myPost);
            if($myPost){
                $loop_flg = true;
                $loop_str .= __($term_for_desc->name)."、";
            }
        }
        if($loop_flg){
            $desc_str = preg_replace("/、$/","",$loop_str)."の詳細はこちら";
        }else{
            $desc_str = "";
        }
        echo '<meta name="description"  content="'.get_bloginfo('name')."の".single_term_title("",false)."一覧。".$desc_str.'">';
    }
}
add_filter( 'wp_head', 'goods_desc_ja');


function pagenation($pages = '', $range = 2){
  $showitems = ($range * 1)+1;
  global $paged;
  if(empty($paged)) $paged = 1;
  if($pages == ''){
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){
      $pages = 1;
    }
  }
  if(1 != $pages){
    // 画像を使う時用に、テーマのパスを取得
    $img_pass = get_template_directory_uri();
    echo "<div class=\"m-pagenation\">";

    // 「1/2」表示 現在のページ数 / 総ページ数
    // echo "<div class=\"m-pagenation__result\">". $paged."/". $pages."</div>";
    
    // 「前へ」を表示
     if($paged > 1) echo "<div class=\"m-pagenation__prev\"><a href='".get_pagenum_link($paged - 1)."'>前へ</a></div>";
    
    // ページ番号を出力
    echo "<ol class=\"m-pagenation__body\">\n";
    for ($i=1; $i <= $pages; $i++){
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
        echo ($paged == $i)? "<li class=\"current\">".$i."</li>": // 現在のページの数字はリンク無し
        "<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
      }
    }
    // [...] 表示
    // if(($paged + 4 ) < $pages){
    //     echo "<li class=\"notNumbering\">...</li>";
    //     echo "<li><a href='".get_pagenum_link($pages)."'>".$pages."</a></li>";
    // }
    echo "</ol>\n";
    // 「次へ」を表示
    if($paged < $pages) echo "<div class=\"m-pagenation__next\"><a href='".get_pagenum_link($paged + 1)."'>次へ</a></div>";
    echo "</div>\n";
  }
}
function my_body_class($classes){
  if (is_page()) {
    $page = get_post();
    $classes[] = $page->post_name;
  }
  return $classes;
}
add_filter('body_class', 'my_body_class');