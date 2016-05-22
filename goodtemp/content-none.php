<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<header class="page-header">
	<div id="wrapper">
		<h1 class="page-title">該当する投稿が見つかりませんでした。</h1>
	</div>
</header>

<div class="page-content">
	<div id="wrapper">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	
		<p><?php printf( __( '最初の投稿を公開してみましょう！ <a href="%1$s">Get started here</a>.' ), admin_url( 'post-new.php' ) ); ?></p>
	
		<?php elseif ( is_search() ) : ?>
	
		<p>お探しのキーワードに該当する記事は見つかりませんでした。別のキーワードでもう一度お試しください。</p>
		<?php get_search_form(); ?>
	
		<?php else : ?>
	
		<p>検索フォームにて、お探しのキーワードを再検索すると見つかるかもしれません。</p>
		<?php get_search_form(); ?>
	
		<?php endif; ?>
	</div>
</div><!-- .page-content -->
