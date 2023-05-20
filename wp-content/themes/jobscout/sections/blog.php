<?php

/**
 * Blog Section
 * 
 * @package JobScout
 */

$blog_heading = get_theme_mod('blog_section_title', __('NEWEST BLOG ENTRIES', 'jobscout'));
$sub_title    = get_theme_mod('blog_section_subtitle', __('We will help you find it. We are your first step to becoming everything you want to be.', 'jobscout'));
$blog         = get_option('page_for_posts');
$label        = get_theme_mod('blog_view_all', __('See More Posts', 'jobscout'));
$hide_author  = get_theme_mod('ed_post_author', false);
$hide_date    = get_theme_mod('ed_post_date', false);
$ed_blog      = get_theme_mod('ed_blog', true);

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 4,
    'ignore_sticky_posts' => true
);

$qry = new WP_Query($args);

if ($ed_blog && ($blog_heading || $sub_title || $qry->have_posts())) { ?>
    <section id="blog-section" class="article-section bg-st-edit_nghiem" style="background: #f5f5f7;">
        <div class="container">
            <?php
            if ($blog_heading) echo '<h2 class="section-title">' . esc_html($blog_heading) . '</h2>';

            ?>

            <?php if ($qry->have_posts()) { ?>
                <div class="article-wrap bonus-edit_nghiem">
                    <?php
                    while ($qry->have_posts()) {
                        $qry->the_post(); ?>
                        <div class="content_my_box_nghiem">
                            <div class="content_my_box_left_nghiem">

                                <?php
                                if (has_post_thumbnail()) {
                                    echo get_the_post_thumbnail($post->ID, 'post-thumbnail', "class=img-fluid edit_anh_nghiem");
                                } else {
                                    jobscout_fallback_svg_image('jobscout-blog');
                                }
                                ?>
                            </div>
                            <div class="content_my_box_right_nghiem">
                                <div class="header_content_box_nghiem">
                                    <h4 class="header_content_box_child_nghiem">
                                        <a href="<?php the_permalink(); ?>" class="header_text_content_box_nghiem"><?php the_title(); ?></a>
                            </h4>
                                </div>
                                <div class="center_content_box_nghiem">
                                    <?php the_content()?>
                                </div>
                                <div class="readmore_content_box_nghiem">
                                <a href="<?php the_permalink(); ?>" class="readmore_text_nghiem">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div><!-- .article-wrap -->
                <?php if( $blog && $label ){ ?>
                <div class="btn-wrap">
        			<a href="<?php the_permalink( $blog ); ?>" class="btn"><?php echo esc_html( $label ); ?></a>
        		</div>
            <?php } ?>
            <?php } ?>
        </div>
    </section>
<?php
}
