<?php
/**
 * @name Jumping theme functions 功能函数库
 * @description 功能函数库
 * @version     1.0.0
 * @author      锅子 (http://www.gzpblog.com)
 * @package     Jumping
 **/

/**
 * Thumbnail缩略图检测
 * @param string $type
 * @param int    $width
 * @param int    $height
 * @return array
 */
function jumping_thumbnail( $type = 'full', $width = 0, $height = 0 ) {
    global $post;

    $result = array(
        'exist' => false,
        'url'   => null,
        'size'  => array( $width, $height ),
        'crop'  => true
    );

    $size_array = array(
        'full'            => array( $width, $height ),
        'index-thumbnail' => array( 260, 260 )
    );

    if ( has_post_thumbnail() ) { //有特色图片时
        $attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $type );

        $result['exist'] = true;
        $result['url']   = $attachment_image[0];

        // correct image size that don't need crop
        if ( $size_array[ $type ][0] == $attachment_image[1] && $size_array[ $type ][1] == $attachment_image[2] ) {
            $result['crop'] = false;
        }

    } else if ( ! jumping_setting( 'thumbnail' ) ) { //没有特色图片时查看配置是否选择显示文章中插入的图片
        ob_start();
        ob_end_clean();

        /* filter all the images in the post content
         * 正则匹配文章中的图片img标签
         * TODO 效率
         */
        preg_match_all( '/\<img.+?src="(.+?)".*?\/>/is', $post->post_content, $matches, PREG_SET_ORDER );
        $count = count( $matches );

        if ( $count > 0 ) {
            $result['exist'] = true;
            $result['url']   = $matches[0][1];
        }
    }
    return $result;
}

/**
 * 制作缩略图
 * @param array|string $obj
 * @param int          $width
 * @param int          $height
 * @param bool         $is_avatar
 * @return string
 */
function jumping_thumbnail_url( $obj, $width = 0, $height = 0, $is_avatar = false ) {
    $url       = '';
    $need_crop = true;

    if ( is_array( $obj ) ) {
        $url       = $obj['url'];
        $width     = $obj['size'][0];
        $height    = $obj['size'][1];
        $need_crop = $obj['crop'];
    } else if ( is_string( $obj ) ) {
        $url = $obj;
    }

    if ( $need_crop && !$is_avatar) {
        $url = sprintf( '%s&#63;src=%s&#38;w=%s&#38;h=%s&#38;zc=1&#38;q=100', jumping_file_url( 'timthumb.php' ), urlencode( $url ), $width, $height );
    }

    return $url;
}


/**
 * 分页
 * @param int $space
 */
function jumping_pagenavi( $space = 5 ) {
    if ( is_singular() ) {
        return;
    }

    global $wp_query, $paged;
    $max_page = $wp_query->max_num_pages;

    if ( $max_page == 1 ) {
        return;
    }
    if ( empty( $paged ) ) {
        $paged = 1;
    }


    if ( $paged > 1 ) {
        printf( '<li><a class="page-numbers" href="%s" title="%s" aria-label="Previous"><span aria-hidden="true">%s</span></a></li>', esc_html( get_pagenum_link( $paged - 1 ) ), '« Previous', '«' );
    }
    if ( $paged > $space + 2 ) {
        echo '<li><span class="page-numbers">...</span></li>';
    }
    for ( $i = $paged - $space; $i <= $paged + $space; $i ++ ) {
        if ( $i > 0 && $i <= $max_page ) {
            if ( $i == $paged ) {
                echo '<li class="active"><span class="page-numbers" >'.$i.'</span></li>';
            } else {
                printf( '<li><a class="page-numbers" href="%s" title="page %s">%s</a></li>', esc_html( get_pagenum_link( $i ) ), $i, $i );
            }
        }
    }
    if ( $paged < $max_page - $space - 1 ) {
        echo '<li><span class="page-numbers">...</span></li>';
    }
    if ( $paged < $max_page ) {
        printf( '<li><a class="page-numbers" href="%s" title="%s" aria-label="Next"><span aria-hidden="true">%s</span></a></li>', esc_html( get_pagenum_link( $paged + 1 ) ), 'Next »', '»' );
    }
}


/**
 * 评论回调函数
 * @param $comment
 * @param $args
 * @param $depth
 */
