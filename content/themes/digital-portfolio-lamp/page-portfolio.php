<?php
/*
  Template Name: Portfolio Page
 */
?>

<?php get_header(); ?>

<div id="content">

    <div id="inner-content" class="wrap clearfix">

        <div id="main" class="eightcol first clearfix" role="main">

            <?php
            $posts = get_posts(array(
                "posts_per_page" => -1
            ));
            
            foreach ($posts as $posts) {
                setup_postdata($post);
                
//                echo has_post_thumbnail() ? "Ja" : "Nee";
            }
            wp_reset_postdata();
            ?>

        </div> <!-- end #main -->

    </div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
