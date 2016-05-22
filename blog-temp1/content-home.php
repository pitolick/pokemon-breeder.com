<article class="article clearfix">
	<header>
		<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header>
	
	<div class="content clearfix">
		<div class="thumb">
		<?php if( has_post_thumbnail() ):?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(160,160) ); ?></a>
		<?php else: ?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/common/no-image.jpg" width="160" height="160" alt="no-image"></a>
		<?php endif; ?>
		</div>
		
		<div class="excerpt">
			<?php the_excerpt(); ?>				
		</div>
	</div>
	
	<footer class="post_meta content">
	<i class="fa fa-calendar"></i><?php the_time('Y-m-d') ?>
	<i class="fa fa-tag"></i><?php the_category(' '); ?><?php the_tags('',''); ?>
	</footer>
</article>
