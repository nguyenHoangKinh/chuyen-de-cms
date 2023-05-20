<style>/* Css Cua Phan 3 */
.content_my_box.thang {
  width: 575px;
  height: auto;
  display: flex;
  background: #fff;
}
.content_my_box_left.thang{
  float: left;
  width: 50%;
  height: 100%;
  padding: 10px;
  margin-left: 10px;
  margin-top: 10px;
  margin-bottom: 10px;
    
  
}
.content_my_box_right.thang{
  float: right;
  width: 50%;
  height: 100%;
  padding: 10px;
  margin-left: 10px;
  margin-top: 25px;
  
}
.header_content_box_child.thang{
  font-size: 1.3em;
  margin-top: 5px;
  margin-bottom: 0;
  
}
.header_text_content_box.thang{
  color: #000;
}
.center_content_box.thang{
  width: 95%;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 20px;
    -webkit-line-clamp: 3;
    display: -webkit-box;
    -webkit-box-orient: vertical;
}
.readmore_content_box.thang{
  margin-top: 15px;
}
.readmore_text.thang{
  font-weight: bold;
  color: red;
}
section.bg-st-edit.thang{
  margin-top: 0;
  margin-bottom: 0;
  padding-top: 50px;
  padding-bottom: 50px;
  
}
.article-section .bonus-edit.thang {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 30px;
  text-align: left;
  margin-top: 50px;
  margin-bottom: 40px;
}

/* Het Css cua phan 3 */</style>
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
    <section id="blog-section" class="article-section bg-st-edit thang" style="background: #f5f5f7;">
        <div class="container">
            <?php
            if ($blog_heading) echo '<h2 class="section-title">' . esc_html($blog_heading) . '</h2>';
            
            ?>

            <?php if ($qry->have_posts()) { ?>
                <div class="article-wrap bonus-edit thang">
                    <?php
                    while ($qry->have_posts()) {
                        $qry->the_post(); ?>
                        <div class="content_my_box thang" style="width: 575px; height: auto; display: flex; background: #fff;">
                            <div class="content_my_box_left thang">

                                <?php
                                if (has_post_thumbnail()) {
                                    echo get_the_post_thumbnail($post->ID, 'post-thumbnail', "class=img-fluid");
                                } else {
                                    jobscout_fallback_svg_image('jobscout-blog');
                                }
                                ?>
                            </div>
                            <div class="content_my_box_right thang">
                                <div class="header_content_box thang">
                                    <h4 class="header_content_box_child thang">
                                        <a href="<?php the_permalink(); ?>" class="header_text_content_box thang"><?php the_title(); ?></a>
                            </h4>
                                </div>
                                
                                <div class="center_content_box thang">
                                    <?php the_content()?>
                                </div>
                                <div class="readmore_content_box thang">
                                <a href="<?php the_permalink(); ?>" class="readmore_text thang">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div><!-- .article-wrap -->
            <?php } ?>
        </div>
    </section>
<?php
}