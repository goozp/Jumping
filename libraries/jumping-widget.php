<?php
/**
 * 新增主题专属侧边栏组件
 * @name Jumping-widget
 * @description Theme basic functions
 * @version     1.0.0
 * @author      锅子 (http://www.gzpblog.com)
 * @package     Jumping
 **/

/**
 * 热门文章
 */
class Jumping_widget_populars extends WP_Widget {
    function Jumping_widget_populars() {
        $widget_ops = array( 'description' => 'Jumping：热门文章（需要WP-PostViews插件）' );
        $this->WP_Widget( 'Jumping_widget_populars', 'Jumping：热门文章', $widget_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $limit = strip_tags( $instance['limit'] );
        $limit = $limit ? $limit : 10;
        ?>
        <div class="widget widget-populars">
            <h4><i class="glyphicon glyphicon-fire"></i>&nbsp;<?php _e( 'Popular posts', JUMPING_NAME ); ?></h4>
            <ul class="list fa-ul">
                <?php
                $args  = array(
                    'paged'               => 1,
                    'meta_key'            => 'views',
                    'orderby'             => 'meta_value_num',
                    'ignore_sticky_posts' => 1,
                    'post_type'           => 'post',
                    'post_status'         => 'publish',
                    'showposts'           => $limit
                );
                $posts = query_posts( $args ); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <li class="widget-popular"><i class="fa-li fa fa-angle-double-right"></i>
                        <p>
                            <a href="<?php the_permalink() ?>" rel="bookmark"
                               title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            <?php if ( function_exists( 'the_views' ) ) { ?>
                                <span><?php echo jumping_views_count(); ?></span>
                            <?php } ?>
                        </p>
                    </li>
                <?php endwhile;
                wp_reset_query();
                $posts = null;
                ?>
            </ul>
        </div>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        if ( ! isset( $new_instance['submit'] ) ) {
            return false;
        }
        $instance          = $old_instance;
        $instance['limit'] = strip_tags( $new_instance['limit'] );

        return $instance;
    }

    function form( $instance ) {
        global $wpdb;
        $instance = wp_parse_args( (array) $instance, array( 'limit' => '' ) );
        $limit    = strip_tags( $instance['limit'] );
        ?>

        <p><label for="<?php echo $this->get_field_id( 'limit' ); ?>">文章数量：<input
                    id="<?php echo $this->get_field_id( 'limit' ); ?>"
                    name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text"
                    value="<?php echo $limit; ?>"/></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id( 'submit' ); ?>"
               name="<?php echo $this->get_field_name( 'submit' ); ?>" value="1"/>
        <?php
    }
}

register_widget( 'Jumping_widget_populars' );


/**
 * 最新文章
 */
class Jumping_widget_new extends WP_Widget
{
    function Jumping_widget_new()
    {
        $widget_ops = array('description' => 'Jumping：最新文章');
        $this->WP_Widget('Jumping_widget_new', 'Jumping：最新文章', $widget_ops);
    }

    function widget($args, $instance)
    {
        extract($args);
        $limit = strip_tags($instance['limit']);
        $limit = $limit ? $limit : 10;
        ?>
        <div class="widget widget-news">
        <h4><i class="fa fa-leaf"></i>&nbsp;<?php _e('New posts', JUMPING_NAME); ?></h4>
        <ul class="list fa-ul">
            <?php
            $args = array(
                'orderby' => 'post_date',
                'post_type' => 'post',
                'numberposts' => $limit
            );
            $posts = get_posts($args); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <li class="widget-new"><i class="fa-li fa fa-angle-double-right"></i>
                        <p>
                            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        </p>
                    </li>
                <?php endwhile;
            $posts =null;
            ?>
        </ul>
        </div>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }

    function form($instance)
    {
        global $wpdb;
        $instance = wp_parse_args((array)$instance, array('limit' => ''));
        $limit = strip_tags($instance['limit']);
        ?>
        <p><label for="<?php echo $this->get_field_id('limit'); ?>">文章数量：<input
                    id="<?php echo $this->get_field_id('limit'); ?>"
                    name="<?php echo $this->get_field_name('limit'); ?>" type="text"
                    value="<?php echo $limit; ?>"/></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>"
               name="<?php echo $this->get_field_name('submit'); ?>" value="1"/>
        <?php
    }
}
register_widget('Jumping_widget_new');


/**
 * 标签
 */
class Jumping_widget_label extends WP_Widget
{
    function Jumping_widget_label()
    {
        $widget_ops = array('description' => 'Jumping：标签云');
        $this->WP_Widget('Jumping_widget_label', 'Jumping：标签云', $widget_ops);
    }

    function widget($args, $instance)
    {
        extract($args);
        $smallest = strip_tags($instance['smallest']);
        $largest = strip_tags($instance['largest']);
        $smallest = $smallest ? $smallest : 8;
        $largest = $largest ? $largest : 22;
        ?>
        <div class="widget widget-label">
            <h4><i class="fa fa-tags"></i>&nbsp;<?php _e( 'Yun tags', JUMPING_NAME ); ?></h4>
            <p><?php wp_tag_cloud("smallest={$smallest}&largest={$largest}"); ?></p>
        </div>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['smallest'] = strip_tags($new_instance['smallest']);
        $instance['largest'] = strip_tags($new_instance['largest']);
        return $instance;
    }

