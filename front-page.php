<?php get_header(); ?>

<div class="container">
    <!-- 左侧主栏 -->
    <div class="col-xs-12 col-sm-9 main-frame">
        <div class="row main-frame-row">
            <?php
            $full_content = jumping_setting( 'full-content' );

            if ( have_posts() ) : while ( have_posts() ) : the_post();
                $post_thumbnail = jumping_thumbnail( 'index-thumbnail', 260, 260 );
                $post_class     = 'col-xs-12 col-sm-12 col-lg-12 jp_post_list';

                if ( !$full_content && $post_thumbnail["exist"] ) {
                    $post_class .= ' jp_post_thumbnail';
                }
                elseif( !$full_content && !$post_thumbnail["exist"] ) {
                    $post_class .= ' jp_post_normal';
                }
                ?>
            <div  id="post-<?php the_ID(); ?>" class="<?php echo $post_class; ?>">
                <div class="col-xs-12 col-sm-12 col-lg-12 post_title">
                    <h2>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        <?php if ( is_sticky() ) { ?>
                            <span class="post-sticky"><?php _e( 'Stick', JUMPING_NAME ); ?></span>
                        <?php } ?>
                    </h2>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-12 post_meta">
                    <ul class="post_meta_ul">
                        <li class="inline-li">
                            <i class="fa fa-calendar-check-o"></i>
                            <?php echo date('Y-m-d H:i',strtotime($post->post_date_gmt)); ?>
                        </li>
                        <li class="inline-li">
                            <span class="post-span"> | </span>
                        </li>
                        <li class="inline-li">
                            <i class="fa fa-tags"></i>
                            <?php the_category( ' , ' ); ?>
                        </li>
                        <li class="inline-li">
                            <span class="post-span"> | </span>
                        </li>
                        <li class="inline-li">
                            <?php jumping_views(); ?>
                        </li>
                        <li class="inline-li">
                            <i class="fa fa-comments-o"></i>
                            <?php comments_popup_link( __( '0 reply', JUMPING_NAME ), __( '1 reply', JUMPING_NAME ), __( '% replies', JUMPING_NAME ) ); ?>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-12 post_body">
                    <?php if ( $full_content ) {
                        the_content();
                    } else {
                        if ( $post_thumbnail["exist"] ) : ?>
                            <div class="col-xs-12 col-sm-2 col-lg-2 post-thumbnail">
                                <a href="<?php the_permalink() ?>" rel="bookmark">
                                    <img class="lazy  img-thumbnail"
                                         src="<?php echo jumping_thumbnail_url(jumping_image('placeholder.png')); ?>"
                                         data-original="<?php echo jumping_thumbnail_url($post_thumbnail); ?>"
                                         alt="<?php the_title(); ?>" width="130" height="130"/>
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-10 col-lg-10 post-content">
                                <div class="col-xs-12 col-sm-12 col-lg-12 post-content-main">
                                    <?php
                                    $short_post = jumping_excerpt( $post->post_content, 320 );
                                    $short_post = empty($short_post) ? "该文章没有预览内容，请直接进入文章页浏览。" : $short_post;
                                    printf( '<p>%s</p>', $short_post );
                                    ?>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-lg-12 post-view-all">
                                    <a class="view-all" href="<?php the_permalink() ?>">阅读全文 &raquo;</a>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="col-xs-12 col-sm-12 col-lg-12 post-content">
                                <div class="col-xs-12 col-sm-12 col-lg-12 post-content-main">
                                    <?php
                                    $short_post = jumping_excerpt( $post->post_content, 320 );
                                    $short_post = empty($short_post) ? "该文章没有预览内容，请直接进入文章页浏览。" : $short_post;
                                    printf( '<p>%s</p>', $short_post );
                                    ?>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-lg-12 post-view-all">
                                    <a class="view-all" href="<?php the_permalink() ?>">阅读全文 &raquo;</a>
                                </div>
                            </div>
                        <?php endif;
                    } ?>
                </div>
            </div>

            <?php endwhile; else: ?>
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h2><?php _e('抱歉。'); ?></h2>
                <p><?php _e('没有内容！'); ?></p>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <nav class="text-center" aria-label="Page navigation">
                <ul class="pagination">
                    <?php jumping_pagenavi(); ?>
                </ul>
            </nav>
        </div>
    </div>

    <!-- 右侧边栏 -->
    <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
        <div class="widget_self">
            <img src="<?php echo jumping_image('jumbotron_self.png'); ?>" class="img-responsive img-circle center-block" alt="侧栏个人头像" width="120px">
            <div class="widget_self_intro text-center">
                <h4>锅子</h4>
                <a href="#" class="i_weibo"><i class="fa fa-weibo  fa-lg"></i></a>
                <a href="#" class="i_github"><i class="fa fa-github fa-lg"></i></a>
                <a href="#" class="i_facebook"><i class="fa fa-facebook-square fa-lg"></i></a>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div><!--/.sidebar-offcanvas-->
</div>


<?php get_footer(); ?>
