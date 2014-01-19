<?php get_header(); ?>
<div id="bg-overlay">
</div>
<div id="content">

    <div id="inner-content" class="wrap clearfix">

        <div id="main" class="twelvecol first clearfix" role="main">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <div id="highlighted_project_image" class="sixcol first">
                        <div id="image_container">
                            <a href="">
                                <?php
                                if (has_post_thumbnail()) {
                                    $image_url = wp_get_attachment_url(get_post_thumbnail_id());
                                } else {
                                    $image_url = "";
                                }
                                ?>
                                <img style="max-height: 300px" src="<?php echo $image_url; ?>" />
                            </a>
                        </div>
                    </div>

                    <div id="highlighted_project_info" class="sixcol last">

                    </div>

                <?php endwhile; ?>

            <?php else : ?>

                No project was found.

            <?php endif; ?>

        </div> <!-- end #main -->

    </div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