function jumping_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    global $commentcount;

    if ( ! $commentcount ) {
        $page         = ( ! empty( $in_comment_loop ) ) ? get_query_var( 'cpage' ) - 1 : get_page_of_comment( $comment->comment_ID, $args ) - 1;
        $cpp          = get_option( 'comments_per_page' );
        $commentcount = $cpp * $page;
    }

    if ( ! $comment->comment_parent ) {
        //$email  = $comment->comment_author_email;
        $avatar = get_avatar( $comment, $size = '50', $default = '', $alt = '', array('class' => 'img-circle') );
        ?>
        <li <?php comment_class('media'); ?> id="li-comment-<?php comment_ID() ?>">
            <div class="media-left text-center">
                <div class="comments-data-avatar">
                    <?php echo $avatar; ?>
                </div>
            <span class="comments-data-floor">
                <?php
                ++ $commentcount;
                printf( __( '%s Floor', JUMPING_NAME ), $commentcount );
                ?>
            </span>
            </div>
            <div class="media-body" id="comment-<?php comment_ID(); ?>">
                <div class="comment-person">
                    <span class="comment-span <?php if ( $comment->user_id == 1 ) {
                        echo "comment-author";
                    } ?>">
                        <?php printf( '%s', get_comment_author_link() ) ?>
                    </span>
                    <?php if ( $comment->user_id == 1 ) {?>
                        <span class="label label-default comments-bozhu">博主</span>
                    <?php } ?>
                    &nbsp;
                    <?php CID_print_comment_flag(); echo ' ';CID_print_comment_browser(); ?>
                </div>
                <div class="comment-text"><?php comment_text() ?></div>
                <div class="comment-date-reply">
                    <span class="comment-span comment-date">
                        <i class="fa fa-clock-o"></i>
                        <?php echo date('Y-m-d H:i',strtotime($comment->comment_date)); ?>
                    </span>
                    &nbsp;&nbsp;&nbsp;
                    <i class="fa fa-reply"></i>
                    <?php comment_reply_link( array_merge( $args, array(
                        'depth'      => $depth,
                        'max_depth'  => $args['max_depth'],
                        'reply_text' => __( 'Reply', JUMPING_NAME )
                    ) ) ) ?>
                </div>
            </div>
        </li>
    <?php } else {
        ?>
        <li <?php comment_class('media'); ?> id="li-comment-<?php comment_ID() ?>">
            <div class="media-left">
                <div class="comments-data-avatar">
                    <?php echo get_avatar( $comment, $size = '50', $default = '', $alt = '', array('class' => 'img-circle',) ) ?>
                </div>
            </div>
            <div class="media-body media-body-children" id="comment-<?php comment_ID(); ?>">
                <div class="comment-person">
				<span class="comment-span <?php if ( $comment->user_id == 1 ) {
                    echo "comment-author";
                } ?>">
					<?php
                    $parent_id      = $comment->comment_parent;
                    $comment_parent = get_comment( $parent_id );
                    printf( '%s', get_comment_author_link() );
                    ?>
				</span>
                    <?php if ( $comment->user_id == 1 ) {?>
                        <span class="label label-default comments-bozhu">博主</span>
                    <?php } ?>
                    &nbsp;
                    <?php CID_print_comment_flag(); echo ' ';CID_print_comment_browser(); ?>
                </div>
                <div class="comment-text">
                    <p>
                    <span class="comment-to"><a href="<?php echo "#comment-" . $parent_id; ?>"
                                                title="<?php echo mb_strimwidth( strip_tags( apply_filters( 'the_content', $comment_parent->comment_content ) ), 0, 100, "..." ); ?>">@<?php echo $comment_parent->comment_author; ?></a>：
                    </span>
                        <?php echo get_comment_text(); ?>
                    </p>
                </div>
                <div class="comment-date-reply">
                <span class="comment-span comment-date">
                    <i class="fa fa-clock-o"></i>
                    <?php echo date('Y-m-d H:i',strtotime($comment->comment_date)); ?>
                </span>
                    &nbsp;&nbsp;&nbsp;
                    <i class="fa fa-reply"></i>
                    <?php comment_reply_link( array_merge( $args, array(
                        'depth'      => $depth,
                        'max_depth'  => $args['max_depth'],
                        'reply_text' => __( 'Reply', JUMPING_NAME )
                    ) ) ) ?>
                </div>
            </div>
        </li>
    <?php }
}

/*
 * 回复邮件提醒功能（phpMailer smtp）
 * */
function comment_mail_notify($comment_id) {
    $admin_notify = '1'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
    $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改为你指定的 e-mail.
    $comment = get_comment($comment_id);
    $comment_author_email = trim($comment->comment_author_email);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    global $wpdb;
    if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
        $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
    if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
        $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
    $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
    $spam_confirmed = $comment->comment_approved;
    if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
        //发送邮件的操作
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '您在 [' . get_option("blogname") . '] 的留言有了回应';
        $message = '
			<div style="background-color:#F8F8F8; border:1px solid #F0F8FB; color: #000; padding:0 10px; -moz-border-radius:10px; -webkit-border-radius:10px; -khtml-border-radius:10px; border-radius:10px;">
				<p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>，您好！</p>
				<p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言：<br />'
            . trim(get_comment($parent_id)->comment_content) . '</p>
				<p><strong>' . trim($comment->comment_author) . '</strong> 给您的回应:<br />'
            . trim($comment->comment_content) . '<br /></p>
				<p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看完整的回应内容</a>。</p>
				<p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a>！</p>
				<p>(此邮件由系统发出，请勿回复。)</p>
			</div>';
        header("content-type:text/html;charset=utf-8");
        ini_set("magic_quotes_runtime",0);
        require get_template_directory().'/Libraries/PHPMailer/class.phpmailer.php';
        try {
            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->CharSet='UTF-8';
            $mail->SMTPAuth = true;
            if (jumping_setting('email-port') == '25'){
                $mail->Port = 25;
            }elseif (jumping_setting('email-port') == '465'){
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
            }
            $mail->Host = jumping_setting('email-smtp');//邮箱smtp地址
            $mail->Username = jumping_setting('email-name');//你的邮箱账号
            $mail->Password = jumping_setting('email-password');//你的邮箱密码
            $mail->From = $mail->Username;//你的邮箱账号
            $mail->FromName = get_option('blogname');
            $to = $to;
            $mail->AddAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->WordWrap = 80;
            //$mail->AddAttachment("f:/test.png"); //可以添加附件
            $mail->IsHTML(true);
            $mail->Send();
        } catch (phpmailerException $e) {
            // echo "邮件发送失败：".$e->errorMessage(); //测试的时候可以去掉此行的注释
        }
    }
}
add_action('comment_post', 'comment_mail_notify');

