<?php
/* Javascript読み込み設定 */
if (!is_admin()) {
	function register_script(){
		wp_register_script('rem', get_template_directory_uri().'/js/rem.js');
		wp_register_script('drawr', get_template_directory_uri().'/js/drawr.js');
		wp_register_script('tel', get_template_directory_uri().'/js/tel.js');
	}
	function add_script() {
		register_script();
			wp_enqueue_script('jquery');
			wp_enqueue_script('rem');

		if (wp_is_mobile()) {
			wp_enqueue_script('drawr');
			wp_enqueue_script('tel');
		}
	}
	add_action('wp_print_scripts', 'add_script');
}


/* CSS読み込み管理 */
function register_style() {
	wp_register_style('style', get_template_directory_uri().'/style.css');
	wp_register_style('commonCss', get_template_directory_uri().'/css/common.css');
	wp_register_style('iconCss', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
}
	function add_stylesheet() {
		// 共通
		register_style();
			wp_enqueue_style('style');
			wp_enqueue_style('commonCss');
			wp_enqueue_style('iconCss');
/*		// トップページ (ID=home)
		if (is_page(array('home'))) {
			wp_enqueue_style('home');
		}
		// ブログ (ID=blog)
		elseif (is_page(array('blog'))) {
			wp_enqueue_style('blog');
		}
		// お問い合わせ (ID=contact)
		elseif (is_page(array('contact'))) {
			wp_enqueue_style('contact');
		}*/
	}
add_action('wp_print_styles', 'add_stylesheet');


/* 読み込みバージョン除去 */
function remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );


/* wp_titleのアクションフック（タイトルタグ表示設定） */
function titlefunc_wp_title( $title, $sep ) {
	global $paged, $page;// ページ番号を追加するときに使う

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.	訳：「一般設定」管理画面で指定したブログのタイトルを追加
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'titlefunc_wp_title', 10, 2 );


/* headタグ内整理 */
remove_action('wp_head', 'wp_generator');//WordPressのバージョンを非表示


/* ショートコード追加 */
//phpファイルinclude
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}

add_shortcode('myphp', 'Include_my_php');

function Include_my_php_child($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_stylesheet() . "/$file.php");
    return ob_get_clean();
}

add_shortcode('myphp_child', 'Include_my_php_child');

// 相対パスショートコード設定
add_shortcode( 'tp', 'shortcode_tp' );
function shortcode_tp( $atts, $content = '' ) {
	return get_template_directory_uri().$content;
}// get_template_directory_uri()

add_shortcode( 'ctp', 'shortcode_ctp' );
function shortcode_ctp( $atts, $content = '' ) {
	return get_stylesheet_directory_uri().$content;
}//get_stylesheet_directory_uri()

add_shortcode( 'alink', 'shortcode_alink' );
function shortcode_alink( $atts, $alink = '' ) {
	return home_url('/').$alink;
}// home_url('/')



/* ウィジェット */
if (function_exists('register_sidebar')) {

register_sidebar(array(
 'name' => 'サイドバー1',
 'id' => 'sidebar1',
 'description' => 'サイドバーその1',
 'before_widget' => '<div>',
 'after_widget' => '</div>',
 'before_title' => '<h1 class="widget-title">',
 'after_title' => '</h1>'
));

register_sidebar(array(
 'name' => 'サイドバー2',
 'id' => 'sidebar2',
 'description' => 'サイドバーその2',
 'before_widget' => '<div>',
 'after_widget' => '</div>',
 'before_title' => '<h1 class="widget-title">',
 'after_title' => '</h1>'
));

register_sidebar(array(
 'name' => 'AdSense1',
 'id' => 'absense1',//Adblock Plus対策にわざとabsenseに
 'description' => 'アドセンス用サイドバー1',
 'before_widget' => '<div>',
 'after_widget' => '</div>',
 'before_title' => '<h1 class="widget-title">',
 'after_title' => '</h1>'
));

register_sidebar(array(
 'name' => 'AdSense2',
 'id' => 'absense2',//Adblock Plus対策にわざとabsenseに
 'description' => 'アドセンス用サイドバー2',
 'before_widget' => '<div>',
 'after_widget' => '</div>',
 'before_title' => '<h1 class="widget-title">',
 'after_title' => '</h1>'
));

}


/* ウィジェットでショートコード使用設定 */
add_filter('widget_text', 'do_shortcode');


/* アイキャッチ画像 */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(160, 160, true ); // 幅 160px、高さ 160px、切り抜きモード
the_post_thumbnail('thumbnail');// サムネイル
the_post_thumbnail('medium');// 中サイズ
the_post_thumbnail('large');// 大サイズ


/* 抜粋設定 */

// 字数を100文字に指定する
function my_excerpt_mblength($length) {
    return 100;
}
add_filter('excerpt_mblength', 'my_excerpt_mblength');

// 本文からの抜粋末尾の文字列を指定する
function my_auto_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'my_auto_excerpt_more');

// 抜粋末尾に個別投稿ページへのリンクを追加する
function my_custom_excerpt_more($excerpt) {
    return $excerpt . '<p class="more"><a href="' . get_permalink($post->ID) . '">続きを読む &gt;</a></p>';
}
add_filter('get_the_excerpt', 'my_custom_excerpt_more');

