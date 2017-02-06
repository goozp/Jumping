<?php get_header(); ?>

<div>
    <div>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>

        <?php endwhile; else: ?>
            <p><?php _e('对不起,页面不存在  '); ?></p>
        <?php endif; ?>

    </div>
    <div>
        <?php get_sidebar(); ?>
    </div>
</div>


<?php get_footer(); ?>
