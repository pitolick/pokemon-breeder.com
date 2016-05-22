<?php
/*-------------
ユーザー数の取得と設定
--------------------*/
$total_users = count_users();
$total_users = $total_users['total_users'];
$paged = get_query_var('paged');
$number = 100; // 1ページに表示したいユーザー数
$args = array(
	'orderby'=>'registered',
	'order'=>'ASC',
	'offset' => $paged ? ( ($paged - 1) * $number) : 0,
	'number' => $number,);
$users = get_users( $args );
/*-------------
ユーザー情報の出力
--------------------*/?>

<div class="clearfix paged-<?php echo $paged; ?>">
	<?php 
	foreach($users as $user):
	$uid = $user->ID;
	$userData = get_userdata($uid);
	$user_post_count = count_user_posts($uid);
	?>
	
	<?php if( count_user_posts($uid) > 0 ): ?>
	
	<article class="users clearfix">
		<section class="author-info content clearfix">
			<div class="author-avatar thumb">
				<p><?php echo get_avatar( $uid ,150 ); ?></p>
			</div>
			<div class="author-description">
				<h2 class="caption"><?php echo $user->display_name; ?></h2>
				<div class="author-link">
					<?php $twitter = get_user_meta( $uid , 'twitter' , true );
					if ( $twitter ) :?>
						<p class="user-twitter"><a class="brandico-twitter-bird" href="https://twitter.com/<?php echo $twitter; ?>" target="_blank" title="Twitter"><i class="fa fa-twitter"></i>@<?php echo $twitter; ?></a></p>
					<?php endif; ?>
					<?php $user_url = $user->user_url;
					if ( $user_url ) :?>
						<?php $web_site = get_user_meta( $uid , 'web_site' , true );?>
						<p class="user-url"><a href="<?php echo $user_url; ?>" target="_blank" title="
							<?php if ( $web_site ) : ?>
								<?php echo $web_site; ?>
							<?php else: ?>
								ウェブサイト
							<?php endif; ?>"><i class="fa fa-link"></i>
							
							<?php if ( $web_site ) : ?>
								<?php echo $web_site; ?>
							<?php else: ?>
								<?php echo $user->display_name; ?>のウェブサイト
							<?php endif; ?>
							</a></p>
					<?php endif; ?>
				</div>
				<p>
					<?php echo wpautop( get_the_author_description() ); ?>
				</p>
			</div>
		</section>
		<section class="content clearfix">
			<?php $paged = get_query_var('paged'); ?>
			<?php $the_query = new WP_Query( array(
				'author' => $uid,
				'posts_per_page' => 3,
				'post_type' => array( 'post','training'),
				'paged' => $paged
				)
			); ?>
			
			<?php if ($the_query->have_posts()) : ?>
			<h2 class="caption">執筆記事一覧</h2>
			<?php while($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php get_template_part( 'content', 'list' ); ?>
			<?php endwhile; wp_reset_postdata();?>
					<?php if( count_user_posts($uid) > 0 ): ?>
					<p class="userposts"><a href="<?php echo get_bloginfo(url); ?>/?author=<?php echo $uid; ?>"><?php echo $user->display_name; ?> の全ての投稿を見る</a></p>
					<?php else : ?>
					<p class="userposts"><span class="userposts noposts"><?php echo $user->display_name; ?> の投稿は、まだありません。</span></p>
					<?php endif; ?>
			
			<?php else: ?>
			<?php endif; ?>
		</section>
	</article>
	<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php /*-------------
ページ送りを出力
--------------------*/
if($total_users > $number){
	$pl_args = array(
			'base'     => add_query_arg('paged','%#%'),
			'format'   => '',
			'total'    => ceil($total_users / $number),
			'current'  => max(1, $paged),
	);
	// for ".../page/n"
	if($GLOBALS['wp_rewrite']->using_permalinks())
	$pl_args['base'] = user_trailingslashit(trailingslashit(get_pagenum_link(1)).'page/%#%/', 'paged');
	echo paginate_links($pl_args);
}
?>
