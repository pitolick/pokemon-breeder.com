<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<div id="wrapper">

		<?php if ( have_comments() ) : ?>
	
			<ol class="comment-list">
				<?php wp_list_comments('callback=mytheme_comment'); ?>
			</ol><!-- .comment-list -->
	
		<?php endif; // have_comments() ?>
	
		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.' ); ?></p>
		<?php endif; ?>
	
		<?php
		$comments_args = array(
			'fields' => array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
										'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
				'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
										'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
				'url'    => '',
			),
			'title_reply'          => 'コメントはお気軽にどうぞ',
			'comment_notes_before' => '<p class="comment-notes">メールアドレスは公開されませんのでご安心ください。<br />また、<span class="required">*</span> が付いている欄は必須項目となりますので、必ずご記入をお願いします。</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">内容に問題なければ、下記の「コメントを送信する」ボタンを押してください。</p>',
			'label_submit'         => 'コメントを送信する',
		);
		
		comment_form($comments_args);
		?>
	</div>
</div><!-- .comments-area -->
