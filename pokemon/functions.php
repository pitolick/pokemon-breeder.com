<?php
/* Javascript css読み込み設定 */
//子テーマの場合はget_stylesheet_directory_uri()を使用する
if (!is_admin()) {
	function after_all_css() {
		function register_style_child() {
			//Javascript
			wp_register_script('isotope', get_stylesheet_directory_uri().'/js/isotope/isotope.min.js', array('jquery'));
			wp_register_script('isotope_set', get_stylesheet_directory_uri().'/js/isotope/isotope_set.js', array('jquery'));
			//css
			wp_register_style('style_child', get_stylesheet_directory_uri().'/css/style.css');
			wp_register_style('pokecommon', get_stylesheet_directory_uri().'/css/common.css');
			wp_register_style('single', get_stylesheet_directory_uri().'/css/single.css');
			wp_register_style('page', get_stylesheet_directory_uri().'/css/page.css');
			wp_register_style('style_sp', get_stylesheet_directory_uri().'/css/style-child.css');

		}
		function add_stylesheet_child() {
			// 共通
			register_style_child();

			wp_enqueue_style('style_child');
			wp_enqueue_style('pokecommon');
			if ( is_single() || is_search() ) {
				wp_enqueue_style('single');
			}
			if ( is_page() ) {
				wp_enqueue_style('page');
			}
			if ( is_page('database') ) {
				wp_enqueue_script('isotope');
				wp_enqueue_script('isotope_set');
			}

			if ( wp_is_mobile() ) {
				wp_enqueue_style('style_sp');
			}
		}
		add_action('wp_print_styles', 'add_stylesheet_child');

	}
// 親テーマの後に実行
add_action( 'after_setup_theme', 'after_all_css' );
}

/* wp_is_mobile()をカスタマイズ（タブレットを取り除く） */
function is_mobile() {
  $useragents = array(
    'iPhone',          // iPhone
    'iPod',            // iPod touch
    'Android',         // 1.5+ Android
    'dream',           // Pre 1.5 Android
    'CUPCAKE',         // 1.5+ Android
    'blackberry9500',  // Storm
    'blackberry9530',  // Storm
    'blackberry9520',  // Storm v2
    'blackberry9550',  // Storm v2
    'blackberry9800',  // Torch
    'webOS',           // Palm Pre Experimental
    'incognito',       // Other iPhone browser
    'webmate'          // Other iPhone browser
  );
  $pattern = '/'.implode('|', $useragents).'/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

/* カスタムメニュー */
add_theme_support( 'menus' );
	register_nav_menus(array(
	    'footer' => 'フッターナビゲーション'
	));

/* カスタム投稿（YARPP対策） */
add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => "育成論",
		"singular_name" => "育成論",
		"menu_name" => "育成論",
		"all_items" => "すべての項目",
		"add_new" => "新規追加",
		"add_new_item" => "新規項目追加",
		"edit" => "編集",
		"edit_item" => "項目を編集",
		"new_item" => "新規項目",
		"view" => "表示",
		"view_item" => "項目を表示",
		"search_items" => "検索",
		"not_found" => "見つかりません",
		"not_found_in_trash" => "ゴミ箱にはありません。",
		"parent" => "親",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "training", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "excerpt", "thumbnail", "comments" ),
		"taxonomies" => array( "post_tag" ),
	  "yarpp_support" => true
	);
	register_post_type( "training", $args );

// End of cptui_register_my_cpts()
}


/* JetPackパブリサイズ共有設定 */
function jetpack_publicize() {
    add_post_type_support( 'training', 'publicize' );
}
add_action( 'init', 'jetpack_publicize' );


/* 検索結果から通常投稿以外のページを除外 */
function search_filter($query) {
  if (!$query -> is_admin && $query -> is_search) {
    $query -> set('post_type', array('post', 'pokemon_data', 'training'));
  }
  return $query;
}
add_filter('pre_get_posts', 'search_filter');

