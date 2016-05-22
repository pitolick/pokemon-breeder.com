<section id="post-<?php the_ID(); ?>">

	<div class="pokelist isotope content clearfix">
		<div class="gutter-sizer"></div>
	<?php
	$pokelist = array(
			'post_type' => 'pokemon_data',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC'
			);
	?>
	<?php $the_query = new WP_Query($pokelist); ?>
	<?php if ( $the_query->have_posts() ):
					while( $the_query->have_posts() ):
						$the_query->the_post(); ?>
		<?php 
			$terms = get_the_terms( get_the_ID(), 'type' );
			if ( !empty($terms) ) {
				if ( !is_wp_error( $terms ) ) {
					foreach( $terms as $term ) {
						$termtype[] .= $term->slug;
					}
				}
			}
			if ( get_field('battle_poke') == 'topmeta' || get_field('battle_poke') == 'major' || get_field('battle_poke') == 'minor' ) {
				$battle = 'battle_poke';
				$battle .= ' '.get_field('battle_poke');
			} else {
				$battle = get_field('battle_poke');
			}
		?>

		<?php
		// 現在表示しているページの投稿IDから投稿情報を取得します
		$page = get_post( get_the_ID() );
		// 投稿のスラッグを取得します
		$slug = $page->post_name;
		?>

		<div class="pokeitem item type_<?php echo $termtype[0]; ?> <?php echo $termtype[0]; ?> <?php echo $termtype[1]; ?> <?php echo $battle; ?> content5 clearfix">
		<?php if(post_custom('seednumber')): //カスタムフィールド：seednumberに入力があれば出力?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>pokemon/<?php echo get_field('seednumber'); ?>/#<?php echo $slug ?>">
		<?php else: ?>
			<a href="<?php the_permalink(); ?>">
		<?php endif; ?>
				<div class="thumb data_list">
					<p><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/pokemon/official/<?php echo $slug ?>.png" alt="<?php the_title(); ?>"></p>
				</div>
				<div class="poke_name">
					<p class="pokemon_name"><?php the_title(); ?></p>
					<p>
					<?php if( post_custom('number') || post_custom('number') == 0 ): //カスタムフィールド：numberに入力があれば出力?>
						No.<span class="pokemon_number"><?php echo get_field('number'); ?></span>
					<?php endif; ?>
					<?php if( post_custom('s') || post_custom('s') == 0 ): //カスタムフィールド：sに入力があれば出力?>
						S.<span class="pokemon_s"><?php echo get_field('s'); ?></span>
					<?php endif; ?></p>
				</div>
			</a>
		</div>
	<?php $termtype = array();
	endwhile; endif; ?>
	<?php wp_reset_postdata(); ?>

	</div><!-- .content -->
</section><!-- #post-## -->
