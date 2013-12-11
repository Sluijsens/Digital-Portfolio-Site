<?php get_header(); ?>

<div id="content">

    <div id="inner-content" class="projects wrap clearfix">

        <div id="page-title" class="projects threecol first">
            <h2 class="archive-title h2"><?php post_type_archive_title(); ?></h2>
        </div>

        <div id="main" class="projects sixcol" role="main">

            <?php
            $posts = get_posts(array(
                "posts_per_page" => -1,
                "post_type" => "project"
            ));

            $i = 0;
            foreach ($posts as $post) {
                setup_postdata($post);

                if (has_post_thumbnail()) {
                    $image_url = wp_get_attachment_url(get_post_thumbnail_id());
                } else {
                    $image_url = "";
                }
                
                $first_last = "";
                if ($i == 0) {
                    $first_last = "first";
                    ?>
                    <div class="row">
                        <?php
                    } else if ($i == 2) {
                        $first_last = "last";
                    }
                    ?>
                    <div class="project fourcol <?php echo $first_last; ?>">
                        <img src="<?php echo $image_url; ?>" />
                        <span><?php the_title(); ?></span>
                    </div>
                    <?php
                    if ($i == 2 || $post == end($posts)) {
                        ?>
                    </div>
                    <?php
                    $i = -1;
                }
                $i++;
            }
            wp_reset_postdata();
            ?>

        </div> <!-- end #main -->

        <div class="threecol last">
        </div>

    </div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
