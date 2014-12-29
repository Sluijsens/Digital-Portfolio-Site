<?php get_header(); ?>

<div id="content">

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
			<div id='highlighted_project'>
				<div id="highlighted_project_image">
					<div id="image_container">
						<?php
						if ( has_post_thumbnail() ) {
							$image_url = wp_get_attachment_url( get_post_thumbnail_id() );
						} else {
							$image_url = "";
						}
						?>
						<img src="<?php echo $image_url; ?>"/>
					</div>
				</div>

				<div id="highlighted_project_info">
					<h1><?php the_title(); ?></h1>

					<p>
						<?php the_content(); ?>
					</p>

					<div id="project-tags">
						<?php
						$terms = wp_get_post_terms( get_the_ID(), 'project-category' );

						foreach ( $terms as $term ) {
							echo "<a class='project_tag single-project-tag' href='" . get_term_link( $term ) . "'>{$term->name}</a>";
						}

						?>
					</div>

					<div id='project-images-gallery'>
						<div class='gallery-content'>
							<div class='img-container'>
								<?php

								$image_src_array = get_images_src('thumbnail');

								foreach( $image_src_array as $image_src ) {
									echo "<img src='$image_src[0]' />";
								}
								?>

							</div>
						</div>

						<div class='gallery-nav'>
							<a class='nav-prev'>
								&lt;
							</a>
							<a class='nav-next'>
								&gt;
							</a>
						</div>
					</div>
				</div>

				<!--				<div id="bg-overlay">-->
				<!--				</div>-->
			</div>
		<?php } // End while loop  ?>

	<?php } else { ?>

		No project was found.

	<?php } // End if  ?>

</div> <!-- end #content -->

<?php get_footer(); ?>
