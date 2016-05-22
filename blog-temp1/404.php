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
				<div id="wrapper">
					<h1 class="page-title">404 Not Found</h1>
					<p>お探しのページは見つかりませんでした。</p>
				</div>
			</header>

			<div class="page-content">
				<div id="wrapper">
					<p>検索フォームにて、お探しのキーワードを再検索すると見つかるかもしれません。</p>
					<?php get_search_form(); ?>
				</div>
			</div><!-- .page-content -->

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<!-- #main -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
