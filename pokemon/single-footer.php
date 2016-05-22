<section id="share" class="article-bottom clearfix">
	<h2 class="sub-caption">シェアする</h2>
	<ul>
		<li class="sns-tw"><a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php bloginfo('name'); ?>のおすすめ記事：<?php the_title(); ?>&via=pokebreeschool&related=pokebreeschool"  onclick="window.open(this.href, 'Gwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/common/sns-tw.png" alt="ツイートする"></a></li><?php /*?>
		<?php */?><li class="sns-fb"><a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'FBwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/common/sns-fb.png" alt="シェアする"></a></li><?php /*?>
		<?php */?><li class="sns-go"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'Gwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/common/sns-go.png" alt="Google+"></a></li><?php /*?>
		<?php */?><li class="sns-li"><a class="line btn" href="http://line.me/R/msg/text/?<?php wp_title( '|', true, 'right' ); ?><?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/common/sns-li.png" alt="LINEで送る"></a></li><?php /*?>
		<?php */?><li class="sns-b"><a href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" class="hatena-bookmark-button" data-hatena-bookmark-layout="simple" title="<?php wp_title( '|', true, 'right' ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/common/sns-b.png" alt="はてブ"></a></li>
	</ul>
</section>

<section id="related" class="article-bottom clearfix">
	<h2 class="sub-caption">関連記事</h2>
	<?php related_posts(); ?>
</section>

