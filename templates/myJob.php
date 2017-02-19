<?php
/*
* Template Name: myJob 职业路线模板
*/
get_header(); ?>
    <div class="container">
        <div class="col-xs-12 col-sm-12">
            <div class="row">
                <div class="col-xs-12 col-sm-12 job-tree-top">
                    <div class="col-xs-12 col-sm-3 job-tree-head">
                        <img src="<?php echo jumping_image('jumbotron_self.png'); ?>" class="img-responsive img-circle center-block" alt="侧栏个人头像" width="120px">
                    </div>
                    <div class="col-xs-12 col-sm-9 job-tree-msg">
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
                        <h3><?php echo $author_name ?>
                            <small>
                                <a href="<?php echo $weibo_name ?>" class="i_weibo" target="_blank"><i class="fa fa-weibo  fa-lg"></i></a>&nbsp;
                                <a href="<?php echo $github_name ?>" class="i_github" target="_blank"><i class="fa fa-github fa-lg"></i></a>&nbsp;
                                <a href="<?php echo $facebook_name ?>" class="i_facebook" target="_blank"><i class="fa fa-facebook-square fa-lg"></i></a>
                            </small>
                        </h3>
                        <p>
                            在立志成为大牛的路上，认真对待每一份工作。
                        </p>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 job-tree">
                    <section id="cd-timeline" class="cd-container">
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img cd-picture">
                                <img src="<?php echo jumping_image('cd-icon-picture.svg'); ?>" alt="Picture">
                            </div>

                            <div class="cd-timeline-content">
                                <h2>大学毕业</h2>
                                <p>
                                    于<a href="http://uic.edu.hk/cn/">北京师范大学-香港浸会大学联合国际学院（简称UIC）</a>毕业，我的专业是环境科学。
                                    许多同学都选择了出国深造，而我决定开始工作，做我喜欢做的事。意味着，我正式步入社会了。
                                </p>
                                <img src="http://files.gzpblog.com/wp/2016/10/uic-campus.jpg" alt="uic-1">
                                <span class="cd-date">2015-07</span>
                            </div>
                        </div>

                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img cd-movie">
                                <img src="<?php echo jumping_image('cd-icon-picture.svg'); ?>" alt="Picture">
                            </div>

                            <div class="cd-timeline-content">
                                <h2>达内科技-培训</h2>
                                <p>
                                    培训了就是培训了，这一点我不避讳。培训机构的名声并不是很好听，因为去培训的人，真的是鱼龙混杂，什么人都有，
                                    为了就业，培训出来的简历写得太好，而实际上速成出来的人，不会厉害到哪里去。当时我上课，我看那些交了两万块上课却睡觉
                                    等着就业的人，我看着也是心疼。其实还是看人的，真的感兴趣并愿意学的，自然会去学，当初我之所以选择去培训，还是觉得想
                                    快速入门一下，毕竟之前并没有系统地去学习编程，也不认识可以指定迷津的人，为了少走弯路，就去培训了。培训的结果呢，当然
                                    是有优有劣，优点是有老师引你进门，当然也只是“引进门”，不好的地方呢，就是全部人一起上课，没法选择性的学习。总得来说，
                                    也是一门经历，而且我是一个人到上海去学习了，学费自己贷款一半，工作了慢慢还，也锻炼了一下自己，何尝不可。
                                </p>
                                <img src="http://files.gzpblog.com/wp/2016/10/terena-logo.jpg" alt="terana" height="100px">
                                <p>学到了什么：围绕PHP进行web开发相关的一些基础知识（php，mysql，html，css，js等）</p>
                                <span class="cd-date">2015-9 ~ 2016-1</span>
                            </div>
                        </div>
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img cd-picture">
                                <img src="<?php echo jumping_image('cd-icon-picture.svg'); ?>" alt="Picture">
                            </div>

                            <div class="cd-timeline-content">
                                <h2>环娱易购 - PHP程序员</h2>
                                <p>
                                    我的第一份工作，虽然只在这里待了短短三个月，不仅将所学的知识运用于具体项目中，巩固了一下基础知识
                                    ，而且同事都非常nice。
                                </p>
                                <img src="http://files.gzpblog.com/wp/2016/10/cego168-logo.jpg" alt="cego" height="150px">
                                <p>
                                    学到了什么：Ecshop二次开发；微信公众号开发的基础；一些修理电脑和网络的技巧（尴尬）。
                                </p>
                                <!--<a href="" class="cd-read-more" target="_blank">相关图片</a>-->
                                <div class="row cd-timeline-imgs">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="col-xs-6 col-md-4">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-PCindex.png" alt="cego-1" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-4">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-PCusercenter.png" alt="cego-2" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-4">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-PCmywork.png" alt="cego-3" class="img-rounded">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="col-xs-6 col-md-3">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-mobileindex.png" alt="cego-4" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-goodsshow.png" alt="cego-5" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-mobileCart.png" alt="cego-6" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-mobileUserCenter.png" alt="cego-7" class="img-rounded">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="col-xs-6 col-md-3">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-gooddetail.png" alt="cego-8" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-userlogin.png" alt="cego-9" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-wechat2.png" alt="cego-10" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <img src="http://files.gzpblog.com/wp/2016/10/cego168-wechat1.png" alt="cego-11" class="img-rounded">
                                        </div>
                                    </div>
                                </div>
                                <span class="cd-date">2016-2 ~ 2016-5</span>

                            </div>
                        </div>
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img cd-movie">
                                <img src="<?php echo jumping_image('cd-icon-picture.svg'); ?>" alt="Movie">
                            </div>

                            <div class="cd-timeline-content">
                                <h2>炎武金服 - PHP开发工程师</h2>
                                <p>
                                    来到这里我才知道，原来PHP可以做的事情，远远不止是写一个网站那么简单，在这里开始尝试写接口，写后台管理系统，
                                    做APP的后台，设计简单的数据库，运用开发框架，这里可以说是一个让我大开新世界大门的地方。但是有点遗憾，就是整个后台系统由我
                                    独立开发，所以很多不足的地方，没有人能够指点我，很多时候不知道自己这样实现的好坏。不过，同样，同事也都非常nice啊。
                                </p>
                                <img src="http://files.gzpblog.com/wp/2016/10/yanwu-logo.png" alt="yanwu" height="150px">
                                <p>
                                    学到了什么：如何写接口；与IOS和安卓对接的注意事项；熟练运用ThinkPHP框架；APP后台与管理系统的开发；微信支付的接入。
                                </p>
                                <div class="row cd-timeline-imgs">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="col-xs-6 col-md-4">
                                            <img src="http://files.gzpblog.com/wp/2016/10/jlt-demo.png" alt="cego-1" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-4">
                                            <img src="http://files.gzpblog.com/wp/2016/10/jlt-card.png" alt="cego-2" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-4">
                                            <img src="http://files.gzpblog.com/wp/2016/10/jlt-share.png" alt="cego-3" class="img-rounded">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="col-xs-6 col-md-6">
                                            <img src="http://files.gzpblog.com/wp/2016/10/jlt-adminindex.png" alt="cego-4" class="img-rounded">
                                        </div>
                                        <div class="col-xs-6 col-md-6">
                                            <img src="http://files.gzpblog.com/wp/2016/10/jly-login.png" alt="cego-5" class="img-rounded">
                                        </div>
                                    </div>
                                </div>
                                <span class="cd-date">2016-5 ~ 2016-10</span>
                            </div>
                        </div>
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img cd-movie">
                                <img src="<?php echo jumping_image('cd-icon-picture.svg'); ?>" alt="Location">
                            </div>

                            <div class="cd-timeline-content">
                                <h2>声光行科技 - PHP开发工程师</h2>
                                <p>
                                    在这之前一直是在上海的，后来由于某种原因，回到广东发展。由于个人对深圳的偏好，所以来到深圳工作。
                                </p>
                                <span class="cd-date">2016-11 ~ 至今</span>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>