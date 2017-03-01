<?php
/*
 * Template Name: treeTime 时间树页面
 */
get_header(); ?>

<div class="container">
    <div class="col-xs-12 col-sm-9">
        <div class="row">
            <div class="col-xs-12 col-sm-12 tree-body">
                <h3>博客历程</h3>
                <ul class="timeline">
                    <li class="tree-top">
                        <div class="version">2017.02.28</div>
                        <div class="number">8</div>
                        <div class="content">
                            <p>
                                服务器从阿里云共享虚拟主机迁移到云服务器ECS
                            </p>
                        </div>
                    </li>
                    <li class="tree-top">
                        <div class="version">2017.02.12</div>
                        <div class="number">7</div>
                        <div class="content">
                            <p>
                                开始使用自己制作的第一款主题Jumping，定制自己所需要的功能和需求。
                            </p>
                        </div>
                    </li>
                    <li class="tree-top">
                        <div class="version">2016.10.09</div>
                        <div class="number">6</div>
                        <div class="content">
                            <p>
                                开始使用阿里云对象存储OSS存储网站资源，网站日志。
                            </p>
                        </div>
                    </li>
                    <li class="tree-top">
                        <div class="version">2016.10.07</div>
                        <div class="number">5</div>
                        <div class="content">
                            <p>
                                程序员的折腾劲，博客正式从Typecho转到Wordpress。
                            </p>
                        </div>
                    </li>
                    <li class="tree-top">
                        <div class="version">2016.02.19</div>
                        <div class="number">4</div>
                        <div class="content">
                            <p>
                                迁移到阿里云主机（虚拟主机）
                            </p>
                        </div>
                    </li>
                    <li class="tree-top">
                        <div class="version">2016.02.06</div>
                        <div class="number">3</div>
                        <div class="content">
                            <p>
                                博客正式上线，使用Typecho博客系统，虽然已备案，但还未使用国内主机，使用优易主机（香港主机）。
                            </p>
                        </div>
                    </li>
                    <li class="tree-top">
                        <div class="version">2016.01.18</div>
                        <div class="number">2</div>
                        <div class="content">
                            <p>
                                申请新域名gzpblog.com，并备案成功。
                            </p>
                        </div>
                    </li>
                    <li class="tree-bottom">
                        <div class="version">2015.10.01</div>
                        <div class="number">1</div>
                        <div class="content">
                            <p>
                                开始接触独立博客，并且开始使用开源博客系统，最初使用了Wordpress，然后使用Z-blog；申请了域名，并且将博客上线。
                            </p>
                        </div>
                    </li>
                 <ul>
            </div>

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
                <a href="<?php echo $weibo_name ?>" class="i_weibo" target="_blank" rel="external nofollow"><i class="fa fa-weibo  fa-lg"></i></a>
                <a href="<?php echo $github_name ?>" class="i_github" target="_blank" rel="external nofollow"><i class="fa fa-github fa-lg"></i></a>
                <a href="<?php echo $facebook_name ?>" class="i_facebook" target="_blank" rel="external nofollow"><i class="fa fa-facebook-square fa-lg"></i></a>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>




<?php get_footer(); ?>