/* 検索ウィジェットのカスタマイズ */
function new_search_form($form) {
$form = '<form method="get" id="searchform" action="' . get_option('home') . '/" >
<div>
<input type="text" value="' . attribute_escape(apply_filters('the_search_query', get_search_query())) . '" name="s" id="s" class="search_form" /><button type="submit" id="searchsubmit" class="search_btn"><img src="' .get_stylesheet_directory_uri() .'/images/common/search.png"></button>
</div>
</form>';
return $form;
}
add_filter('get_search_form', 'new_search_form' );


/* WordPressの投稿作成画面で必須項目を作る（空欄ならJavaScriptのアラート） */
/*add_action( 'admin_head-post-new.php', 'mytheme_post_edit_required' ); // 新規投稿画面でフック
add_action( 'admin_head-post.php', 'mytheme_post_edit_required' );     // 投稿編集画面でフック
function mytheme_post_edit_required() {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  if( 'post' == $('#post_type').val() || 'page' == $('#post_type').val() ){ // post_type 判定。例は投稿と固定ページ。カスタム投稿タイプは適宜追加
    $("#post").submit(function(e){ // 更新あるいは下書き保存を押したとき
      if('' == $('#title').val()) { // タイトル欄の場合
        alert('タイトルを入力してください！');
        $('.spinner').hide(); // spinnerアイコンを隠す
        $('#publish').removeClass('button-primary-disabled'); // #publishからクラス削除
        $('#title').focus(); // 入力欄にフォーカス
        return false;
      }
      if( $("#set-post-thumbnail img").length < 1 ) { // アイキャッチ画像
        alert('アイキャッチ画像を設定してください！');
        $('.spinner').hide();
        $('#publish').removeClass('button-primary-disabled');
        $('#set-post-thumbnail').focus();
        return false;
      }
    });
  }
});
</script>
<?php
}
*/

/* pre_get_posts設定 */
function change_posts_per_page($query) {
 /* 管理画面,メインクエリに干渉しないために必須 */
	if( is_admin() || ! $query->is_main_query() ){
		return;
	}

	/* メインページの表示投稿タイプを変更 */
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'post', 'training' ) );
		return;
	}

	/* タクソノミーページの表示投稿タイプを変更 */
	if ( $query->is_main_query() && $query->is_tax() ) {
		$query->set( 'post_type',  array( 'pokemon_data', 'training' ) );

		if ( $query->is_tax( 'egg' ) ) {
			$query->set( 'order', 'ASC' );
		}

		return;
	}

	/* タグアーカイブに育成論を追加 */
	if ($query->is_main_query() && $query->is_tag()) {
		$query->set( 'post_type', array( 'post', 'training' ) );
		return;
	}

	/* 作成者アーカイブに育成論を追加 */
	if ($query->is_main_query() && $query->is_author()) {
		$query->set( 'post_type', array( 'post', 'training' ) );
		return;
	}

}
add_action( 'pre_get_posts', 'change_posts_per_page' );


/* ユーザープロフィール欄設定 */
function update_profile_fields( $contactmethods ) {
    //項目の削除
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['yim']);
    //項目の追加
    $contactmethods['web_site'] = 'ウェブサイトの名前';
    $contactmethods['twitter'] = 'Twitter';

    return $contactmethods;
}
add_filter('user_contactmethods','update_profile_fields',10,1);


/* ユーザー定義関数（くさむすび、けたぐり威力計算） */
function weight($weight) {
	if ( $weight <= 9.9 ) {
		$ketaguri = 20;
	}
	elseif( $weight <= 24.9 ) {
		$ketaguri = 40;
	}
	elseif( $weight <= 49.9 ) {
		$ketaguri = 60;
	}
	elseif( $weight <= 99.9 ) {
		$ketaguri = 80;
	}
	elseif( $weight <= 199.9 ) {
		$ketaguri = 100;
	}
	elseif( $weight >= 200 ) {
		$ketaguri = 120;
	}
	else {
		$ketaguri = '測定不能';
	}
	echo '(けたぐり･くさむすび威力'.$ketaguri.')';
}


