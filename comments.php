<div class="col-xs-12 col-sm-12 jp_page_comments">
	<div class="row">
	<?php
	if ( isset( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die(__('Please don\'t directly loading the page, thanks!', JUMPING_NAME));
	}

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This article requires a password, enter the password to access.' , JUMPING_NAME); ?></p>
		<?php
		return;
	}
	?>

		<!-- 评论显示 -->
	<?php if ( have_comments() ) : ?>
		<div class="col-xs-12 col-sm-12 comments-data comments-data-header">
			<?php _e( 'Comments' , JUMPING_NAME); ?> (<?php echo $post->comment_count;?>)
		</div>
		<div class="col-xs-12 col-sm-12 comments-data comments-data-body">
			<ul class="media-list comments-data-media clearfix">
				<?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'jumping_comment' ) ); ?>
			</ul>
			<div class="comments-data-footer clearfix">
				<?php if ( 'open' != $post->comment_status ) : ?>
					<h3 class="comments-title"><?php _e( 'Comments Closed.' , JUMPING_NAME); ?></h3>
				<?php else : ?>
					<div class="comment-topnav text-center"><?php paginate_comments_links( 'prev_text=«&next_text=»' ); ?></div>
				<?php endif; ?>
			</div>
		</div>
	<?php else : ?>
		<?php if ( 'open' != $post->comment_status ) : ?>
			<h3 class="comments-title"><?php _e( 'Comments Closed.' , JUMPING_NAME); ?></h3>
		<?php endif; ?>
	<?php endif; ?>

		<!-- 发表评论 -->
	<?php if ( comments_open() ) : ?>
		<div  class="col-xs-12 col-sm-12 comments-data respond" id="respond">
			<h3 class="comments-title"><?php _e( 'Leave a reply' , JUMPING_NAME); ?> <small>为了网站的健康成长，请友爱发言~</small></h3>
		<form method="post" action="<?php echo site_url('wp-comments-post.php');?>" id="comment_form">
		<div id="cancel-comment-reply"><?php cancel_comment_reply_link() ?></div>
		<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
			<p class="title welcome"><?php printf( __( 'You need <a href="%s">login</a> to reply.', JUMPING_NAME ), wp_login_url( get_permalink() ) ); ?></p>
		<?php else : ?>
			<?php if ( is_user_logged_in() ) : ?>
				<p class="title welcome"><?php printf( __( 'Welcome <a href="%1$s">%2$s</a> back，', JUMPING_NAME ), get_option( 'siteurl' ) . '/wp-admin/profile.php', $user_identity ); ?>
					<a href="<?php echo wp_logout_url( get_permalink() ); ?>"
					   title="<?php _e( 'Log out of this account' , JUMPING_NAME); ?>"><?php _e( 'Log out »' , JUMPING_NAME); ?></a></p>
			<?php else : ?>
				<?php if ( $comment_author != "" ): ?>
					<p class="title welcome">
						<?php _e( 'Welcome', JUMPING_NAME ); ?><?php printf('<strong>%s</strong>.', $comment_author ) ?><?php _e( 'back, ' , JUMPING_NAME); ?>
						<a id="edit_author"><?php _e( 'Edit »' , JUMPING_NAME); ?></a>
						<span class="cancel-comment-reply"><?php cancel_comment_reply_link() ?></span>
					</p>
					<div id="author_info" class="author_hide">
					<script type="text/javascript">document.getElementById('edit_author').onclick = function () {
							document.getElementById('author_info').style.display = "block"};</script>
				<?php else : ?>
					<div id="author_info">
				<?php endif; ?>
				<p>
					<label for="author">
						<small><?php _e( 'Name', JUMPING_NAME ); ?> *</small>
					</label>
					<input type="text" name="author" id="author" class="text" size="15"
					       value="<?php echo $comment_author; ?>"/>
				</p>
				<p>
					<label for="mail">
						<small><?php _e( 'Email', JUMPING_NAME ); ?> *</small>
					</label>
					<input type="text" name="email" id="mail" class="text" size="15"
					       value="<?php echo $comment_author_email; ?>"/>
				</p>
				<p>
					<label for="url">
						<small><?php _e( 'Website', JUMPING_NAME ); ?></small>
					</label>
					<input type="text" name="url" id="url" class="text" size="15"
					       value="<?php echo $comment_author_url; ?>"/>
				</p>
				</div>
			<?php endif; ?>
			<div id="author_textarea">
				<textarea name="comment" id="comment" class="textarea" rows="4" tabindex="4"
				          onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
			</div>
			<p><input id="submit" type="submit" name="submit" value="<?php _e( 'Submit / Ctrl+Enter', JUMPING_NAME ); ?>"
			          class="submit"/></p>
			<?php comment_id_fields(); ?>
			<?php do_action( 'comment_form', $post->ID ); ?>
			</form>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	</div>
</div>