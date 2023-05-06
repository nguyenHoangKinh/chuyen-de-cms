<?php

/**
 * The template file for displaying the comments and comment form for the
 * Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if (post_password_required()) {
	return;
}

if ($comments) {
?>

	<div class="comments" id="comments">
		<?php
		// this is comment number
		$comments_number = get_comments_number();
		?>

		<div class="comments-header section-inner small max-percentage">

			<h2 class="comment-reply-title">
				<?php
				if (!have_comments()) {

					_e('Leave a comment', 'twentytwenty');
				} elseif ('1' === $comments_number) {
					/* translators: %s: Post title. */
					printf(_x('One reply on &ldquo;%s&rdquo;', 'comments title', 'twentytwenty'), get_the_title());
				} else {
					// this is title comment
					printf(
						/* translators: 1: Number of comments, 2: Post title. */
						_nx(
							'%1$s reply on &ldquo;%2$s&rdquo;',
							'%1$s replies on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'twentytwenty'
						),
						number_format_i18n($comments_number),
						get_the_title()
					);
				}

				?>
			</h2><!-- .comments-title -->

		</div><!-- .comments-header -->

		<div class="comments-inner section-inner thin max-percentage">

			<?php
			wp_list_comments(
				array(
					'walker'      => new TwentyTwenty_Walker_Comment(),
					'avatar_size' => 120,
					'style'       => 'div',
				)
			);

			$comment_pagination = paginate_comments_links(
				array(
					'echo'      => false,
					'end_size'  => 0,
					'mid_size'  => 0,
					'next_text' => __('Newer Comments', 'twentytwenty') . ' <span aria-hidden="true">&rarr;</span>',
					'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __('Older Comments', 'twentytwenty'),
				)
			);

			if ($comment_pagination) {
				$pagination_classes = '';

				// If we're only showing the "Next" link, add a class indicating so.
				if (false === strpos($comment_pagination, 'prev page-numbers')) {
					$pagination_classes = ' only-next';
				}
			?>

				<nav class="comments-pagination pagination<?php echo $pagination_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output 
															?>" aria-label="<?php esc_attr_e('Comments', 'twentytwenty'); ?>">
					<?php echo wp_kses_post($comment_pagination); ?>
				</nav>

			<?php
			}
			?>

		</div><!-- .comments-inner -->

	</div><!-- comments -->

<?php
}

if (comments_open() || pings_open()) {

	if ($comments) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

	// comment_form(
	// 	array(
	// 		'class_form'         => 'section-inner thin max-percentage',
	// 		'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
	// 		'title_reply_after'  => '</h2>',
	// 	)
	// );
?>

	<!-- Start custom comment -->
	<form action="http://wordpress.local/wp-comments-post.php" method="post" id="commentform" novalidate="">
		<div class="container-fluid my-5">
			<div class="row">
				<div class="col-2">

				</div>
				<div class="col-8">

					<!--- Post Form Begins -->
					<section class="card">
						<div class="card-header">
							<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
										a Post</a>
								</li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
									<div class="form-group">
										<label class="sr-only" for="comment">Comment <span class="required">*</span></label>
										<textarea class="form-control" id="comment" name="comment" cols="45" rows="3" maxlength="65525" required="" placeholder="What are you thinking..."></textarea>
									</div>
									<div class="form-group">
										<label class="sr-only" for="author">Name</label>
										<input class="form-control" id="author" name="author" type="text" size="30" maxlength="245" autocomplete="name" required="" placeholder="Enter name">
									</div>
									<div class="form-group">
										<label class="sr-only" for="email">Email</label>
										<input class="form-control" id="email" name="email" type="email" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email" required="" placeholder="Enter email">
									</div>
									<div class="form-group">
										<label class="sr-only" for="name">Website</label>
										<input class="form-control" id="url" name="url" type="url" size="30" maxlength="200" autocomplete="url" placeholder="url of website">
									</div>

								</div>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">share</button>
								<input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID() ?>" id="comment_post_ID">
								<input type="hidden" name="comment_parent" id="comment_parent" value="0">
							</div>
						</div>
					</section>
					<!--- Post Form Ends -->


				</div>
				<div class="col-2">

				</div>
			</div>
		</div>
	</form>
	<!-- End custom comment -->
	<!-- Start link js of comment -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<!-- End link js of comment -->
<?php
} elseif (is_single()) {

	if ($comments) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

?>

	<div class="comment-respond" id="respond">

		<p class="comments-closed"><?php _e('Comments are closed.', 'twentytwenty'); ?></p>

	</div><!-- #respond -->

<?php
}
