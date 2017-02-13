<?php get_header(); ?>

    <div class="container">
        <div class="col-xs-12 col-sm-9 main-frame four0four">
            <div class="col-xs-12 col-sm-12 four0four-title text-center">
                <p><span>4</span><span>0</span><span>4</span></p>
            </div>

            <div class="col-xs-12 col-sm-12 four0four-words text-center">
                <p>该页面不存在(´･ω･`)</p>
            </div>

            <div class="col-xs-12 col-sm-12 four0four-search">
                <form method="GET" class="col-xs-12 col-sm-6 col-sm-offset-3" role="search" action="<?php bloginfo( 'home' ); ?>/">
                    <div class="input-group">
                        <input type="text" name="form-control" id="jp-search" class="form-control" placeholder="<?php _e( 'Search keyword', JUMPING_NAME ); ?>" maxlength="100">
                        <span class="input-group-btn">
                            <button id="jp-search-button" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
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