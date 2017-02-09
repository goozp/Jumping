<?php
/**
 * @name Jumping theme basic functions 基础函数库
 * @description 基础函数库
 * @version     1.0.0
 * @author      锅子 (http://www.gzpblog.com)
 * @package     Jumping
 **/

/**
 * 主题header导入
 */
function jp_header(){
    ?>
    <?php if ( is_home() ) { ?>
        <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <?php }elseif( is_search() ){ ?>
        <title><?php _e( 'Search&#34;', JUMPING_NAME );the_search_query();echo "&#34;"; ?> - <?php bloginfo( 'name' ); ?></title>
    <?php }elseif( is_single() ){ ?>
        <title><?php echo trim( wp_title( '', 0 ) ); ?> - <?php bloginfo( 'name' ); ?></title>
    <?php }elseif( is_author() ){  ?>
        <title><?php wp_title( "" ); ?> - <?php bloginfo( 'name' ); ?></title>
    <?php }elseif( is_archive() ){ ?>
        <title><?php single_cat_title(); ?> - <?php bloginfo( 'name' ); ?></title>
    <?php }elseif( is_year() ){ ?>
        <title><?php the_time( 'Y' ); ?> - <?php bloginfo( 'name' ); ?></title>
    <?php }elseif( is_month() ){ ?>
        <title><?php the_time( 'F' ); ?> - <?php bloginfo( 'name' ); ?></title>
    <?php }elseif( is_page() ){ ?>
        <title><?php echo trim( wp_title( '', 0 ) ); ?> - <?php bloginfo( 'name' ); ?></title>
    <?php }elseif( is_404() ){ ?>
        <title>404 - <?php bloginfo( 'name' ); ?></title>
    <?php }else{ ?>
        <?php wp_title('',true); }?>
    <?php

    set_keyword_description();
}

/**
 * 设置keyword和description
 */
function set_keyword_description(){
    $description = '';
    $keywords = '';
    global $post;
    if (is_home() || is_page()) {
        $keywords    = jumping_setting( 'keywords' );
        $description = jumping_setting( 'description' );
    }
    elseif (is_single()) {
        $description1 = get_post_meta($post->ID, "description", true);
        //$description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));
        // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
        $description = $description1 ? $description1 : str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));

        // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
        $keywords = get_post_meta($post->ID, "keywords", true);
        if($keywords == '') {
            $tags = wp_get_post_tags($post->ID);
            foreach ($tags as $tag ) {
                $keywords = $keywords . $tag->name . ", ";
            }
            $keywords = rtrim($keywords, ', ');
        }
    }
    elseif (is_category()) {
        // 分类的description可以到后台 - 文章 -分类目录，修改分类的描述
        $description = category_description();
        $keywords = single_cat_title('', false);
    }
    elseif (is_tag()){
        // 标签的description可以到后台 - 文章 - 标签，修改标签的描述
        $description = tag_description();
        $keywords = single_tag_title('', false);
    }
    $description = trim(strip_tags($description));
    $keywords = trim(strip_tags($keywords));
    ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <?php
}


/**
 * 获取主题设置
 * @param string $key
 * @return mixed
 */
function jumping_setting( $key ) {
    $defaults = array(
        'description'               => '',
        'keywords'                  => '',
    );
    $settings = get_option( JUMPING_NAME . '_settings' );
    $settings = wp_parse_args( $settings, $defaults );
    return $settings[ $key ];
}

/**
 * 主题路径
 * @param $path
 * @return string
 */
function jumping_path( $path ) {
    $file_path = JUMPING_PATH . '/' . $path;
    return $file_path;
}

/**
 * 主题路径url
 * @param $file_path
 * @return string
 */
function jumping_file_url( $file_path ) {
    $file_path = JUMPING_THEME_URL . '/' . $file_path;
    return $file_path;
}

/**
 * 主题图片url获取
 * @param string $image_name
 * @return string
 */
function jumping_image( $image_name ) {
    $image_url = jumping_file_url( 'public/images/' . $image_name );
    return $image_url;
}

/**
 * 主题css样式路径
 * @param  string $style_name
 * @return string
 */
function jumping_style( $style_name ) {
    $style_url = jumping_file_url( 'public/css/' . $style_name );
    return $style_url;
}


/**
 * 主题javascript文件url
 * @param string $script_name
 * @return string
 */
function jumping_script( $script_name ) {
    $script_url = jumping_file_url( 'public/js/' . $script_name );

    return $script_url;
}

/**
 * 文章阅读量
 */
function jumping_views() {
    if ( function_exists( 'the_views' ) ) {
        global $post;
        ?>
        <li class="inline-li"><i class="fa fa-eye"></i>&nbsp;<?php echo jumping_views_count() . __( ' views', JUMPING_NAME ); ?></li>
        <?php
    }
}

/**
 * 文章阅读量查询
 * @param $post_id
 * @return mixed|string
 */
function jumping_views_count( $post_id = null ) {
    global $post;
    if ( ! $post_id ) {
        $post_id = $post->ID;
    }
    $post_views = get_post_meta( $post_id, 'views', true );
    if ( $post_views > 1000 ) {
        $post_views = sprintf( "%.2fk", $post_views / 1000 );
    }
    return $post_views;
}

/**
 * 文章截取
 * @param string $content
 * @param int    $limit
 * @return string
 */
function jumping_excerpt( $content, $limit = 100 ) {
    if ( $content ) {
        $content = preg_replace( "/\[.*?\].*?\[\/.*?\]/is", "", $content );
        $content = mb_strimwidth( strip_tags( apply_filters( 'the_content', $content ) ), 0, $limit, "..." );
    }

    return strip_tags( $content );
}

/*
 * 处理回复留言字符串长度
 * @param string $comment
 * @return string
 * **/
function jummping_deal_comments( $comment){
    if (function_exists('mb_substr')){
        $len = mb_strlen($comment);
        if ($len > 30){
            $comment = mb_substr($comment, 0, 27).'...';
            return $comment;
        }else{
            return $comment;
        }
    }
    else{
        $len = strlen($comment);
        if ($len > 150){
            $comment = substr($comment, 147).'...';
            return $comment;
        }else{
            return $comment;
        }
    }

}

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
                </div>
                <div class="comment-text"><?php comment_text() ?></div>
                <div class="comment-date-reply">
                    <span class="comment-span comment-date">
                        <i class="fa fa-clock-o"></i>
                        <?php echo date('Y-m-d H:i',strtotime($comment->comment_date_gmt)); ?>
                    </span>
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
                <?php echo get_avatar( $comment, $size = '40', $default = '', $alt = '', array('class' => 'img-circle',) ) ?>
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
            </div>
            <div class="comment-text">
				<span class="comment-to"><a href="<?php echo "#comment-" . $parent_id; ?>"
                                            title="<?php echo mb_strimwidth( strip_tags( apply_filters( 'the_content', $comment_parent->comment_content ) ), 0, 100, "..." ); ?>">@<?php echo $comment_parent->comment_author; ?></a>：
                </span>
                <?php echo get_comment_text(); ?>
            </div>
            <div class="comment-date-reply">
                <span class="comment-span comment-date">
                    <i class="fa fa-clock-o"></i>
                    <?php echo date('Y-m-d H:i',strtotime($comment->comment_date_gmt)); ?>
                </span>
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