<?php get_header(); ?>

<div id="content">

    <div id="inner-content" class="wrap clearfix">

        <h1 class="archive-title h2"><?php post_type_archive_title(); ?></h1>

        <div id="main" class="twelvecol first clearfix" role="main">

            <?php
            $posts = get_posts(array(
                "posts_per_page" => -1,
                "post_type" => "project"
            ));

            foreach ($posts as $posts) {
                setup_postdata($post);

                echo has_post_thumbnail() ? "Ja" : "Nee";
            }
            wp_reset_postdata();
            ?>

        </div> <!-- end #main -->

    </div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
