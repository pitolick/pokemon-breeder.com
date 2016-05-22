<?php get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="page-header search-header">
				<h1 class="search-title"><?php $allsearch =& new WP_Query("s=$s&posts_per_page=-1");
				$key = wp_specialchars($s, 1);
				$count = $allsearch->post_count;
				if($count!=0){
				// 検索結果を表示:該当記事あり
						echo '“<strong>'.$key.'</strong>”で検索した結果、<strong>'.$count.'</strong>件の記事が見つかりました';
				} 
				else {
				// 検索結果を表示:該当記事なし
						echo '“<strong>'.$key.'</strong>”で検索した結果、関連する記事は見つかりませんでした';
				}
				?></h1>
			</header><!-- .page-header -->

				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					endwhile;
					?>

					<?php
							// Previous/next page navigation.
							if (function_exists("pagination")) { ?>
								<nav class="pager clearfix">
								<?php pagination($additional_loop->max_num_pages); ?>
								</nav>
					<?php		};
					?>

				<?php else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>

		</div><!-- #content -->
	</section><!-- #primary -->
</div>
<!-- #main -->


<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
