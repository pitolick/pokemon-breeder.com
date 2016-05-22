<?php get_header(); ?>

<?php //googlemapはheader.phpに記載（空要素を回避するため） ?>

<div id="wrapper">
    
    <article class="container">
    	<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content();?>
		<?php endwhile; // end of the loop. ?>
    </article>
    
<?php get_sidebar(); ?>
<?php get_footer(); ?>