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
get_template_part( 'libraries/jumping-basic' );
get_template_part( 'libraries/jumping-widget' );

/**
 * 导入语言包
 */
load_theme_textdomain( JUMPING_NAME, jumping_path( 'languages' ) );

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

    get_template_part( 'libraries/jumping-setting' ); //主题配置文件
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

/* 导入js文件 */
function jumping_scripts_with_jquery()
{
    // Register the script like this for a theme:
    wp_register_script( 'custom-script', get_template_directory_uri() . '/public/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'custom-script' );
    wp_enqueue_script( 'jumping-main', jumping_script( 'jumping.js' ), null, JUMPING_VERSION, false );
}
add_action( 'wp_enqueue_scripts', 'jumping_scripts_with_jquery' );


/* 垃圾评论拦截 srart */
class anti_spam {
    function anti_spam() {
        if ( !current_user_can('level_0') ) {
            add_action('template_redirect', array($this, 'w_tb'), 1);
            add_action('init', array($this, 'gate'), 1);
            add_action('preprocess_comment', array($this, 'sink'), 1);
        }
    }

    function w_tb() {
        if ( is_singular() ) {
            ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
				"textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
        }
    }

    function gate() {
        if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
            $_POST['comment'] = $_POST['w'];
        } else {
            $request = $_SERVER['REQUEST_URI'];
            $referer = isset($_SERVER['HTTP_REFERER'])         ? $_SERVER['HTTP_REFERER']         : '隐瞒';
            $IP      = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] . ' (透过代理)' : $_SERVER["REMOTE_ADDR"];
            $way     = isset($_POST['w'])                      ? '手动操作'                       : '未经评论表格';
            $spamcom = isset($_POST['comment'])                ? $_POST['comment']                : null;
            $_POST['spam_confirmed'] = "请求: ". $request. "\n来路: ". $referer. "\nIP: ". $IP. "\n方式: ". $way. "\n內容: ". $spamcom. "\n -- 记录成功 --";
        }
    }

    function sink( $comment ) {
        if ( !empty($_POST['spam_confirmed']) ) {
            if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
            //方法一: 直接挡掉, 將 die(); 前面两斜线刪除即可.
            die();
            //方法二: 标记为 spam, 留在资料库检查是否误判.
            //add_filter('pre_comment_approved', create_function('', 'return "spam";'));
            //$comment['comment_content'] = "[ 小墙判断这是 Spam! ]\n". $_POST['spam_confirmed'];
        }
        return $comment;
    }
}
$anti_spam = new anti_spam();
/* 垃圾评论拦截 end */


?>