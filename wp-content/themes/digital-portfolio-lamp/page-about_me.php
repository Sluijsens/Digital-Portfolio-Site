<?php
/*
  Template Name: About Me
 */
?>

<?php get_header(); ?>
<script type="text/javascript">
    (function($){
        $(window).load(function(){
            $("#about-me-content").mCustomScrollbar();
            
        });
    })(jQuery);
</script>
<div id="content">

    <div id="inner-content" class="wrap clearfix">

        <div id="main" class="about-me wrap clearfix" role="main">
            
            <img id="about-me-img" src="<?php echo get_template_directory_uri() . "/library/images/about-me-img.png"; ?>" />
            <div id="about-me-content">
                <?php if(have_posts()) {
                    the_post();
                    
                    ?>
                    <h3><?php the_title(); ?></h3>
                <?php the_content(); ?>
                    <?php
                } ?>
                
            </div>
            
        </div> <!-- end #main -->

    </div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
