
<?php

/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.27.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $post;
$job_salary   = get_post_meta(get_the_ID(), '_job_salary', true);
$job_featured = get_post_meta(get_the_ID(), '_featured', true);
$company_name = get_post_meta(get_the_ID(), '_company_name', true);

?>
<div class="col-6">
	<article <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr($post->geolocation_lat); ?>" data-latitude="<?php echo esc_attr($post->geolocation_long); ?>">

		<figure class="company-logo">
			<?php the_company_logo('thumbnail'); ?>
		</figure>

		<div class="job-title-wrapper">
			<h2 class="entry-title-company">
				<a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a>
			</h2>

			<span class="date-post"><?php echo "Create: " . get_the_date('M j, Y'); ?></span>

			<div class="row bg">
				<div class="company1">
					<?php
					if (get_option('job_manager_enable_types')) {
						$types = wpjm_get_the_job_types();
						if (!empty($types)) : foreach ($types as $jobtype) : ?>
								<li class="job-type-company <?php echo esc_attr(sanitize_title($jobtype->slug)); ?>"><?php echo esc_html($jobtype->name); ?></li>
					<?php endforeach;
						endif;
					}
					do_action('job_listing_meta_end');
					?>
				</div>

				<div class="company2">
					<?php the_company_name('<strong>', '</strong> '); ?>
				</div>

				<div class="company-location">
					<?php the_job_location(true); ?>
				</div>
			</div>
		</div>

		<div class="job-description-content">
			<?php echo wp_trim_words(get_the_content(), 25, ''); ?>
			<a href="<?php echo get_permalink() ?>">[...]</a>
		</div>

		<?php if ($job_featured) { ?>
			<div class="featured-label"><?php esc_html_e('Featured', 'jobscout'); ?></div>
		<?php } ?>

	</article>
</div>