<?php 
/*
YARPP Template: 4contents
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
?>

<?php if (have_posts()):?>
<div class="yarpp-wrapp clearfix">
	<?php while (have_posts()) : the_post(); ?>
	<div class="yarpp">
		<div class="thumb">
			<a href="<?php the_permalink() ?>" rel="bookmark">
			<?php if( has_post_thumbnail() ):?>
				<?php the_post_thumbnail( array(200,200) ); ?>
			<?php else: ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/common/no-image.jpg" width="200" height="200" alt="no-image">
			<?php endif; ?>
		</div>
	<p><?php the_title(); ?></p></a><!-- (<?php the_score(); ?>)--></div>
	<?php endwhile; ?>
</div>
<?php else: ?>
<p>関連記事はまだありません。</p>
<?php endif; ?>
