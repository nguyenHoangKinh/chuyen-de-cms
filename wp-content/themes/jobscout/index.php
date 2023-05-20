<style>/*Start Css module 5 */
section[class*="-section"] .widget_text .widget-title,
.section-title.bao,
.client-section .widget .widget-title {
  font-size: 1.3em;
  margin-top: -20px;
  margin-bottom: -20px;
  font-weight: 800;
  line-height: 1.5;
  text-align: center;
}

.content_my_box.bao {
  width: 365px;
  height: auto;
  display: flex;
  background: #fff;
  margin-bottom: 8px;
}

.header_content_box_child.bao {
  font-size: 0.8em;
  margin-top: 5px;
  margin-bottom: 0;
}

.article-section .bonus-edit.bao {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 15px;
  text-align: left;
  margin: 40px 70px;
}

.content_my_box_left.bao {
  float: left;
  width: 40%;
  height: 100%;
  padding: 10px;
}

.content_my_box_right.bao {
  float: right;
  width: 60%;
  height: 100%;
  padding: 10px;
  
}

.center_content_box.bao {
  width: 95%;
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 20px;
  -webkit-line-clamp: 3;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  font-size: 0.7em;
  font-style: normal;
  color: #000000;
  font-weight: 0.5em;
}

.readmore_content_box.bao {
  margin-top: 10px;
  font-size: 0.7em;
}

.img-bao {
  height: auto;
  /* Make sure images are scaled correctly. */
 
  /* width: 100%; */
  /* Adhere to container width. */
  vertical-align: top;
  background-size: auto;
}

.readmore_text.bao {
  font-weight: bold;
  color: orange;
}

section.bg-st-edit.bao {
  margin-top: 0;
  margin-bottom: 0;
  padding-top: 50px;
  padding-bottom: 50px;

}

.header_text_content_box.bao{
  color: #000;
}
.content_my_box_left.bao{
  width: 170px;
  height: 170px;
  margin-left: 5px;
  margin-top: 5px;
  margin-bottom: 5px;
}

.content_my_box_left.bao img{
  width: 100%;
  height: 100%;
}


/* End Css module 5 */</style>
<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout
 */

get_header(); ?>

<!-- Start Module 5 -->
<?php
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
	'posts_per_page'      => 8,
	'ignore_sticky_posts' => true
);
$qry = new WP_Query($args);
?>

<div id="primary" class="content-area">

	<?php if ($ed_blog && ($blog_heading || $sub_title || $qry->have_posts())) { ?>
		<section id="blog-section" class="article-section bg-st-edit bao" style="background: #f5f5f7;">
			<div class="container">
				<?php if ($blog_heading) echo '<h2 class="section-title bao">' . esc_html($blog_heading) . '</h2>'; ?>
				<?php if ($qry->have_posts()) { ?>
					<div class="article-wrap bonus-edit bao">
						<?php
						while ($qry->have_posts()) {
							$qry->the_post(); ?>
							<div class="content_my_box bao">
								<div class="content_my_box_left bao">
								<?php
                                if (has_post_thumbnail()) {
                                    echo get_the_post_thumbnail($post->ID, 'post-thumbnail', "class=img-fluid img-bao");
                                } else {
                                    jobscout_fallback_svg_image('jobscout-blog');
                                }
                                ?>
								</div>

								<div class="content_my_box_right bao">
								<div class="header_content_box bao">
                                    <h4 class="header_content_box_child bao">
                                        <a href="<?php the_permalink(); ?>" class="header_text_content_box bao"><?php the_title(); ?></a>
                            </h4>
                                </div>
                                <div class="center_content_box bao">
                                    <?php the_content()?>
                                </div>
                                <div class="readmore_content_box bao">
                                <a href="<?php the_permalink(); ?>" class="readmore_text bao">Read more</a>
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
	<?php } ?>
</div><!-- #primary -->
<!-- End Module 5 -->


<?php
get_sidebar();
get_footer();