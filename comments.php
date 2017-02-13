<div class="col-xs-12 col-sm-12 jp_page_comments" id="comments">
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
			<p class="text-center">
				<span><?php echo '当前共有 <strong>'.$post->comment_count.'</strong> 条评论' ?></span>
				&nbsp;&nbsp;&nbsp;
				<span><a class="text-right" href="#respond"><i class="fa fa-comment-o"></i> 我要评论</a></span>
			</p>
		</div>
		<div class="col-xs-12 col-sm-12 comments-data comments-data-body">
			<div class="col-xs-12 col-sm-12 comments-data-title">
				<h4><strong><i class="fa fa-comments"></i> 所有评论</strong></h4>
			</div>
			<div class="col-xs-12 col-sm-12 comments-data-body">
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
		</div>
	<?php else : ?>
		<?php if ( 'open' != $post->comment_status ) : ?>
			<h3 class="comments-title"><?php _e( 'Comments Closed.' , JUMPING_NAME); ?></h3>
		<?php endif; ?>
	<?php endif; ?>

		<!-- 发表评论
		TODO 楼中楼回复时的体验优化
		-->
	<?php if ( comments_open() ) : ?>
	<div  class="col-xs-12 col-sm-12 comments-data comments-respond" id="respond">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h3 class="comments-title"><i class="fa fa-commenting"></i>&nbsp;<?php _e( 'Leave a reply' , JUMPING_NAME); ?> <small>为了网站的健康成长，请友爱发言~</small></h3>
			</div>
		<form method="post" action="<?php echo site_url('wp-comments-post.php');?>" id="comment_form">
		<!--<div id="cancel-comment-reply"><?php /*cancel_comment_reply_link() */?></div>-->

		<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
			<p class="title welcome"><?php printf( __( 'You need <a href="%s">login</a> to reply.', JUMPING_NAME ), wp_login_url( get_permalink() ) ); ?></p>
		<?php else : ?>

			<div  class="col-xs-12 col-sm-12">
			<?php if ( is_user_logged_in() ) : ?>
				<p class="title welcome"><?php printf( __( 'Welcome <a href="%1$s">%2$s</a> back，', JUMPING_NAME ), get_option( 'siteurl' ) . '/wp-admin/profile.php', $user_identity ); ?>
					<a href="<?php echo wp_logout_url( get_permalink() ); ?>"
					   title="<?php _e( 'Log out of this account' , JUMPING_NAME); ?>"><?php _e( 'Log out »' , JUMPING_NAME); ?></a>
					<span class="cancel-comment-reply"><?php cancel_comment_reply_link('当前为对评论进行回复，点击取消该状态') ?></span>
				</p>
			</div>
			<?php else : ?>

				<?php if ( $comment_author != "" ): ?>
					<p class="title welcome">
						<?php _e( 'Welcome', JUMPING_NAME ); ?><?php printf(' <strong>%s</strong> ', $comment_author ) ?><?php _e( 'back, ' , JUMPING_NAME); ?>
						<?php _e( 'Write a comment!', JUMPING_NAME ); ?>
						<span class="cancel-comment-reply"><?php cancel_comment_reply_link('当前为对评论进行回复，点击取消该状态') ?></span>
					</p>
			</div>
			<div  class="col-xs-12 col-sm-12">
					<div id="author_info" class="author_hide">
				<?php else : ?>
			</div>
			<div class="col-xs-12 col-sm-12">
					<div id="author_info">
				<?php endif; ?>

						<div class="col-xs-12 col-sm-6 input-group jp_comments_col">
							<span class="input-group-addon" id="sizing-addon2"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php _e( 'Name', JUMPING_NAME ); ?> <small class="text-danger">*</small></span>
							<input  class="form-control"  type="text" name="author" id="author"
								   placeholder="输入一个昵称" aria-describedby="sizing-addon2"
								   value="<?php echo $comment_author; ?>">
						</div>
						<div class="col-xs-12 col-sm-6 input-group jp_comments_col">
							<span class="input-group-addon" id="sizing-addon2"><i class="fa fa-envelope"></i>&nbsp;<?php _e( 'Email', JUMPING_NAME ); ?> <small class="text-danger">*</small></span>
							<input  class="form-control"  type="text" name="email" id="mail"
									placeholder="输入您的邮箱" aria-describedby="sizing-addon2"
									value="<?php echo $comment_author_email; ?>">
						</div>
						<div class="col-xs-12 col-sm-6 input-group jp_comments_col">
							<span class="input-group-addon" id="sizing-addon2"><i class="fa fa-link"></i>&nbsp;<?php _e( 'Website', JUMPING_NAME ); ?> &nbsp;</span>
							<input  class="form-control"  type="text" name="url" id="url"
									placeholder="Example:http://yourwebsite.com" aria-describedby="sizing-addon2"
									value="<?php echo $comment_author_url; ?>">
						</div>

					</div>
			</div>
			<?php endif; ?>

			<div class="col-xs-12 col-sm-12 jp_comments_col">
				<textarea class="form-control" name="comment" id="comment" rows="4" tabindex="4" placeholder="输入评论内容..."
				          onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
			</div>

			<div class="col-xs-12 col-sm-12 ">
				<div class="col-xs-6 col-sm-6 checkbox">
					<label>
						<input type="checkbox"  name="comment_mail_notify"  id="comment_mail_notify" value="comment_mail_notify" checked="checked">
						<strong>有回复时邮件通知我</strong> <i class="fa fa-envelope-o"></i>
					</label>
				</div>

				<div class="col-xs-6 col-sm-6 jp_comments_col comments_submit">
					<input class="btn btn-primary" id="submit" type="submit" name="submit" value="<?php _e( 'Submit / Ctrl+Enter', JUMPING_NAME ); ?>" />
				</div>
			</div>

			<?php comment_id_fields(); ?>
			<?php do_action( 'comment_form', $post->ID ); ?>
				<?php endif; ?>
		</form>
		</div>
	</div>
	<?php endif; ?>
	</div>
</div>