<?php get_header(); ?>

	<?php if ( have_posts() ): ?>
	<?php while ( have_posts() ) : the_post(); 
	
		get_template_part( 'content', 'home' );
	
	?>
	<?php endwhile; // end of the loop. ?>

	<?php
		// Previous/next page navigation.
		if (function_exists("pagination")) { ?>
			<?php pagination($additional_loop->max_num_pages); ?>
	<?php		};
	?>

	<?php else: ?>
		<article class="container clearfix">
			<h1 class="title">まだ記事は投稿されていません。</h1>
		</article>
	<?php endif; ?>
</div>
<!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
