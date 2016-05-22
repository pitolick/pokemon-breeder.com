<div id="side-right">
	<?php if ( is_active_sidebar( 'absense1' ) ) ://Adblock Plus対策にわざとabsに ?>
	<aside class="sidebar abs1">
		<?php dynamic_sidebar( 'absense1' ); ?>
	<!-- #adsense1 -->
	</aside>
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
	<section class="sidebar side1">
		<?php dynamic_sidebar( 'sidebar1' ); ?>
	<!-- #sidebar1 -->
	</section>
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'sidebar2' ) ) : ?>
	<section class="sidebar side2">
		<?php dynamic_sidebar( 'sidebar2' ); ?>
	<!-- #sidebar2 -->
	</section>
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'absense2' ) ) ://Adblock Plus対策にわざとabsに ?>
	<aside class="sidebar abs2">
		<?php dynamic_sidebar( 'absense2' ); ?>
	<!-- #adsense2 -->
	</aside>
	<?php endif; ?>

</div>
<!-- #secondary --> 
