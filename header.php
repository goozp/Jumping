<!DOCTYPE html>
<html lang=“zh-cmn-Hans”>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="renderer" content="webkit|ie-comp|ie-stand">

    <?php jp_header(); ?>

    <link rel="icon" href="../../favicon.ico">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
</head>

<body>

<!-- 导航栏 start -->
<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <!-- 适配移动端button下拉菜单  -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php bloginfo( 'url' ); ?>" target="_blank"><?php bloginfo( 'name' ); ?></a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">

            <?php
            //TODO菜单样式的控制
            $args = array(
                'theme_location'  => 'header_menu', //register_nav_menus中已经注册了header_menu的导航菜单; 该处特定只输出选择了该位置的菜单
                'menu'            => '',
                'container'       => 'div',
                'container_class' => 'jp_nav',
                'container_id'    => 'jp_top_nav',
                'menu_class'      => 'jp_menu',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 3,
                'walker'          => ''
            );
            wp_nav_menu($args); ?>

            <!-- 导航右部分-搜索框 start -->
            <ul class="nav navbar-nav navbar-right">
                <li id="navbar-search">
                    <form method="GET" class="navbar-form navbar-right" role="search"  action="<?php bloginfo( 'home' ); ?>/">
                        <div class="input-group">
                            <input type="text" name="s" id="jp-search" class="form-control" placeholder="<?php _e( 'Search keyword', JUMPING_NAME ); ?>" maxlength="100">
                            <span class="input-group-btn">
                                <button id="jp-search-button" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>
            </ul>
            <!-- 导航右部分-搜索框 end -->
        </div><!--/.nav-collapse -->
    </div>
</nav>
<!-- 导航栏 end -->

