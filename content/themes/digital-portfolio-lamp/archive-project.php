<?php get_header(); ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {

        var resizeContent = function() {
            var main_menu_height = $("#menu-main-menu").height() + parseInt($("#menu-main-menu").css("margin-top").replace("px", ""));
            var window_height = $(window).height() - main_menu_height;

            $("#content").height(window_height);
        }

        $(window).resize(function() {
            resizeContent();
            $("#content").mCustomScrollbar("update");
        });

        $(window).load(function() {
            resizeContent();
            $("#project_filter").css({
                "top": $("#main.projects .row").css("margin-top")
            });
            
            $("#content").mCustomScrollbar({
                theme: "light",
                callbacks: {
                    whileScrolling: function() {
                        var top_offset_inner_content = $("#inner-content").offset().top;
                        var top_offset_page_title = 0 - top_offset_inner_content;
                        
                        // Keep the page title on the same place
                        $("#page-title.projects").css({
                            "top": top_offset_page_title + "px"
                        });
                        
                        // Keep the filter on the same place
                        var row_margin = parseInt($("#main.projects .row").css("margin-top").replace("px", ""));
                        $("#project_filter").css({
                            "top": (row_margin + (-top_offset_inner_content)) + "px"
                        });
                    }
                }
            });
        }); //End window load

    }); // End document ready
</script>

<div id="content">

    <div id="inner-content" class="projects wrap clearfix">

        <div id="page-title" class="projects threecol first">
            <h2 class="archive-title h2"><?php post_type_archive_title(); ?></h2>
        </div>

        <div id="main" class="projects sixcol" role="main">

            <?php
            // Filter
            $get_filter_categories = $_GET['filter-categories'];

            $tax_query = array();
            if( ! empty( $get_filter_categories ) && $get_filter_categories != '' ) {
                $filter_categories = explode( ',', $get_filter_categories );

                $tax_query = array(
                    array(
                        'taxonomy' => 'project-category',
                        'field'    => 'slug',
                        'terms'    => $filter_categories,
                        'operator' => 'AND'
                    ),
                );
            } else {
                $filter_categories = array();
            }

            $posts = get_posts(array(
                "posts_per_page" => -1,
                "post_type" => "project",
                "tax_query" => $tax_query
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
                    <a class="project fourcol <?php echo $first_last; ?>" href="<?php the_permalink(); ?>">
                        <img src="<?php echo $image_url; ?>" />
                        <span><?php the_title(); ?></span>
                    </a>
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

        <div id="project_filter" class="threecol last">

            <?php
            $terms = get_terms('project-category');

            foreach($terms as $term) {

                $active_tag = '';
                $tmp_link_array = $filter_categories;
                $link = home_url( 'projects' ) . "?filter-categories=";

                if( in_array( $term->slug, $filter_categories ) ) {
                    $active_tag = 'active_tag';
                    if(($key = array_search($term->slug, $tmp_link_array)) !== false) {
                        unset($tmp_link_array[$key]);
                    }

                    if( ! empty( $tmp_link_array ) ) {
                        $link .=  implode( ',', $tmp_link_array );
                    }
                } else {
                    if( ! empty( $filter_categories ) ) {
                        $link .= implode( ',', $filter_categories ) . ",{$term->slug}";
                    } else {
                        $link .= $term->slug;
                    }
                }

                echo "<span><a href='$link' class='project_tag tag_{$term->slug} $active_tag'>{$term->name}</a></span>";
            }
            ?>
        </div>

    </div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
