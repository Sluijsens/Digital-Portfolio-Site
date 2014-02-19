/*
 Bones Scripts File
 Author: Eddie Machado
 
 This file should contain any js scripts you want to add to the site.
 Instead of calling it in the header or throwing it inside wp_head()
 this file will be called automatically in the footer so as not to
 slow the page load.
 
 */

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if ( !window.getComputedStyle ) {
    window.getComputedStyle = function( el, pseudo ) {
        this.el = el;
        this.getPropertyValue = function( prop ) {
            var re = /(\-([a-z]){1})/g;
            if ( 'float' == prop ) {
                prop = 'styleFloat';
            }
            if ( re.test( prop ) ) {
                prop = prop.replace( re, function() {
                    return arguments[2].toUpperCase();
                } );
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        };
        return this;
    };
}

// as the page loads, call these scripts
jQuery( document ).ready( function( $ ) {

    /* Declare functions */
    var project_width = 0;
    var margin_left = $( ".project" ).css( "margin-left" );
    var margin_right = $( ".project" ).css( "margin-right" );
    var margin_bottom = $( ".project" ).css( "margin-bottom" );
    var margin_top = $( ".project" ).css( "margin-top" );
    var setSizeProjectsOnOverview = function() {
        if ( $( ".project" ).size() > 0 ) {
            var project = $( ".project" );

            project_width = project.width() - 5;

            project.height( project_width );

            $( "img", project ).height( project_width );
        }
    };

    // Enlarge project details on mouse enter and make them smaller on mous eleave
    var toggleSizeProjectsOnOverview = function( el, enlarge ) {

        if ( enlarge ) {
            var enlarged_width = ( project_width * 1.5 );
            var min_margin_top = 15;
            var new_offset_top = $( el ).parent().offset().top;
            var new_offset_bottom = $( el ).parent().offset().top + enlarged_width;
            console.log( new_offset_bottom + " en " + $( "#main" ).height() );
            el.width( enlarged_width );
            el.height( enlarged_width );

            $( "img", el ).height( enlarged_width );

            margin_left = parseInt( el.css( "margin-left" ).replace( "px", "" ) );
            margin_right = parseInt( el.css( "margin-right" ).replace( "px", "" ) );
            margin_bottom = parseInt( el.css( "margin-bottom" ).replace( "px", "" ) );
            margin_top = parseInt( el.css( "margin-top" ).replace( "px", "" ) );

            var new_margin_left = margin_left - ( ( enlarged_width - project_width ) / 2 );
            //alert(margin_left + " en " + new_margin_left + " en " + (enlarged_width - project_width));
            var new_margin_right = margin_right - ( ( enlarged_width - project_width ) / 2 );
            var new_margin_bottom = margin_bottom - ( ( enlarged_width - project_width ) / 2 );
            var new_margin_top = margin_top - ( ( enlarged_width - project_width ) / 2 );

            new_offset_top += new_margin_top;

            if ( new_offset_top < min_margin_top ) {
                new_margin_bottom += ( new_margin_top );
                new_margin_top = margin_top;
            } else if ( new_offset_bottom > $( "#main" ).height() ) {
                new_margin_bottom = 0;
                new_margin_top = margin_top;
            }

            el.css( {
                "margin-left": new_margin_left + "px",
                "margin-right": new_margin_right + "px",
                "margin-bottom": new_margin_bottom,
                "margin-top": new_margin_top
            } );
        } else {
            el.width( "" );
            el.height( project_width );

            $( "img", el ).height( project_width );

            el.css( {
                "margin-left": "",
                "margin-right": "",
                "margin-bottom": "",
                "margin-top": ""
            } );
        }
    };


    var setSizeProjectsOverviewPage = function() {
        var minusHeight = 0;
        if ( $( "#wpadminbar" ).size() > 0 ) {
            minusHeight = $( "#wpadminbar" ).height();
        }
        minusHeight += 0;

        $( "#inner-content.projects" ).height( $( window ).height() - 57 - minusHeight );
        $( "#container" ).css( {"margin-top": minusHeight + "px"} );

        if ( $( "#page-title.projects" ).size() > 0 ) {
            var title_width = $( "#page-title.projects h2" ).width();

            $( "#page-title.projects h2" ).css( {
                "bottom": "125px",
                "right": "-125px"
            } );
        }
    };
    
    // Plugins
    // Set the height and with in a scale
    $.fn.setSizeHighlightedProject = function() {

        // Scale of the highlight
        var scale_width = 16;
        var scale_height = 9;
        var scale = scale_width / scale_height;
        
        var minus_height = $( '#menu-main-menu' ).height();
        var margin_top = 0;
        if ( $( '#wpadminbar' ).size() > 0 ) {
            minus_height += $( '#wpadminbar' ).height();
            margin_top = $( '#wpadminbar' ).height();
        }
        
        var viewport_width = $( window ).width();
        var viewport_height = $( window ).height() -  minus_height;
        var viewport_scale = viewport_width / viewport_height;
        
        var width = viewport_width;
        var height = ( width / scale );
        
        if ( viewport_scale >= scale ) {

            height = viewport_height;
            width = height * scale;
            
        }
        
        alert( viewport_width + ' / ' + viewport_height + ' = ' + viewport_scale + ' en ' + scale );
        
        $( this ).height( height );
        $( this ).width( width );
        $( this ).css({
            'top': '0px'
        });
        $( this ).align_horizontally();
        
        var parent_height = viewport_height;
        var margin_top = ( parent_height / 2 ) - ( height / 2 );

        $( this ).css( 'margin-top', margin_top + 'px' );
    };
    // Align center vertically
    $.fn.align_vertically = function() {

        var height = $( this ).height();
        var parent_height = $( this ).parent().height();
        var margin_top = ( parent_height / 2 ) - ( height / 2 );

        $( this ).css( 'margin-top', margin_top + 'px' );
    };
    
    $.fn.align_horizontally = function() {

        var width = $( this ).width();
        var parent_width = $( this ).parent().width();
        var margin_left = ( parent_width / 2 ) - ( width / 2 );

        $( this ).css( 'margin-left', margin_left + 'px' );
    };

    /*
     Responsive jQuery is a tricky thing.
     There's a bunch of different ways to handle
     it, so be sure to research and find the one
     that works for you best.
     */

    /* getting viewport width */
    var responsive_viewport = $( window ).width();

    /* if is below 481px */
    if ( responsive_viewport < 481 ) {

    } /* end smallest screen */

    /* if is larger than 481px */
    if ( responsive_viewport > 481 ) {

    } /* end larger than 481px */

    /* if is above or equal to 768px */
    if ( responsive_viewport >= 768 ) {

        /* load gravatars */
        $( '.comment img[data-gravatar]' ).each( function() {
            $( this ).attr( 'src', $( this ).attr( 'data-gravatar' ) );
        } );

        setSizeProjectsOnOverview();
        setSizeProjectsOverviewPage();
        $( '#highlighted_project' ).setSizeHighlightedProject();
        $( '#highlighted_project_image #image_container' ).align_vertically();
        
        $( window ).resize( function() {
            setSizeProjectsOnOverview();
            setSizeProjectsOverviewPage();
            //$( '#highlighted_project' ).setSizeHighlightedProject();
        } );

        $( ".project" ).on( "mouseenter", function() {
            toggleSizeProjectsOnOverview( $( this ), true );
        } ).on( "mouseleave", function() {
            toggleSizeProjectsOnOverview( $( this ), false );
        } );

        $( '#highlighted_project_image img' ).align_vertically();
    }

    /* off the bat large screen actions */
    if ( responsive_viewport > 1030 ) {

    }


    // add all your scripts here


} ); /* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
 */
( function( w ) {
    // This fix addresses an iOS bug, so return early if the UA claims it's something else.
    if ( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ) {
        return;
    }
    var doc = w.document;
    if ( !doc.querySelector ) {
        return;
    }
    var meta = doc.querySelector( "meta[name=viewport]" ),
            initialContent = meta && meta.getAttribute( "content" ),
            disabledZoom = initialContent + ",maximum-scale=1",
            enabledZoom = initialContent + ",maximum-scale=10",
            enabled = true,
            x, y, z, aig;
    if ( !meta ) {
        return;
    }
    function restoreZoom() {
        meta.setAttribute( "content", enabledZoom );
        enabled = true;
    }
    function disableZoom() {
        meta.setAttribute( "content", disabledZoom );
        enabled = false;
    }
    function checkTilt( e ) {
        aig = e.accelerationIncludingGravity;
        x = Math.abs( aig.x );
        y = Math.abs( aig.y );
        z = Math.abs( aig.z );
        // If portrait orientation and in one of the danger zones
        if ( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ) {
            if ( enabled ) {
                disableZoom();
            }
        }
        else if ( !enabled ) {
            restoreZoom();
        }
    }
    w.addEventListener( "orientationchange", restoreZoom, false );
    w.addEventListener( "devicemotion", checkTilt, false );
} )( this );