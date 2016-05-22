<article class="user_post_list clearfix">
	<div class="thumb">
<?php /*?>	<?php if ( in_category( 'training' ) ): ?>  
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
				<a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/pokemon/official/<?php echo $slug ?>.png" alt="<?php the_title(); ?>"></a>
	<?php
			endwhile;
			// 投稿データをリセット
			wp_reset_postdata();
		}
	?>
	
	<?php else: ?>
<?php */?>	
		<?php if( has_post_thumbnail() ):?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(80,80) ); ?></a>
		<?php else: ?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/common/no-image.jpg" width="80" height="80" alt="no-image"></a>
		<?php endif; ?>
		
<?php /*?>	<?php endif; ?>
<?php */?>	</div>
	<div class="excerpt">
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	<?php the_excerpt(); ?>				
	</div>

</article>

