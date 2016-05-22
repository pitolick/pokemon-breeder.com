<?php
// 現在表示しているページの投稿IDから投稿情報を取得します
$page = get_post( get_the_ID() );
// 投稿のスラッグを取得します
$slug = $page->post_name;
?>

<section id="post-<?php the_ID(); ?>" class="database" <?php post_class(); ?>>

	<div id="<?php echo $slug ?>" class="content clearfix">
		<div class="data-head clearfix">
			<div class="thumb data">
				<p><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/pokemon/official/<?php echo $slug ?>.png" alt="<?php the_title(); ?>"></p>
			</div>
	
			<div class="data-right excerpt clearfix">
				<h1 class="data-title title"><?php the_title(); 	?></h1>
				<table class="status-table">
				<?php 
					$terms = get_the_terms( get_the_ID(), 'type' );
					if ( !empty($terms) ) {
						if ( !is_wp_error( $terms ) ) {
							foreach( $terms as $term ) {
								$termtype[] .= $term->name;
							}
						}
					}
				?>
				<?php 
					$eggterms = get_the_terms( get_the_ID(), 'egg' );
					if ( !empty($eggterms) ) {
						if ( !is_wp_error( $eggterms ) ) {
							foreach( $eggterms as $term ) {
								$termegg[] .= $term->name;
							}
						}
					}
				?>
				<tbody>
					<tr>
						<td class="status-left">
								<p>タイプ：<?php echo $termtype[0]; ?><?php if($termtype[1]) { echo '/' .$termtype[1]; } ?></p>
							<?php if(post_custom('property1')): //カスタムフィールド：property1に入力があれば出力?>
								<p>特性1：<?php echo get_field('property1'); ?></p>
							<?php endif; ?>
							<?php if(post_custom('property2')): //カスタムフィールド：property2に入力があれば出力?>
								<p>特性2：<?php echo get_field('property2'); ?></p>
							<?php endif; ?>
							<?php if(post_custom('property3')): //カスタムフィールド：property3に入力があれば出力?>
								<p>夢特性：<?php echo get_field('property3'); ?></p>
							<?php endif; ?>
						</td>
			
						<td class="status-right">
							<?php $weight = post_custom('weight');
							if( !is_null ( $weight ) ): //カスタムフィールド：weightに入力があれば出力?>
								<p>体重：<?php $weight = get_field('weight');
								 echo $weight; ?>kg<br>
								<?php weight($weight); ?></p>
							<?php endif; ?>
								<p><?php the_terms( $post->ID, 'egg', 'タマゴグループ：', '/' ); ?></p>
						</td>
					</tr>
				</tbody>
				</table>
				<table class="race">
				<tbody>
					<tr>
						<th class="h">HP</th><th class="a">こうげき</th><th class="b">ぼうぎょ</th><th class="c">とくこう</th><th class="d">とくぼう</th><th class="s">すばやさ</th>
					</tr>
					<tr>
						<td><?php echo get_field('h'); ?></td><td><?php echo get_field('a'); ?></td><td><?php echo get_field('b'); ?></td><td><?php echo get_field('c'); ?></td><td><?php echo get_field('d'); ?></td><td><?php echo get_field('s'); ?></td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
	
		<div class="element">
			<table><tbody><?php element(); ?></tbody></table>
		
			<?php $property = array(get_field('property1'),get_field('property2'),get_field('property3'));
			 if( in_array('ふゆう',$property) ): //特性がふゆうであれば出力?>
				<p>※特性「ふゆう」の場合、じめん無効</p>
			<?php endif; ?>
	
			<?php if( in_array('そうしょく',$property) ): ?>
				<p>※特性「そうしょく」の場合、くさ無効</p>
			<?php endif; ?>
	
			<?php if( in_array('ちょすい',$property) ): ?>
				<p>※特性「ちょすい」の場合、みず無効</p>
			<?php endif; ?>
	
			<?php if( in_array('ちくでん',$property) ): ?>
				<p>※特性「ちくでん」の場合、でんき無効</p>
			<?php endif; ?>
	
			<?php if( in_array('でんきエンジン',$property) ): ?>
				<p>※特性「でんきエンジン」の場合、でんき無効</p>
			<?php endif; ?>
	
			<?php if( in_array('ひらいしん',$property) ): ?>
				<p>※特性「ひらいしん」の場合、でんき無効</p>
			<?php endif; ?>
	
			<?php if( in_array('よびみず',$property) ): ?>
				<p>※特性「よびみず」の場合、みず無効</p>
			<?php endif; ?>
	
			<?php if( in_array('もらいび',$property) ): ?>
				<p>※特性「もらいび」の場合、ほのお無効</p>
			<?php endif; ?>
	
			<?php if( in_array('あついしぼう',$property) ): ?>
				<p>※特性「あついしぼう」の場合、ほのお・こおり0.5倍</p>
			<?php endif; ?>
	
			<?php if( in_array('かんそうはだ',$property) ): ?>
				<p>※特性「かんそうはだ」の場合、みず無効、ほのお1.25倍</p>
			<?php endif; ?>
	
			<?php if( in_array('たいねつ',$property) ): ?>
				<p>※特性「たいねつ」の場合、ほのお0.5倍</p>
			<?php endif; ?>
	
			<?php if( in_array('ハードロック',$property) ): ?>
				<p>※特性「ハードロック」の場合、効果抜群が0.75倍</p>
			<?php endif; ?>
	
			<?php if( in_array('フィルター',$property) ): ?>
				<p>※特性「フィルター」の場合、効果抜群が0.75倍</p>
			<?php endif; ?>
	
			<?php if( in_array('ふしぎなまもり',$property) ): ?>
				<p>※特性「ふしぎなまもり」の場合、効果抜群以外無効</p>
			<?php endif; ?>
		</div>
	</div><!-- .content -->
</section><!-- #post-## -->
