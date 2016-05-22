<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div id="wrapper">

	<?php
		if ( is_single() ) :
			the_title( '<h1 class="caption">', '</h1>' );
		else :
			the_title( '<h1 class="caption"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		endif;
	?>
		</div>

		<div id="wrapper">
			<ul class="post_meta">
				<li class="time"><i class="fa fa-calendar"></i><?php the_date(); ?></li>
				<?php if ( has_tag() ) : ?>
				<li class="tag"><i class="fa fa-tag"></i><?php the_tags(); ?></li>
				<?php endif; ?>
			</ul><!-- .entry-meta -->
		</div>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<div id="wrapper">
			<?php the_excerpt(); ?>
		</div>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div id="wrapper">
		<div class="entry-content">

		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
		</div>
	</div><!-- .entry-content -->
	<?php endif; ?>

</article><!-- #post-## -->
