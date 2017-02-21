<?php get_header(); ?>
    <div class="container">
        <div class="col-xs-12 col-sm-9 page-main-frame">
            <div class="row">
                <div class="col-xs-12 col-sm-12 jp_page_breadcrumbs visible-xs-inline-block visible-sm-block visible-md-block visible-lg-block">
                    <ol class="breadcrumb">
                        <li><a rel="bookmark" href="<?php echo home_url(); ?>"><?php _e('Home', JUMPING_NAME);?></a></li>
                        <?php the_post(); ?>
                        <li><?php if($category=get_the_category($post->ID)) echo (get_category_parents($category[0]->term_id, true, '</li><li>')); ?>
                            <?php the_title(); ?></li>
                        <?php rewind_posts(); ?>
                    </ol>
                </div>

                <?php if ( have_posts() ):while ( have_posts() ) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>"  class="col-xs-12 col-sm-12">
                    <div class="row jp_page_post">
                        <div class="col-xs-12 col-sm-12 post-header">
                            <h2 class="post-title"><a href="<?php the_permalink(); ?>"
                                                      title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-12 post_meta">
                            <ul class="post_meta_ul">
                                <li class="inline-li">
                                    <i class="fa fa-calendar-check-o"></i>
                                    <?php echo date('Y-m-d H:i',strtotime($post->post_date)); ?>
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

                        <div class="col-xs-12 col-sm-12 post-body clearfix">
                            <div class="post-content"><?php the_content( '' ); ?></div>
                        </div>

                        <div class="col-xs-12 col-sm-12">
                            <br>
                        </div>

                        <div class="col-xs-12 col-sm-12 post-tags">
                            <i class="fa fa-tags"></i> 标签：<?php the_tags('', '，', ''); ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; endif; ?>

                <!-- 上一页下一页 begin -->
                <div class="col-xs-12 col-sm-12 lastAndNext">
                    <div class="col-xs-12 col-sm-6 lastAndNext-left">
                        <p><?php if (get_previous_post()) { previous_post_link('上一篇：%link');} else {echo "上一篇：没有了，已经是最后文章";} ?></p>
                    </div>
                    <div class="col-xs-12 col-sm-6 lastAndNext-right">
                        <p><?php if (get_next_post()) { next_post_link('下一篇：%link');} else {echo "下一篇：没有了，已经是最新文章";} ?></p>
                    </div>
                </div>
                <!-- 上一页下一页 end -->

                <!-- 百度分享 begin -->
                <div class="col-xs-12 col-sm-12 bdsharebuttonbox">
                    <a href="#" class="bds_more" data-cmd="more"></a>
                    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                    <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
                    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                    <a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a>
                    <a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a>
                    <a href="#" class="bds_youdao" data-cmd="youdao" title="分享到有道云笔记"></a>
                    <a href="#" class="bds_evernotecn" data-cmd="evernotecn" title="分享到印象笔记"></a>
                </div>
                <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                <!-- 百度分享 end -->


                    <?php comments_template(); ?>
            </div>
        </div>

        <!-- 右侧边栏 -->
        <div class="col-xs-12 col-sm-3" id="sidebar">
            <div class="widget_self">
                <img src="<?php echo jumping_image('jumbotron_self.png'); ?>" class="img-responsive img-circle center-block" alt="侧栏个人头像" width="120px">
                <div class="widget_self_intro text-center">
                    <?php
                    $authorName     = jumping_setting( 'author-name' );
                    $author_name    = empty($authorName) ? '博主' : $authorName;
                    $weiboName      = jumping_setting( 'weibo-link' );
                    $weibo_name     = empty($weiboName) ? '#' : $weiboName;
                    $facebookName  = jumping_setting( 'facebook-link' );
                    $facebook_name  = empty($facebookName) ? '#' : $facebookName;
                    $githubName    = jumping_setting( 'github-link' );
                    $github_name    = empty($githubName) ? '#' : $githubName;
                    ?>
                    <h4><?php echo $author_name ?></h4>
                    <a href="<?php echo $weibo_name ?>" class="i_weibo" target="_blank"><i class="fa fa-weibo  fa-lg"></i></a>
                    <a href="<?php echo $github_name ?>" class="i_github" target="_blank"><i class="fa fa-github fa-lg"></i></a>
                    <a href="<?php echo $facebook_name ?>" class="i_facebook" target="_blank"><i class="fa fa-facebook-square fa-lg"></i></a>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>