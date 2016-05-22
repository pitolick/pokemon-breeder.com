<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
				
					if ( get_post_type() === 'training' ){
						get_template_part( 'content', 'training' );
					}
					else{
						get_template_part( 'content', get_post_format() );
					}

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) { ?>
						<h2 class="sub-caption">コメント</h2>
					<?php
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<!-- #main -->


<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