/* ユーザー定義関数（タイプ相性表出力） */
function element(){// ノ		炎		水		電		草		氷		闘		毒		地		飛		超		虫		岩		霊		竜		悪		鋼		妖
	$normal = 	 array(	1,		1,		1,		1,		1,		1,		2,		1,		1,		1,		1,		1,		1,		0,		1,		1,		1,		1);
	$fire =			 array(	1,	0.5,		2,		1,	0.5,	0.5,		1,		1,		2,		1,		1,	0.5,		2,		1,		1,		1,	0.5,	0.5);
	$water =		 array(	1,	0.5,	0.5,		2,		2,	0.5,		1,		1,		1,		1,		1,		1,		1,		1,		1,		1,	0.5,		1);
	$electric =	 array(	1,		1,		1,	0.5,		1,		1,		1,		1,		2,	0.5,		1,		1,		1,		1,		1,		1,	0.5,		1);
	$grass =		 array(	1,		2,	0.5,	0.5,	0.5,		2,		1,		2,	0.5,		2,		1,		2,		1,		1,		1,		1,		1,		1);
	$ice =			 array(	1,		2,		1,		1,		1,	0.5,		2,		1,		1,		1,		1,		1,		2,		1,		1,		1,		2,		1);
	$fighting =	 array(	1,		1,		1,		2,	0.5,		2,	0.5,		1,		0,		1,		1,	0.5,		2,		1,		1,		1,		1,		1);
	$poison =		 array(	1,		1,		1,		1,	0.5,		1,	0.5,	0.5,		2,		1,		2,	0.5,		1,		1,		1,		1,		1,	0.5);
	$ground =		 array(	1,		1,		2,		0,		2,		2,		1,	0.5,		1,		1,		1,		1,	0.5,		1,		1,		1,		1,		1);
	$flying =		 array(	1,		1,		1,		2,	0.5,		2,	0.5,		1,		0,		1,		1,	0.5,		2,		1,		1,		1,		1,		1);
	$psychic =	 array(	1,		1,		1,		1,		1,		1,	0.5,		1,		1,		1,	0.5,		2,		1,		2,		1,		2,		1,		1);
	$bug =			 array(	1,		2,		1,		1,	0.5,		1,	0.5,		1,	0.5,		2,		1,		1,		2,		1,		1,		1,		1,		1);
	$rock =			 array(0.5,	0.5,		2,		1,		2,		1,		2,	0.5,		2,	0.5,		1,		1,		1,		1,		1,		1,		2,		1);
	$ghost =		 array(	0,		1,		1,		1,		1,		1,		0,	0.5,		1,		1,		1,	0.5,		1,		2,		1,		1,		1,		1);
	$dragon =		 array(	1,	0.5,	0.5,	0.5,	0.5,		2,		1,		1,		1,		1,		1,		1,		1,		1,		2,		1,		1,		2);
	$dark =			 array(	1,		1,		1,		1,		1,		1,		2,		1,		1,		1,		0,		2,		1,	0.5,		1,	0.5,		1,		2);
	$steel =		 array(0.5,		2,		1,		1,	0.5,	0.5,		2,		0,		2,	0.5,	0.5,	0.5,	0.5,		1,	0.5,		1,	0.5,	0.5);
	$fairy =		 array(	1,		1,		1,		1,		1,		1,	0.5,		2,		1,		1,		1,	0.5,		1,		1,		0,	0.5,		2,		1);

	$element =	 array('ノーマル','ほのお','みず','でんき','くさ','こおり','かくとう','どく','じめん','ひこう','エスパー','むし','いわ','ゴースト','ドラゴン','あく','はがね','フェアリー');

	//ターム（タイプ）を配列に格納
	$terms = get_the_terms( get_the_ID(), 'type' );
	if ( !empty($terms) ) {
		if ( !is_wp_error( $terms ) ) {
			foreach( $terms as $term ) {
				$type[] = $term->slug;
			}
		}
	}

	//タイプで判別して相性変数を配列に格納
	for ( $i=0; $i< count( $type ); $i++ ) {
		if ( $type[$i] == 'normal' ){
			$ebox[$i] = $normal;
		}
		elseif ( $type[$i] == 'fire' ){
			$ebox[$i] = $fire;
		}
		elseif ( $type[$i] == 'water' ){
			$ebox[$i] = $water;
		}
		elseif ( $type[$i] == 'electric' ){
			$ebox[$i] = $electric;
		}
		elseif ( $type[$i] == 'grass' ){
			$ebox[$i] = $grass;
		}
		elseif ( $type[$i] == 'ice' ){
			$ebox[$i] = $ice;
		}
		elseif ( $type[$i] == 'fighting' ){
			$ebox[$i] = $fighting;
		}
		elseif ( $type[$i] == 'poison' ){
			$ebox[$i] = $poison;
		}
		elseif ( $type[$i] == 'ground' ){
			$ebox[$i] = $ground;
		}
		elseif ( $type[$i] == 'flying' ){
			$ebox[$i] = $flying;
		}
		elseif ( $type[$i] == 'psychic' ){
			$ebox[$i] = $psychic;
		}
		elseif ( $type[$i] == 'bug' ){
			$ebox[$i] = $bug;
		}
		elseif ( $type[$i] == 'rock' ){
			$ebox[$i] = $rock;
		}
		elseif ( $type[$i] == 'ghost' ){
			$ebox[$i] = $ghost;
		}
		elseif ( $type[$i] == 'dragon' ){
			$ebox[$i] = $dragon;
		}
		elseif ( $type[$i] == 'dark' ){
			$ebox[$i] = $dark;
		}
		elseif ( $type[$i] == 'steel' ){
			$ebox[$i] = $steel;
		}
		elseif ( $type[$i] == 'fairy' ){
			$ebox[$i] = $fairy;
		}
	}

	//もしタイプが2つのとき
	if ( count($type) == 2 ) {
		//タイプ相性の計算
		for ( $i=0; $i< count( $normal ); $i++ ) {
			$comp[$i] = $ebox[0][$i] * $ebox[1][$i];
		}

		//相性毎に変数へ格納
		for ( $i=0; $i< count( $normal ); $i++ ) {
			if ( $comp[$i] == 4 ) {
				$great .= $element[$i].'/';
			}
			elseif ( $comp[$i] == 2 ) {
				$good .= $element[$i].'/';
			}
			elseif ( $comp[$i] == 1 ) {
				$soso .= $element[$i].'/';
			}
			elseif ( $comp[$i] == 0.5 ) {
				$bad .= $element[$i].'/';
			}
			elseif ( $comp[$i] == 0.25 ) {
				$dead .= $element[$i].'/';
			}
			elseif ( $ebox[0][$i] == 0 ) {
				$invalid .= $element[$i].'/';
			}
		}

		//該当相性が空のとき---を代入
		if ( !$great ) {
			$great = '---';
		}
		if ( !$good ) {
			$good = '---';
		}
		if ( !$soso ) {
			$soso = '---';
		}
		if ( !$bad ) {
			$bad = '---';
		}
		if ( !$dead ) {
			$dead = '---';
		}
		if ( !$invalid ) {
			$invalid = '---';
		}

		//最終文字列の"/"を削除
		$great = substr($great, 0, -1);
		$good = substr($good, 0, -1);
		$soso = substr($soso, 0, -1);
		$bad = substr($bad, 0, -1);
		$dead = substr($dead, 0, -1);
		$invalid = substr($invalid, 0, -1);

		//出力
		echo '<tr><th>ばつぐん(4倍)</th><td>'.$great.'</td></tr><tr><th>ばつぐん(2倍)</th><td>'.$good.'</td></tr><!--<tr><th>ふつう(1倍)</th><td>'.$soso.'</td></tr>--><tr><th>いまひとつ(1/2)</th><td>'.$bad.'</td></tr><tr><th>いまひとつ(1/4)</th><td>'.$dead.'</td></tr><tr><th>こうかなし</th><td>'.$invalid.'</td></tr>';
	}
	//タイプが1つのとき
	elseif ( count($type) == 1 ) {
		//相性毎に変数へ格納
		for ( $i=0; $i< count( $normal ); $i++ ) {
			if ( $ebox[0][$i] == 4 ) {
				$great .= $element[$i].'/';
			}
			elseif ( $ebox[0][$i] == 2 ) {
				$good .= $element[$i].'/';
			}
			elseif ( $ebox[0][$i] == 1 ) {
				$soso .= $element[$i].'/';
			}
			elseif ( $ebox[0][$i] == 0.5 ) {
				$bad .= $element[$i].'/';
			}
			elseif ( $ebox[0][$i] == 0.25 ) {
				$dead .= $element[$i].'/';
			}
			elseif ( $ebox[0][$i] == 0 ) {
				$invalid .= $element[$i].'/';
			}
		}
		//該当相性が空のとき---を代入
		if ( !$great ) {
			$great = '---';
		}
		if ( !$good ) {
			$good = '---';
		}
		if ( !$soso ) {
			$soso = '---';
		}
		if ( !$bad ) {
			$bad = '---';
		}
		if ( !$dead ) {
			$dead = '---';
		}
		if ( !$invalid ) {
			$invalid = '---';
		}
		//最終文字列の"/"を削除
		$great = substr($great, 0, -1);
		$good = substr($good, 0, -1);
		$soso = substr($soso, 0, -1);
		$bad = substr($bad, 0, -1);
		$dead = substr($dead, 0, -1);
		$invalid = substr($invalid, 0, -1);

		//出力
		echo '<tr><th>ばつぐん(4倍)</th><td>'.$great.'</td></tr><tr><th>ばつぐん(2倍)</th><td>'.$good.'</td></tr><!--<tr><th>ふつう(1倍)</th><td>'.$soso.'</td></tr>--><tr><th>いまひとつ(1/2)</th><td>'.$bad.'</td></tr><tr><th>いまひとつ(1/4)</th><td>'.$dead.'</td></tr><tr><th>こうかなし</th><td>'.$invalid.'</td></tr>';
	}
	else {
		echo 'エラー';
	}
}


