<?php
/*
Template Name: Archive 归档页面
*/
/* Archives list */
function zww_archives_list() {
	if( !$output = get_option('zww_db_cache_archives_list') ){
		$output = '<div id="archives">';
		$args = array(
			'post_type' => 'post', //如果你有多个 post type，可以这样 array('post', 'product', 'news')
			'posts_per_page' => -1, //全部 posts
			'ignore_sticky_posts' => 1 //忽略 sticky posts

		);
		$the_query = new WP_Query( $args );
		$posts_rebuild = array();
		$year = $mon = 0;
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$post_year = get_the_time('Y');
			$post_mon = get_the_time('m');
			$post_day = get_the_time('d');
			if ($year != $post_year) $year = $post_year;
			if ($mon != $post_mon) $mon = $post_mon;
			$posts_rebuild[$year][$mon][] = '<li class="list-group-item">'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <span class="badge">'. get_comments_number('0', '1', '%') .'</span></li>';
		endwhile;
		wp_reset_postdata();

		foreach ($posts_rebuild as $key_y => $y) {
			$output .= '<h3 class="al_year">'. $key_y .' 年</h3><ul class="al_mon_list nav nav-pills nav-stacked">'; //输出年份
			foreach ($y as $key_m => $m) {
				$posts = ''; $i = 0;
				foreach ($m as $p) {
					++$i;
					$posts .= $p;
				}
				$output .= '<li><span class="al_mon">'. $key_m .' 月 <em> ( '. $i .' 篇文章 )</em></span><ul class="al_post_list list-group">'; //输出月份
				$output .= $posts; //输出 posts
				$output .= '</ul></li>';
			}
			$output .= '</ul>';
		}

		$output .= '</div>';
		update_option('zww_db_cache_archives_list', $output);
	}
	echo $output;
}


get_header(); ?>
	<div class="container">
		<div class="col-xs-12 col-sm-9">
			<div class="row">
				<div class="col-xs-12 col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>归档（注：点击月份可以展开）<span><a class="btn btn-primary " id="al_expand_collapse" href="#">全部展开/收缩</a> <em></em></span></h4>
							<p></p>
						</div>
						<div class="panel-body">
							<?php zww_archives_list(); ?>
						</div>
					</div>

				</div>
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