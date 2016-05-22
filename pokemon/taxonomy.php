<?php get_header(); ?>

	<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

		<header class="archive-header captionwrap">
			<h1 class="search-title"><?php
				if( is_author() ){
					the_author();
					echo 'さんの投稿一覧';
				}
				else {
					single_cat_title( '', true );
				}?></h1>

		<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		?>
		</header><!-- .archive-header -->

		<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
		?>
		<article class="article post_wrapp clearfix">
			<header>
				<h1 class="post_title title">
				<?php if(post_custom('seednumber') ): //カスタムフィールド：seednumberに入力があれば出力?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>pokemon/<?php echo get_field('seednumber'); ?>"><?php the_title(); ?></a>
				<?php else: ?>
				<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
				<?php endif; ?>
				</h1>
			</header>
			
			<div class="content clearfix">

						<?php has_post_thumbnail( $post_id ); ?>
								<div class="thumb">
								<?php if(post_custom('seednumber') ): //カスタムフィールド：seednumberに入力があれば出力?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>pokemon/<?php echo get_field('seednumber'); ?>"><?php the_post_thumbnail( array(160,160) ); ?></a>
								<?php elseif( has_post_thumbnail() ):?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(160,160) ); ?></a>
								<?php else: ?>
									<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/common/no-image.jpg" alt="no-image"></a>
								<?php endif; ?>
								</div>
			
								<div class="excerpt">
									<?php if (post_custom('seednumber')) : ?>
										<p class="more"><a href="<?php echo esc_url( home_url( '/' ) ); ?>pokemon/<?php echo get_field('seednumber'); ?>">続きを読む &gt;</a></p>
									<?php else: ?>
										<?php the_excerpt(); ?>
									<?php endif; ?>
								</div>
						
			</div>
			
			<footer class="post_meta content">
				<i class="fa fa-calendar"></i><?php the_time('Y-m-d') ?>
				<?php if ( has_tag() || has_category() || has_term() ) : ?>
				<i class="fa fa-tag"></i><?php echo get_the_term_list( $post->ID, 'battle_type' ); echo get_the_term_list( $post->ID, 'egg' ); the_category(' '); the_tags('',''); ?>
				<?php endif; ?>
			</footer>

		</article>		
					<?php endwhile; ?>

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
</div>
<!-- #main -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
