<?php get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="archive-header captionwrap">
				<div id="wrapper">
					<h1 class="archive-title"><?php single_cat_title( '', true ); ?></h1>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
				</div>
			</header><!-- .archive-header -->

			<div id="wrapper">
				<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();
				?>
				<article class="post_wrapp clearfix">
					<h2 class="post_title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>		
						<ul class="post_meta">
							<li class="time"><i class="fa fa-calendar"></i><?php the_time('Y-m-d'); ?></li>
							<?php if ( has_tag() ) : ?>
							<li class="tag"><i class="fa fa-tag"></i><?php the_tags(); ?></li>
							<?php endif; ?>
						</ul><!-- .entry-meta -->
	
					<?php
							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							
							if ( is_category() || is_archive() ) { ?>
								<?php has_post_thumbnail( $post_id ); ?>
									<div class="thum">
										<?php the_post_thumbnail(); ?>
									</div>
										<?php the_excerpt(); ?>
								
							<?php } else {
									the_content();
							} ?>
				</article>		
							<?php endwhile; ?>

					<?php
							// Previous/next page navigation.
							if (function_exists("pagination")) { ?>
								<?php pagination($additional_loop->max_num_pages); ?>
					<?php		};
					?>
					<?php else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );
		
						endif;
					?>
			</div><!-- #wrapper -->
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
