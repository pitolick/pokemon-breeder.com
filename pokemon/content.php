<?php if ( is_search() ) :
	get_template_part( 'content', 'home' );
	 ?>
<?php else : ?>
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
			<li class="tw"><a href="https://twitter.com/share" class="twitter-share-button" data-via="pokebreeschool" data-related="pokebreeschool" data-count="none">Tweet</a></li>
			<li class="fb"><div class="fb-like" data-href="<?php echo esc_url( home_url( '/' ) ); ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div></li>
			<li class="go"><div class="g-plusone" data-size="medium" data-annotation="none"></div></li>
			<li class="b"><a href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php wp_title( '|', true, 'right' ); ?>" data-hatena-bookmark-layout="standard-noballoon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a></li>
			<li class="time"><i class="fa fa-calendar"></i><?php the_time('Y-m-d') ?></li>
			<?php if ( has_tag() || has_category() ) : ?>
			<li class="tag"><i class="fa fa-tag"></i><?php the_category(' '); ?><?php the_tags('',''); ?></li>
			<?php endif; ?>
		</ul><!-- .entry-meta -->
	</header><!-- .entry-header -->

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

</article><!-- #post-## -->

<?php get_template_part( 'single', 'footer' ); ?>
	<?php endif; ?>
