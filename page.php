<?php get_header(); ?>
<div class="container">
    <div class="col-xs-12 col-sm-9 page-main-frame">
        <div class="row">
            <?php if ( have_posts() ):while ( have_posts() ) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('col-xs-12 col-sm-12'); ?>>
                    <div class="row jp_page_post">
                        <div class="col-xs-12 col-sm-12 post-header">
                            <h2 class="post-title"><a href="<?php the_permalink(); ?>"
                                                      title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
                                    <i class="fa fa-comments-o"></i>
                                    <?php comments_popup_link( __( '0 reply', JUMPING_NAME ), __( '1 reply', JUMPING_NAME ), __( '% replies', JUMPING_NAME ) ); ?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-xs-12 col-sm-12 post-body clearfix">
                            <div class="post-content"><?php the_content( '' ); ?></div>
                        </div>
                    </div>
                </div>
                <?php comments_template(); ?>
            <?php endwhile; else:; ?>
                <div class="col-xs-12 col-sm-12">
                    <div class="row jp_page_post">
                        <div class="col-xs-12 col-sm-12 post-header"">
                            <h2 class="post-title"><?php _e('对不起,页面不存在'); ?></h2>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- 右侧边栏 -->
    <div class="col-xs-12 col-sm-3" id="sidebar">
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
    </div>
</div>

<?php get_footer(); ?>
