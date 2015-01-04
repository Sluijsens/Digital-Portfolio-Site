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
<!--					<a id="enlarge-gallery" href="">Afbeeldingen</a>-->
					<div id='project-images-gallery'>
						<div class='gallery-content'>
							<div class='img-container'>
								<?php

								$image_src_array = get_images_src('project-thumb');

								foreach( $image_src_array as $image_src ) {
									echo "<img src='$image_src[0]' />";
								}
								?>

							</div>
						</div>

						<div class='gallery-nav'>
							<div class='nav-prev'></div>
							<div class='nav-next'></div>
						</div>
					</div>

					<script type="text/javascript">

						jQuery(document).ready(function($) {

							$("#enlarge-gallery").click(function(e) {
								e.preventDefault();
								var gallery = $("#project-images-gallery");
								var enlarged_gallery = $("#enlarged-gallery");


								enlarged_gallery.html(gallery.html())
								gallery.remove();
							});

							var interval;
							var speed = 10;
							var start_left = 0;

							var img_container = $( ".img-container", ".gallery-content");
							var img_container_width = 0;

							$(window).load(function() {
								$('img', img_container).each(function () {

									var img = $(this);
									img.height(img.width());

									console.log("img width: " + img.width());

									img_container_width += img.width() + parseInt(img.css('margin-right').replace('px', ''));


								});
							});

							$(".nav-prev, .nav-next", ".gallery-nav").on( 'mouseover', function() {

								var nav_element = $(this);
								var gallery_content = img_container.parent();

								var min_left = start_left - img_container_width + gallery_content.width();
								console.log("Min Left: " + min_left);

								interval = setInterval(function() {
									var cur_left = parseInt(img_container.css('left').replace('px',''));
									var left = cur_left;
									if(nav_element.hasClass('nav-prev')) {

										if(((cur_left + speed) >= start_left)) {
											left = start_left;
										} else {
											left += speed;
										}

									} else if(nav_element.hasClass('nav-next')) {

										if(((cur_left - speed) <= min_left)) {
											left = min_left;
										} else {
											left -= speed;
										}
									}

									console.log("Left: " + left);
									img_container.css( 'left', left + 'px' );
								}, 100);
							}).on('mouseout', function() {
								clearInterval(interval);
							});

						});

					</script>

				</div>

				<!--				<div id="bg-overlay">-->
				<!--				</div>-->
			</div>
		<?php } // End while loop  ?>

	<?php } else { ?>

		No project was found.

	<?php } // End if  ?>

</div> <!-- end #content -->

<div id="enlarged-gallery" syle="position: absolute; background: rgba(255, 255, 255, 0.85); top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
	lkm;l;
</div>

<?php get_footer(); ?>
