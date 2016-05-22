<?php get_header(); ?>

    <article class="container">
    	<?php if( !(is_front_page() || is_page( 'contact' ) || is_page( 'home2' )) ) : ?>	<?php //トップページ、お問い合わせ、home2じゃないときに表示 ?>
	    	<nav class="breadcrumbs">
			    <?php if(function_exists('bcn_display'))
			    {
			        bcn_display();
			    }?>
			</nav>
		<?php endif; ?>

    	<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content();?>
		<?php endwhile; // end of the loop. ?>
    </article>
    
<?php get_sidebar(); ?>
<?php get_footer(); ?>