<article class="article clearfix">
	<header>
		<?php if (post_custom('seednumber')) : ?>
			<h1 class="title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>pokemon/<?php echo get_field('seednumber'); ?>"><?php the_title(); ?></a></h1>
		<?php else: ?>
			<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php endif; ?>
	</header>
	
	<div class="content clearfix">
		<div class="thumb">
		
		<?php if ( in_category( 'training' ) ): ?>
		<a href="<?php the_permalink(); ?>">
		<?php
			$obj=get_field('poke_data');
			if($obj){
				$dataid = $obj->ID;//IDを取得
				// クエリ
				$the_query = new WP_Query( array( 
					page_id => $dataid,
					post_type => pokemon_data
				 ) );
				// ループ
				while ( $the_query->have_posts() ) : $the_query->the_post();

				// 現在表示しているページの投稿IDから投稿情報を取得します
				$page = get_post( get_the_ID() );
				// 投稿のスラッグを取得します
				$slug = $page->post_name;
		?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/pokemon/official/<?php echo $slug ?>.png" alt="<?php the_title(); ?>">
		<?php
				endwhile;
				// 投稿データをリセット
				wp_reset_postdata();
			}
		?>
		</a>
		<?php else: ?>
		
			<?php if(post_custom('seednumber') ): //カスタムフィールド：seednumberに入力があれば出力?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>pokemon/<?php echo get_field('seednumber'); ?>"><?php the_post_thumbnail( array(160,160) ); ?></a>
			<?php elseif( has_post_thumbnail() ):?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(160,160) ); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/common/no-image.jpg" width="160" height="160" alt="no-image"></a>
			<?php endif; ?>
			
		<?php endif; ?>
		</div>
		
		<div class="excerpt">
		<?php if (post_custom('seednumber')) : ?>
			<p class="more"><a href="<?php echo esc_url( home_url( '/' ) ); ?>pokemon/<?php echo get_field('seednumber'); ?>">続きを読む &gt;</a></p>
		<?php else: ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
		</div>
	</div>
	
	<footer class="post_meta content">
	<i class="fa fa-calendar"></i><?php the_time('Y-m-d') ?>
	<?php if ( has_tag() || has_category() || has_term() ) : ?>
	<i class="fa fa-tag"></i><?php echo get_the_term_list( $post->ID, 'battle_type' ); the_category(' '); the_tags('',''); ?>
	<?php endif; ?>
	</footer>
</article>