/* ユーザー定義関数（更新日時確認） */
// 管理メニューに追加するフック
add_action('admin_menu', 'mt_add_pages');

// 上のフックに対するaction関数
function mt_add_pages() {
	// 設定メニュー下にサブメニューを追加:
	add_options_page('ポケモン最新作設定', 'ポケモン最新作設定', 3, 'pokemon_options', 'mt_options_page');
}

// データの保存
function add_custom_whitelist_options_fields() {
    register_setting( 'mt_options_page', 'release_date' );
}
add_filter( 'admin_init', 'add_custom_whitelist_options_fields' );


// 設定項目ページの出力
function mt_options_page() {

    // フィールドと設定項目名のための変数
    $opt_name = 'release_date';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'release_date';

    // データベースから既存の設定値を読み込む
    $opt_val = get_option( $opt_name );

    // ユーザが何かの情報を投稿したかどうかをチェックする
    // 投稿していれば、このhiddenフィールドの値は'Y'にセットされる
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // 投稿された値を読む
        $opt_val = $_POST[ $data_field_name ];

        // データベースに値を設定する
        update_option( $opt_name, $opt_val );

        // 画面に更新されたことを伝えるメッセージを表示

?>
<div class="updated"><p><strong><?php _e('設定が保存されました。', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // 設定変更画面を表示する

    echo '<div class="wrap">';

    // ヘッダー

    echo "<h2>" . __( 'ポケモン最新作設定', 'mt_trans_domain' ) . "</h2>";

    // 設定用フォーム

    ?>

<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p>ポケモン最新作発売日を入力してください。</p>
<p><?php _e("最新作発売日", 'mt_trans_domain' ); ?>
<input type="date" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php _e('変更を保存', 'mt_trans_domain' ) ?>" />
</p>

</form>
</div>

<?php
}


//更新日時が古い場合警告を表示
function pokemon_version(){
	//ポケモン最新バージョン発売日を入力
	$new_version = get_option( 'release_date' );

	//カレンダーで入力した値を10進数の数値に変換
	$pro_new_version = str_replace("-", "", $new_version);
	$num_new_version = intval($pro_new_version);

	//記事の更新日時を取得
	$post_modified = get_the_modified_date('Ymd');
	//10進数の数値に変換
	$num_modified = intval($post_modified);

	//現在の日付を取得
	$today = date('Ymd') ."　今日<br>";
	$num_today = intval($today);

	if( $num_new_version >= $num_modified && $num_today >= $num_new_version ){?>
		<div class="version">
			<p>この記事はポケモン最新作発売よりも前に書かれた記事のため、情報が古くなっている可能性があります。</p>
		</div>
	<?php }
}