// 抜粋枠追加
add_post_type_support( 'page', 'excerpt' );


/* カスタムメニュー */
add_theme_support( 'menus' );
	register_nav_menus(array(
	    'primary' => 'グローバルナビゲーション'
	));


/* カスタムメニュー、説明に入力した値をアンカーリンクとして追加 */
class anchorlink_walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

				// $item->urlの末尾"/"を削除し、#と$item->description（カスタムメニュー説明項目）を接続 substrは不要？ substr( $item->url, 0, -1 )
				if($item->description) {
        	$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url         ) ."#" .esc_attr( $item->description ) .'"' : '';
				}
				else {
					$attributes .= ! empty( $item->url )        ? ' href="'    . esc_attr( $item->url        ) .'"' : '';
				}


        if($depth != 0) {
            $description = $append = $prepend = "";
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= $description.$args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


/* ビジュアルリッチエディターにボタンを追加 */
function ilc_mce_buttons($buttons){
  array_push($buttons, "backcolor", "copy", "cut", "paste", "fontsizeselect", "cleanup");
  return $buttons;
}
add_filter("mce_buttons", "ilc_mce_buttons");


/* パスワード保護ページ（保護中：）を削除 */
add_filter('protected_title_format', 'remove_protected');
function remove_protected($title) {
       return '%s';
}


/* Contact Form 7　メールアドレス確認 */
add_filter( 'wpcf7_validate_email', 'wpcf7_text_validation_filter_extend', 11, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_text_validation_filter_extend', 11, 2 );
function wpcf7_text_validation_filter_extend( $result, $tag ) {
$type = $tag['type'];
$name = $tag['name'];
$_POST[$name] = trim( strtr( (string) $_POST[$name], "\n", " " ) );
if ( 'email' == $type || 'email*' == $type ) {
if (preg_match('/(.*)_confirm$/', $name, $matches)){
$target_name = $matches[1];
if ($_POST[$name] != $_POST[$target_name]) {
$result['valid'] = false;
$result['reason'][$name] = '確認用のメールアドレスが一致していません';
}
}
}
return $result;
}


/* ページネーションを追加 */
function pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<nav class=\"pagination clearfix\"><ul>";/*<span>Page ".$paged." of ".$pages."</span>";*/
         if($paged > 1 && $showitems < $pages) echo "<li class=".'prev'."><a href='".get_pagenum_link($paged - 1)."'>前へ</a></li>";

//         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>1…</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class=\"current\">".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
             }
         }

//         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>…".$pages."</a>";

         if ($paged < $pages && $showitems < $pages) echo "<li class=".'next'."><a href=\"".get_pagenum_link($paged + 1)."\">次へ</a></li>";
         echo "</ul></nav>\n";
     }
}


/* コメント表示の設定 */
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="clearfix">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='48' ); ?>
      </div>

			<div class="comment-right">
				<div class="comment-meta commentmetadata">
					 <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
					<span class="comment-date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
				</div>


				<?php if ($comment->comment_approved == '0') : ?>
					 <em><?php _e('Your comment is awaiting moderation.') ?></em>
					 <br />
				<?php endif; ?>


				<?php comment_text() ?>

				<div class="reply">
					 <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
    </div>
<?php
        }


/* ユーザー定義関数（postloop 投稿記事一覧を取得して表示） */
function postloop( $catname = '', $postnum = '', $order = 'DESC', $orderby = 'date' ){

	global $post;
	$tmp_post = $post; // このPHPコードを実行する前の記事データを退避。

	if( !$postnum ){
		$postnum = get_option('posts_per_page');
	}

	$output = '<ul class="newswrap">';

	$get_posts_args = array(
		'category_name' => $catname, // カテゴリIDを配列で指定。
		'numberposts' => $postnum, // 取得する最大投稿記事数を指定。
		'order' => $order, // 大きい値から小さい値の順（3, 2, 1; c, b, a）
		'orderby' => $orderby // 記事の投稿日で並べ替え
	);
	$postslist = get_posts( $get_posts_args );
			// get_posts 関数で、投稿記事データを取得し、配列に格納。

	if (! $postslist) {
		$output .= '<li><i class="fa fa-caret-right"></i>最新記事はまだ投稿されていません。</li>';
	}

	foreach ( $postslist as $post ) {
				// 取得した投稿記事データを1つづつ表示。

		$output .= '<li><i class="fa fa-caret-right"></i><span> ';
		$output .= get_the_time('Y.n.j');
		$output .= '</span> ： <a href="';
		$output .= get_permalink();
		$output .= '">' .$post->post_title .'</a></li>';

				}

	$output .= '</ul>';

	return $output;

	$post = $tmp_post; // このPHPコードを実行する前の記事データを復活。
}

function postloopcode( $atts ) { //ショートコード引数の設定
	extract(shortcode_atts(array(
		'catname' => $catname,
		'postnum' => $postnum,
		'order' => $order,
		'orderby' => $orderby ),
		$atts));

	return postloop( $catname, $postnum, $order, $orderby ); //ショートコード用関数実行
}
//postloopをショートコードでも実装 [postloop catname=blog postnum=6 order=DESC orderby=date]
add_shortcode('postloop', 'postloopcode', 'order', 'orderby');