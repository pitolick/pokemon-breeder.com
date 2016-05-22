<article id="post-<?php the_ID(); ?>" class="article" <?php post_class(); ?>>
	<header class="entry-header">

	<?php
		if ( is_single() ) :
			the_title( '<h1 class="title">', '</h1>' );
		else :
			the_title( '<h1 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		endif;
	?>

		<ul class="post_meta content">
			<li class="tw"><a href="https://twitter.com/share" class="twitter-share-button" data-via="pokebreeschool" data-related="pokebreeschool" data-count="none">Tweet</a></li>
			<li class="fb"><div class="fb-like" data-href="<?php echo esc_url( home_url( '/' ) ); ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div></li>
			<li class="go"><div class="g-plusone" data-size="medium" data-annotation="none"></div></li>
			<li class="b"><a href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php wp_title( '|', true, 'right' ); ?>" data-hatena-bookmark-layout="standard-noballoon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a></li>
			<li class="time"><i class="fa fa-calendar"></i><?php the_time('Y-m-d') ?></li>
			<?php if ( has_tag() || has_category() ) : ?>
			<li class="tag"><i class="fa fa-tag"></i><?php the_category(' '); ?><?php the_tags('',''); ?></li>
			<?php endif; ?>
		</ul><!-- .entry-meta -->
	</header><!-- .entry-header -->

<?php pokemon_version(); ?>

	<?php
		$obj=get_field('poke_data');
		if($obj){
			$dataid = $obj->ID;//IDを取得
			// クエリ
			$the_query = new WP_Query( array( 
				'page_id' => $dataid,
				'post_type' => 'pokemon_data'
			 ) );
			// ループ
			while ( $the_query->have_posts() ) : $the_query->the_post();
				
				get_template_part( 'content', 'data' );
				
			endwhile;
			// 投稿データをリセット
			wp_reset_postdata();
		}
	?>
	
	<?php if(post_custom('type_name')): //カスタムフィールド：type_nameに入力があれば出力?>
		<section class="content clearfix">
			<h2 class="caption"><?php echo get_field('type_name'); ?></h2>
			
			<?php if(post_custom('type_summary')): //カスタムフィールド：type_summaryに入力があれば出力?>
				<?php echo get_field('type_summary'); ?>
			<?php endif; ?>	
		</section>
 	<?php endif; ?>	
	
	<?php if(post_custom('allocation')): //カスタムフィールド：allocationに入力があれば出力?>
		<section class="content clearfix">
			<h3 class="caption">努力値配分</h3>
			<?php echo get_field('allocation'); ?>
		</section>
 	<?php endif; ?>	
	
	<?php if(post_custom('enemy')): //カスタムフィールド：enemyに入力があれば出力?>
		<section class="content clearfix">
			<h3 class="caption">仮想敵・調整解説</h3>
			
			<div class="enemy_wrapp clearfix">
				<?php
					$obj=get_field('enemy');
					if($obj){
						$dataid = $obj->ID;//IDを取得
						// クエリ
						$the_query = new WP_Query( array( 
							'page_id' => $dataid,
							'post_type' => 'pokemon_data',
							'order' => 'ASC',
							'orderby' => 'meta_value_num',
							'meta_key' => 'number',
							'posts_per_page' => 6
						 ) );
						// ループ
						while ( $the_query->have_posts() ) : $the_query->the_post();
	
						$page = get_post( get_the_ID() );
						// 投稿のスラッグを取得します
						$slug = $page->post_name;
				?>
	
				<div class="thumb enemy">
					<p><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/pokemon/official/<?php echo $slug ?>.png" alt="<?php the_title(); ?>"></p>
				</div>
						
				<?php		
						endwhile;
						// 投稿データをリセット
						wp_reset_postdata();
					}
				?>
			</div>
			
			<?php if(post_custom('enemy_comment')): //カスタムフィールド：enemy_commentに入力があれば出力?>
				<div class="enemy_comment clearfix">
					<?php echo get_field('enemy_comment'); ?>
				</div>
			<?php endif; ?>	
			
			<?php if(post_custom('damage')): //カスタムフィールド：damageに入力があれば出力?>
				<div class="damage clearfix">
					<p>ダメージ計算</p>
					<?php echo get_field('damage'); ?>
				</div>
			<?php endif; ?>	
			
		</section>
 	<?php endif; ?>	
	
	<?php if(post_custom('afterword')): //カスタムフィールド：afterwordに入力があれば出力?>
		<section class="content clearfix">
			<h2 class="caption">まとめ</h2>
			
			<?php echo get_field('afterword'); ?>
		</section>
 	<?php endif; ?>	


</article><!-- #post-## -->

<?php get_template_part( 'single', 'footer' ); ?>