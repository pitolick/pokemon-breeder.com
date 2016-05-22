<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>


	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="page-header">
				<h1 class="not-title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/page/404/404.png" alt="404 Not Found"></h1>
			</header>

			<div class="not-content">
				<p>お探しのページはヤドランがドわすれしてしまいました。</p>
				<p>ハートのウロコを使ってお探しのキーワードを再検索すると思い出すかもしれません。</p>
				<?php get_search_form(); ?>
			</div><!-- .page-content -->

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<!-- #main -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
