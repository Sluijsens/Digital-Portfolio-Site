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
						<img src="<?php echo $image_url; ?>" />
					</div>
				</div>

				<div id="highlighted_project_info">
					<h1><?php the_title(); ?></h1>
					<p>
						<?php the_content(); ?>
					</p>

					<div id='related-projects-gallery'>
						<div class='gallery-nav'>
							<a class='nav-prev'>
								<
							</a>
							<a class='nav-next'>
								>
							</a>

							<div class='gallery-content'>
								<div class='img-container'>

								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div id="bg-overlay">
				</div>
			</div>
		<?php } // End while loop  ?>

	<?php } else { ?>

		No project was found.

	<?php } // End if  ?>

</div> <!-- end #content -->

<?php get_footer(); ?>