    function form($instance)
    {
        global $wpdb;
        $instance = wp_parse_args((array)$instance, array('smallest' => '', 'largest' => ''));
        $smallest = strip_tags($instance['smallest']);
        $largest = strip_tags($instance['largest']);
        ?>
        <p><label for="<?php echo $this->get_field_id('smallest'); ?>">最小字体：<input
                    id="<?php echo $this->get_field_id('smallest'); ?>"
                    name="<?php echo $this->get_field_name('smallest'); ?>" type="text"
                    value="<?php echo $smallest; ?>"/></label></p>
        <p><label for="<?php echo $this->get_field_id('largest'); ?>">最大字体：<input
                    id="<?php echo $this->get_field_id('largest'); ?>"
                    name="<?php echo $this->get_field_name('largest'); ?>" type="text"
                    value="<?php echo $largest; ?>"/></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>"
               name="<?php echo $this->get_field_name('submit'); ?>" value="1"/>
        <?php
    }
}
register_widget('Jumping_widget_label');


/**
 * 最新评论
 */
class Jumping_widget_comment extends WP_Widget{
    function Jumping_widget_comment()
    {
        $widget_ops = array('description' => 'Jumping：最新评论');
        $this->WP_Widget('Jumping_widget_comment', 'Jumping：最新评论', $widget_ops);
    }

    function jumping_get_comments($num){
        $comments = get_comments( "user_id=0&status=approve&number={$num}" );
        $output = "";
        foreach ($comments as $comment) {
            $output .= "<li>
                        <div class='gavatar'>".get_avatar( $comment, 43,'',$comment->comment_author, array('class' => 'img-circle'))."</div>
                        <div class='comments-con'>
                            <p><a class='comments-name' href='".get_permalink($comment->ID)."#comment-" . $comment->comment_ID . "'>".strip_tags($comment->comment_author)."</a>：</p>
                            <p><a class='comments-comment' href='".get_permalink($comment->comment_post_ID )."#comment-".$comment->comment_ID."'>" .jummping_deal_comments(strip_tags($comment->comment_content)) ."</a></p>
                        </div>
                    </li>";
        }
        $output = convert_smilies($output);
        echo $output;
    }

    function widget($args, $instance)
    {
        extract($args);
        $limit = strip_tags($instance['limit']);
        $limit = $limit ? $limit : 5;
        ?>
        <div class="widget widget-comments">
            <h4><i class="fa fa-comments"></i>&nbsp;<?php _e( 'Latest comments', JUMPING_NAME ); ?></h4>
            <ul>
                <?php $this->jumping_get_comments($limit);?>
            </ul>
        </div>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }

    function form($instance)
    {
        global $wpdb;
        $instance = wp_parse_args((array)$instance, array('limit' => '5'));
        $limit = strip_tags($instance['limit']);
        ?>
        <p><label for="<?php echo $this->get_field_id('limit'); ?>">显示条数：<input
                    id="<?php echo $this->get_field_id('limit'); ?>"
                    name="<?php echo $this->get_field_name('limit'); ?>" type="text"
                    value="<?php echo $limit; ?>"/></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>"
               name="<?php echo $this->get_field_name('submit'); ?>" value="1"/>
        <?php
    }
}
register_widget('Jumping_widget_comment');




/**
 * 归档
 */
class Jumping_widget_archive extends WP_widget{
    function Jumping_widget_archive()
    {
        $widget_ops = array('description' => 'Jumping：归档');
        $this->WP_Widget('Jumping_widget_archive', 'Jumping：归档', $widget_ops);
    }

    function widget($args, $instance)
    {
        extract($args);
        $showType = strip_tags($instance['showType']);
        $showNum = strip_tags($instance['showNum']);
        $limit = strip_tags($instance['limit']);
        $showNum = $showNum ? $showNum : 1;
        $showType = $showType ? $showType : 'monthly';
        $limit = $limit ? $limit : '';
        ?>
        <div class="widget widget-archive">
            <h4><i class="fa fa-archive"></i>&nbsp;<?php _e( 'Archive list', JUMPING_NAME ); ?></h4>
            <ul>
                <?php if ($limit){
                    $args = array(
                        'type'          => $showType,
                        'limit'         => $limit,
                        'before'        => '<button class="btn btn-default" type="button">',
                        'after'         => '<span class="badge">4</span></button>',
                        'show_post_count' => $showNum,
                    );
                    wp_get_archives($args);
                }else{
                    $args = array(
                        'type'          => $showType,
                        'before'        => '<button class="btn btn-default btn-sm" type="button">',
                        'after'         => '</button>',
                        'show_post_count' => $showNum,
                    );
                    wp_get_archives($args);
                }  ?>
            </ul>
        </div>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['showType'] = strip_tags($new_instance['showType']);
        $instance['showNum'] = strip_tags($new_instance['showNum']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }

    function form($instance)
    {
        global $wpdb;
        $instance = wp_parse_args((array)$instance, array('showType' => 'monthly', 'limit' => ''));
        $showType = strip_tags($instance['showType']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('showType'); ?>">显示类型：
                <select id="<?php echo $this->get_field_id('showType'); ?>"
                        name="<?php echo $this->get_field_name('showType'); ?>">
                    <option value="yearly" <?php if ($showType == 'yearly') echo "selected"; ?> >年</option>
                    <option value="monthly" <?php if ($showType == 'monthly') echo "selected"; ?>>月</option>
                    <option value="weekly" <?php if ($showType == 'weekly') echo "selected"; ?>>周</option>
                    <option value="daily" <?php if ($showType == 'daily') echo "selected"; ?>>日</option>
                </select>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('showNum'); ?>">是否显示文章数量：
                <select  id="<?php echo $this->get_field_id('showNum'); ?>"
                         name="<?php echo $this->get_field_name('showNum'); ?>">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示条数：<input
                    id="<?php echo $this->get_field_id('limit'); ?>"
                    name="<?php echo $this->get_field_name('limit'); ?>" type="text"
                    value="<?php echo $limit; ?>"/>
            </label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>"
               name="<?php echo $this->get_field_name('submit'); ?>" value="1"/>
        <?php
    }
}
register_widget('Jumping_widget_archive');

