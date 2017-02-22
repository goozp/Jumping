<?php
/**
 * @name jumping-functions
 * @description jumping theme functions file
 * @version     1.0.0
 * @author      锅子(http://www.gzpblog.com)
 * @url https://mufeng.me/wordpress-mobile-theme-kunkka.html
 * @package     Jumping
 **/

/**
 * Define constants
 */
define( 'JUMPING_NAME', 'Jumping' );
define( 'JUMPING_VERSION', '1.0.0' );
define( 'JUMPING_PATH', dirname( __FILE__ ) );
define( "JUMPING_THEME_URL", get_bloginfo( 'template_directory' ) );

/**
 * 导入主题核心文件
 */
get_template_part( 'functions/jumping-basic' );
get_template_part( 'functions/jumping-functions' );
get_template_part( 'functions/jumping-widget' );

/**
 * 导入语言包
 */
load_theme_textdomain( JUMPING_NAME, jumping_path( 'languages' ) );

/**
 * 导入显示访客信息文件
 */
include("public/show-useragent/show-useragent.php");

/**
 * 启用rss feed
 */
add_theme_support( 'automatic-feed-links' );

/**
 * 注册导航菜单
 */

register_nav_menus( array(
    'header_menu' => '顶部导航菜单', //注册顶部导航菜单key为header_menu; 在顶部导航处调用该key,如果用户选择了就能正常显示
) );

/**
 * 启用链接管理(友链)
 */
add_filter('pre_option_link_manager_enabled','__return_true');

/**
 * 只对管理员显示工具条
 */
if ( !current_user_can( 'manage_options' ) ) {
    add_filter('show_admin_bar', '__return_false');
}

/** 侧边栏组件widgets注册(使主题支持侧边栏) */
if( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Jumping-sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}

/* 主题设置引入 */
if ( is_admin() ) {
    //TODO 检测版本更新

    get_template_part( 'functions/jumping-setting' ); //主题配置文件
    //实例化配置
    new Jumping_setting();
}

/* 添加管理工具栏 */
add_action( 'admin_bar_menu', 'jumping_toolbar_link', 999 );
function jumping_toolbar_link( $wp_admin_bar ) {
    $args = array(
        'title' => 'Jumping 主题设置',
        'href'  => admin_url( 'admin.php?page=jumping_setting' ),
        'meta'  => array(
            'title' => 'jumping 主题设置'
        )
    );
    $wp_admin_bar->add_node( $args );
}

/* 加载js,css文件 */
function jumping_scripts_with_jquery()
{
    //main css
    wp_enqueue_style( 'style', get_bloginfo( 'stylesheet_url' ), $deps = array(), JUMPING_VERSION  );
    //404 css
    wp_register_style( '404', get_template_directory_uri() . '/public/css/404.css' );
    if ( is_404() ) {
        wp_enqueue_style( '404' );
    }

    //JQuery js
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', jumping_script( 'jquery.min.js' ), false, '1.11.3' );
    wp_enqueue_script( 'jquery', false, false, '1.11.3' );
    // bootstrap js
    wp_register_script( 'custom-script', get_template_directory_uri() . '/public/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.3.7' );
    wp_enqueue_script( 'custom-script' );
    //jumping js
    wp_enqueue_script( 'jumping-main', jumping_script( 'jumping.js' ), null, JUMPING_VERSION, false );
    //archives.js archives.css
    if( is_page_template( 'templates/archives.php' ) ){
        wp_enqueue_script( 'jumping-archives', jumping_script( 'archives.js' ), null, JUMPING_VERSION, false );
        wp_register_style( 'archives', get_template_directory_uri() . '/public/css/archives.css', null, JUMPING_VERSION  );
        wp_enqueue_style( 'archives' );
    }
    if( is_page_template( 'templates/treeTime.php' ) ){
        wp_enqueue_script( 'jumping-tree', jumping_script( 'tree.js' ), null, JUMPING_VERSION, false );
        wp_register_style( 'tree', get_template_directory_uri() . '/public/css/tree.css', null, JUMPING_VERSION );
        wp_enqueue_style( 'tree' );
    }
    if( is_page_template( 'templates/myJob.php' ) ){
        wp_register_style( 'job', get_template_directory_uri() . '/public/css/job.css', null, JUMPING_VERSION );
        wp_enqueue_style( 'job' );
    }

}
add_action( 'wp_enqueue_scripts', 'jumping_scripts_with_jquery' );


// 移除WordPress Emoji表情
remove_action( 'admin_print_scripts' ,	'print_emoji_detection_script');
remove_action( 'admin_print_styles'  ,	'print_emoji_styles');
remove_action( 'wp_head'             ,	'print_emoji_detection_script',	7);
remove_action( 'wp_print_styles'     ,	'print_emoji_styles');
remove_filter( 'the_content_feed'    ,	'wp_staticize_emoji');
remove_filter( 'comment_text_rss'    ,	'wp_staticize_emoji');
remove_filter( 'wp_mail'             ,	'wp_staticize_emoji_for_email');
// 移除头部wp_head没必要的加载
remove_action( 'wp_head', 'rsd_link' ); //针对Blog的远程离线编辑器接口
remove_action( 'wp_head', 'wlwmanifest_link' ); //Windows Live Writer接口
remove_action( 'wp_head', 'index_rel_link' ); //移除当前页面的索引
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //移除后面文章的url
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); //移除最开始文章的url
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );//自动生成的短链接
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); ///移除相邻文章的url
remove_action( 'wp_head', 'wp_generator' ); // 移除版本号

/* 过滤google字体 */
add_filter( 'gettext_with_context', 'jp_google_fonts', 888, 4 );
function jp_google_fonts( $translations, $text, $context, $domain ) {
    if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
        $translations = 'off';
    }
    return $translations;
}

/* 新发表文章,修改文章时清空 zww_archives_list归档页缓存 */
function clear_db_cache_archives_list() {
    update_option('zww_db_cache_archives_list', '');
}
add_action('save_post', 'clear_db_cache_archives_list');

//文章外链跳转
add_filter('the_content','link_jump',999);
function link_jump($content){
    preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/',$content,$matches);
    if($matches){
        foreach($matches[2] as $val){
            if(strpos($val,'://')!==false && strpos($val,home_url())===false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff)/i',$val) && !preg_match('/(ed2k|thunder|Flashget|flashget|qqdl):\/\//i',$val)){
                $content=str_replace("href=\"$val\"", "href=\"".home_url()."/go/?url=".base64_encode($val)."\" rel=\"nofollow\"",$content);
            }
        }
    }
    return $content;
}
//评论者链接跳转
function Bing_comment_author_link(){
    $url = get_comment_author_url();
    $author = get_comment_author();
    if( empty( $url ) || $url == 'http://' ) return $author;
    return "<a href='".home_url()."/go/?url=$url' rel='external nofollow' target='_blank' class='url'>$author</a>";
}
add_filter( 'get_comment_author_link', 'Bing_comment_author_link', 2 );


/* 修改Gravatar服务器为cn.gravatar.com */
function mytheme_get_avatar( $avatar ) {
    $avatar = preg_replace( "/http:\/\/(www|\d).gravatar.com/","http://cn.gravatar.com",$avatar );
    return $avatar;
}
add_filter( 'get_avatar', 'mytheme_get_avatar' );

?>