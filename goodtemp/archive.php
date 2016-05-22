<?php get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="page-header captionwrap">
				<div id="wrapper">
					<h1 class="page-title">
						<?php
							if ( is_day() ) :
								printf( __( 'Daily Archives: %s', 'twentyfourteen' ), get_the_date() );
	
							elseif ( is_month() ) :
								printf( __( 'Monthly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) );
	
							elseif ( is_year() ) :
								printf( __( 'Yearly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) );
	
							else :
								_e( 'Archives', 'twentyfourteen' );
	
							endif;
						?>
					</h1>
				</div>
			</header><!-- .page-header -->

			<div id="wrapper">
				<article class="post_wrapp clearfix">
					<h2 class="post_title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>			
						<ul class="post_meta">
							<li class="time"><i class="fa fa-calendar"></i><?php the_time('Y-m-d') ?></li>
							<?php if ( has_tag() ) : ?>
							<li class="tag"><i class="fa fa-tag"></i><?php the_tags(); ?></li>
							<?php endif; ?>
						</ul><!-- .entry-meta -->

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
								<?php pagination($additional_loop->max_num_pages); ?>
					<?php		};
					?>

				<?php else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );
		
						endif;
					?>
				</article>
			</div><!-- #wrapper -->
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();