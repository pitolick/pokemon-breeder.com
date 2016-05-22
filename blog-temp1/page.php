<?php get_header(); ?>

	<?php if( !is_front_page()): ?><?php //トップページじゃないときに表示 ?>
	<article class="article clearfix">

			<?php //パンくずリスト ?>
			<?php if(function_exists('bcn_display')): ?>
				<nav class="breadcrumbs content">
					<?php bcn_display(); ?>
				</nav>
			<?php endif; ?>

	<?php endif; ?>

	<?php if( is_page('recruit')): ?><?php //Recruitページのときに表示 ?>
		<?php get_template_part( 'content', 'recruit' ); ?>

	<?php else: ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content();?>

		<?php endwhile; // end of the loop. ?>
	<?php endif; ?>

	</article>
</div>
<!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
