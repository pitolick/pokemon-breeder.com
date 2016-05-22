<?php
/* css読み込み設定 */
//子テーマの場合はget_stylesheet_directory_uri()を使用する
if (!is_admin()) {
function after_all() {
	function register_style_sp() {
		wp_register_style('style_sp', get_stylesheet_directory_uri().'/style.css');
	
	}
	function add_stylesheet_sp() {
		// 共通
		register_style_sp();
		wp_enqueue_style('style_sp');
	}
	add_action('wp_print_styles', 'add_stylesheet_sp');

}
// 親テーマの後に実行
add_action( 'after_setup_theme', 'after_all' );
}