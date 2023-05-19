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

<?php
global $wpdb;
$table = $wpdb->prefix . 'postmeta';
$sql = "SELECT DISTINCT SUBSTRING_INDEX(`meta_value`, '.' , -1) as location FROM 'wp_postmeta' WHERE 'meta_key' like '%location%' ORDER BY location";
$data = $wpdb->get_results($wpdb->prepare($sql))
?>

<style>
  .bg-black {
    background: rgba(0, 0, 0, 0.8);
    opacity: 0.5;
    padding: 10px 50px;
  }

  .kiet-form {
    opacity: 1;
  }

  .input-group-text {
    background: white;
    border-radius: 0%;
  }

  .btn_kiet {
    background: orange;
  }
</style>

<div class="bg-black">
  <div class="kiet-form">
    <form method="GET">
      <div class="row">
        <div class="col-md-6">
          <div class="search_keywords">
            <label for="search_keywords"><?php esc_html_e('Search for job, companies, skill', 'jobscout'); ?></label>
            <i class="fa-thin fa-magnifying-glass"></i><input type="text" id="search_keywords" name="search_keywords" placeholder="<?php esc_attr_e('Search for job, companies, skill', 'jobscout'); ?>">
          </div>
        </div>


        <div class="col-md-4">
          <label for="search_location"><?php esc_html_e('Location', 'jobscout'); ?></label>
          <select name="search_location" id="search_location"></select>
          <option selected>
            <?php
            foreach ($data as $item) {
            ?>
          <option value="<?php echo $item->location ?>"><?php echo $item->location ?></option>
        <?php
            }
        ?>
        </option>
        </div>

        <div class="col-md-2">
          <label for="search_submit"></label>
          <div class="search_submit">
            <input type="submit" value="Search Job" />
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- <div class="job_listings">

  <form class="jobscout_job_filters" method="GET" action="<?php echo esc_url($action_page) ?>">
    <div class="search_jobs">

      <div class="search_keywords">
        <label for="search_keywords"><?php esc_html_e('Search for job, companies, skill', 'jobscout'); ?></label>
        <input type="text" id="search_keywords" name="search_keywords" placeholder="<?php esc_attr_e('Keywords', 'jobscout'); ?>">
      </div>

      <div class="search_location">
        <label for="search_location"><?php esc_html_e('Location', 'jobscout'); ?></label>
        <input type="text"  id="search_location" name="search_location" placeholder="<?php esc_attr_e('Location', 'jobscout'); ?>">
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
  </form>

</div> -->