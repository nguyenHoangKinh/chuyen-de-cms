<?php

/**
 *
 * Creating a custom job search form for homepage
 * The [jobs] shortcode is will use search_location and search_keywords variables from the query string.
 *
 * @link https://wpjobmanager.com/document/tutorial-creating-custom-job-search-form/
 *
 * @package JobScout
 */

$find_a_job_link = get_option('job_manager_jobs_page_id', 0);
$post_slug       = get_post_field('post_name', $find_a_job_link);
$ed_job_category = get_option('job_manager_enable_categories');

if ($post_slug) {
  $action_page =  home_url('/' . $post_slug);
} else {
  $action_page =  home_url('/');
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="job_listings">


  <?php
  global $wpdb;
  $table = $wpdb->prefix . 'postmeta';
  $sql = "SELECT DISTINCT SUBSTRING_INDEX(`meta_value`, '.' ,-1) as location FROM `wp_postmeta` WHERE `meta_key` like '%location%' ORDER BY location";
  $data = $wpdb->get_results($wpdb->prepare($sql));
  ?>


  <div class="bg-black">
    <form action="<?php echo esc_url($action_page) ?>" method="GET" class="padding">
      <div class="row">
        <div class="col-md-6">
          <div class="input-group mb-3 minh">
            <span class="input-group-text minh" id="basic-addon1">
              <i class="fa fa-search color-ogrange" aria-hidden="true"></i>
            </span>
            <input type="text" id="search_keywords" name="search_keywords" class="form-control minh" placeholder="Search for jobs, companies, skills" aria-label="Username" aria-describedby="basic-addon1">
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group mb-3 minh">
            <label class="input-group-text bg-white minh" for="inputGroupSelect02">
              <i class="fa fa-map-marker color-ogrange" aria-hidden="true"></i>
            </label>
            <select class="form-select minh" id="inputGroupSelect02" id="search_location" name="search_location">
              <option selected></option>
              <?php
              foreach ($data as $item) {
              ?>
                <option value="<?php echo $item->location ?>"><?php echo $item->location ?></option>
              <?php
              }
              ?>

            </select>
          </div>
        </div>
        <div class="col-md-3 padding-none">
          <input type="submit" value="Search job" class="form-control btn btn-ogrange minh">
        </div>
      </div>
    </form>
  </div>
  <!-- <form class="jobscout_job_filters" method="GET" action="<?php echo esc_url($action_page) ?>">
    <div class="search_jobs">

      <div class="search_keywords">
        <label for="search_keywords"><?php esc_html_e('Keywords', 'jobscout'); ?></label>
        <input type="text" id="search_keywords" name="search_keywords" placeholder="<?php esc_attr_e('Keywords', 'jobscout'); ?>">
      </div>

      <div class="search_location">
        <label for="search_location"><?php esc_html_e('Location', 'jobscout'); ?></label>
        <input type="text" id="search_location" name="search_location" placeholder="<?php esc_attr_e('Location', 'jobscout'); ?>">
      </div>

      <?php if ($ed_job_category) { ?>
        <div class="search_categories custom_search_categories">
          <label for="search_category"><?php esc_html_e('Job Category', 'jobscout'); ?></label>
          <select id="search_category" class="robo-search-category" name="search_category">
            <option value=""><?php _e('Select Job Category', 'jobscout'); ?></option>
            <?php foreach (get_job_listing_categories() as $jobcat) : ?>
              <option value="<?php echo esc_attr($jobcat->term_id); ?>"><?php echo esc_html($jobcat->name); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      <?php } ?>

      <div class="search_submit">
        <input type="submit" value="<?php esc_attr_e('Search', 'jobscout'); ?>" />
      </div>

    </div>
  </form> -->

</div>