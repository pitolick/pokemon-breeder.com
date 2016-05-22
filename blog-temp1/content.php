<article id="post-<?php the_ID(); ?>" class="article clearfix" <?php post_class(); ?>>
	<header class="entry-header">

	<?php
		if ( is_single() ) :
			the_title( '<h1 class="title">', '</h1>' );
		else :
			the_title( '<h1 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		endif;
	?>

		<ul class="post_meta content">
			<li class="time"><i class="fa fa-calendar"></i><?php the_time('Y-m-d') ?></li>
			<?php if ( has_tag() ) : ?>
			<li class="tag"><i class="fa fa-tag"></i><?php the_category(' '); ?><?php the_tags('',''); ?></li>
			<?php endif; ?>
		</ul><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
	<div class="entry-summary content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="content">

	<?php
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>' ) );
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
	?>
	</div><!-- .entry-content -->
	<?php endif; ?>

</article><!-- #post-## -->
