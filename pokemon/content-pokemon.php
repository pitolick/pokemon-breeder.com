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
<?php /*?>			<li class="time"><i class="fa fa-calendar"></i><?php the_time('Y-m-d') ?></li>
			<?php if ( has_tag() || has_category() ) : ?>
			<li class="tag"><i class="fa fa-tag"></i><?php the_category(' '); ?><?php the_tags('',''); ?></li>
			<?php endif; ?>
<?php */?>		</ul><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php $kind = get_field('kind'); 
		for ($i = 0; $i < $kind; $i++):
	?>
	<article class="article">
	<?php
		$obj=get_field('poke_data'.$i);
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
	
	<?php if(post_custom('technique'.$i)): //カスタムフィールド：technique0に入力があれば出力?>
		<section class="content clearfix">
			<h3 class="caption">有用な技</h3>
			<table class="technique_table">
			<tbody>
				<tr class="heading">
					<th>技名</th><th>タイプ</th><th>威力</th><th>命中</th><th>追加効果</th><th>備考</th>
				</tr>
				<?php echo get_field('technique'.$i); ?>			
			</tbody>
			</table>
		</section>
 	<?php endif; ?>	
	
	<?php if(post_custom('inherit'.$i)): //カスタムフィールド：inherit0に入力があれば出力?>
		<section class="content clearfix">
			<h3 class="caption">有用な技遺伝経路</h3>
			<table class="inherit_table">
			<tbody>
				<tr class="heading">
					<th>技名</th><th>経路</th>
				</tr>
				<?php echo get_field('inherit'.$i); ?>			
			</tbody>
			</table>
		</section>
 	<?php endif; ?>	
	
	
	
	<?php $poke = get_field('poke_data'.$i);
		$poke_num = $poke -> number;
	?>
	
	<?php $the_query = new WP_Query( array(
			'posts_per_page ' => -1,
			'post_type' => 'training'
		)); ?>
		
	<?php if ( $the_query->have_posts() ):while( $the_query->have_posts() ): $the_query->the_post();
		$poke_race = get_field('poke_data');
		$poke_number = $poke_race -> number;
	endwhile; endif; wp_reset_postdata(); ?>

	
	
	<?php $the_query = new WP_Query( array(
			'posts_per_page ' => -1,
			'post_type' => 'training'
		)); ?>
		
	<?php if ( $the_query->have_posts() && $poke_number == $poke_num ): ?>

		<section class="content clearfix">
			<h2 class="caption">育成論一覧</h2>
				<div class="training">
			<?php while( $the_query->have_posts() ): $the_query->the_post(); ?>

				<?php
					if( $poke == $obj && $poke && $obj ):
						get_template_part( 'content', 'list' );
						$poke_post = 'true'; 
				?>
				<?php endif; ?>

			<?php endwhile; ?>

			</div>
		</section>

	<?php endif; ?>
	<?php wp_reset_postdata();?>
	</article>
	<?php endfor; 	?>
</article><!-- #post-## -->

<?php get_template_part( 'single', 'footer' ); ?>




