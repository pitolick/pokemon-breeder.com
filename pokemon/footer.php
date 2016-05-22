</div>
<!-- #wrapper -->

<footer id="footer" class="site-footer" role="contentinfo">
	<nav class="footer-navigation navigation both clearfix" role="navigation">
		<div id="wrapper">
			<div class="footer-wrapp">
				<?php wp_nav_menu( array('theme_location'  => 'footer', 'menu_class' => 'footer' ) ); ?>
			</div>
		</div>
		<!-- #wrapper --> 
	</nav>

		<p id="copy">Copyright &copy; 2015-<?php echo date('Y');?> <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?>
			</a>All Rights Reserved.</p>
</footer>
<!-- #footer -->

<!-- AdSense -->
<script type="text/javascript" src="http://wms-fe.amazon-adsystem.com/20070822/JP/js/link-enhancer-common.js?tag=pitolick-22">
</script>
<noscript>
    <img src="http://wms-fe.amazon-adsystem.com/20070822/JP/img/noscript.gif?tag=pitolick-22" alt="" />
</noscript>

<?php wp_footer(); ?>

<!-- twitter -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!-- facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&appId=658987380895031&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- google+ -->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'ja'}
</script>
<!-- はてなブックマーク -->
<script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
</body></html>