/*
 Bones Scripts File
 Author: Eddie Machado
 
 This file should contain any js scripts you want to add to the site.
 Instead of calling it in the header or throwing it inside wp_head()
 this file will be called automatically in the footer so as not to
 slow the page load.
 
 */

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
    window.getComputedStyle = function(el, pseudo) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop == 'float')
                prop = 'styleFloat';
            if (re.test(prop)) {
                prop = prop.replace(re, function() {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        }
        return this;
    }
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

    /* Declare functions */
    var project_width = 0;
    var margin_left = $(".project").css("margin-left");
    var margin_right = $(".project").css("margin-right");
    var margin_bottom = $(".project").css("margin-bottom");
    var margin_top = $(".project").css("margin-top");
    var setSizeProjectsOnOverview = function() {
        if ($(".project").size() > 0) {
            var project = $(".project");
            
            project_width = project.width() - 5;
            
            project.height(project_width);

            $("img", project).height(project_width);
        }
    }
    
    // Enlarge project details on mouse enter and make them smaller on mous eleave
    var toggleSizeProjectsOnOverview = function(el, enlarge) {
        
        if(enlarge) {
            var enlarged_width = (project_width * 1.5);
            var min_margin_top = 15;
            var new_offset_top = $(el).parent().offset().top;
            console.log(new_offset_top);
            el.width(enlarged_width);
            el.height(enlarged_width);

            $("img", el).height(enlarged_width);
            
            margin_left = parseInt(el.css("margin-left").replace("px", ""));
            margin_right = parseInt(el.css("margin-right").replace("px", ""));
            margin_bottom = parseInt(el.css("margin-bottom").replace("px", ""));
            margin_top = parseInt(el.css("margin-top").replace("px", ""));
            
            var new_margin_left = margin_left - ((enlarged_width - project_width) / 2);
            var new_margin_right = margin_right - ((enlarged_width - project_width) / 2);
            var new_margin_bottom = margin_bottom - ((enlarged_width - project_width) / 2);
            var new_margin_top = margin_top - ((enlarged_width - project_width) / 2);
            
            new_offset_top += new_margin_top;
            console.log(new_offset_top);
            if(new_offset_top < min_margin_top) {
                new_margin_bottom += (new_margin_top);
                new_margin_top = margin_top;
            }
            
            el.css({
                "margin-left": new_margin_left + "px",
                "margin-right": new_margin_right + "px",
                "margin-bottom": new_margin_bottom,
                "margin-top": new_margin_top
            });
        } else {
            el.width("");
            el.height(project_width);

            $("img", el).height(project_width);
            
            el.css({
                "margin-left": "",
                "margin-right": "",
                "margin-bottom": "",
                "margin-top": ""
            });
        }
    }
    

    var setSizeProjectsOverviewPage = function() {
        var minusHeight = 0;
        if ($("#wpadminbar").size() > 0) {
            minusHeight = $("#wpadminbar").height();
        }
        minusHeight += 0;

        $("#inner-content.projects").height($(window).height() - 57 - minusHeight);
        $("#container").css({"margin-top": minusHeight + "px"});

        if ($("#page-title.projects").size() > 0) {
            var title_width = $("#page-title.projects h2").width();

            $("#page-title.projects h2").css({
                "bottom": "125px",
                "right": "-125px"
            });
        }
    }

    /*
     Responsive jQuery is a tricky thing.
     There's a bunch of different ways to handle
     it, so be sure to research and find the one
     that works for you best.
     */

    /* getting viewport width */
    var responsive_viewport = $(window).width();

    /* if is below 481px */
    if (responsive_viewport < 481) {

    } /* end smallest screen */

    /* if is larger than 481px */
    if (responsive_viewport > 481) {

    } /* end larger than 481px */

    /* if is above or equal to 768px */
    if (responsive_viewport >= 768) {

        /* load gravatars */
        $('.comment img[data-gravatar]').each(function() {
            $(this).attr('src', $(this).attr('data-gravatar'));
        });

        setSizeProjectsOnOverview();
        setSizeProjectsOverviewPage();

        $(window).resize(function() {
            setSizeProjectsOnOverview();
            setSizeProjectsOverviewPage();
        });
        
        $(".project").on("mouseenter", function() {
            toggleSizeProjectsOnOverview($(this), true);
        }).on("mouseleave", function() {
            toggleSizeProjectsOnOverview($(this), false);
        });
    }

    /* off the bat large screen actions */
    if (responsive_viewport > 1030) {

    }


    // add all your scripts here


}); /* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
 */
(function(w) {
    // This fix addresses an iOS bug, so return early if the UA claims it's something else.
    if (!(/iPhone|iPad|iPod/.test(navigator.platform) && navigator.userAgent.indexOf("AppleWebKit") > -1)) {
        return;
    }
    var doc = w.document;
    if (!doc.querySelector) {
        return;
    }
    var meta = doc.querySelector("meta[name=viewport]"),
            initialContent = meta && meta.getAttribute("content"),
            disabledZoom = initialContent + ",maximum-scale=1",
            enabledZoom = initialContent + ",maximum-scale=10",
            enabled = true,
            x, y, z, aig;
    if (!meta) {
        return;
    }
    function restoreZoom() {
        meta.setAttribute("content", enabledZoom);
        enabled = true;
    }
    function disableZoom() {
        meta.setAttribute("content", disabledZoom);
        enabled = false;
    }
    function checkTilt(e) {
        aig = e.accelerationIncludingGravity;
        x = Math.abs(aig.x);
        y = Math.abs(aig.y);
        z = Math.abs(aig.z);
        // If portrait orientation and in one of the danger zones
        if (!w.orientation && (x > 7 || ((z > 6 && y < 8 || z < 8 && y > 6) && x > 5))) {
            if (enabled) {
                disableZoom();
            }
        }
        else if (!enabled) {
            restoreZoom();
        }
    }
    w.addEventListener("orientationchange", restoreZoom, false);
    w.addEventListener("devicemotion", checkTilt, false);
})(this);