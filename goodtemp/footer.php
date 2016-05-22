</div>
<!-- #main -->
</div>
<!-- #wrapper -->

<footer id="footer" class="site-footer" role="contentinfo">
	<div id="wrapper" class="clearfix">
		<div class="foot-left">
			<nav class="news">
				<h2 class="foot-caption">News</h2>
				<!-- 新着記事[START] -->
				<?php
						global $post;
						$tmp_post = $post; // このPHPコードを実行する前の記事データを退避。
					?>
				<ul class="newswrap vacancy">
					<?php
							$get_posts_args = array(
							    'category__in' => array( 5 ), // カテゴリIDを配列で指定。
							    'numberposts' => 5, // 取得する最大投稿記事数を指定。
							    'order' => 'DESC', // 大きい値から小さい値の順（3, 2, 1; c, b, a）
							    'orderby' => 'date' // 記事の投稿日で並べ替え
							);
							$postslist = get_posts( $get_posts_args );
							    // get_posts 関数で、投稿記事データを取得し、配列に格納。
						 ?>
					<?php if (! $postslist): ?>
					<li><i class="fa fa-caret-right"></i>最新記事はまだ投稿されていません。</li>
					<?php endif; ?>
					<?php foreach ( $postslist as $post ) {
						    // 取得した投稿記事データを1つづつ表示。
						?>
					<li><i class="fa fa-caret-right"></i><span>
						<?php the_time('Y.n.j'); ?>
						</span>： <a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></li>
					<?php
							}
						?>
				</ul>
				<?php
						$post = $tmp_post; // このPHPコードを実行する前の記事データを復活。
					?>
				<!-- 新着記事[END] --> 
			</nav>
		</div>
		<div class="foot-right">
			<section class="about">
				<h1 class="foot-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/header/head_logo.png" alt="<?php bloginfo( 'name' ); ?>"></a></h1>
				<div class="foot-about">
					<h2 class="foot-caption">About</h2>
					<p><i class="fa fa-map-marker"></i>住所：〒910-0804 福井県福井市高木中央2丁目1713-1</p>
					<p><i class="fa fa-phone"></i>TEL：0776-52-8730</p>
					<p><i class="fa fa-envelope"></i>Email：<a href="mailto:info@netsystem.jp">info@netsystem.jp</a></p>
				</div>
			</section>
		</div>
	</div>
	<!-- #wrapper -->
	<p id="copy">Copyright &copy; 2014-<?php echo date('Y');?> <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> All Rights Reserved.</p>
</footer>
<!-- #footer -->

<?php wp_footer(); ?>
</body></html>