;(function($) {
    "use strict";

    $(window).load(function(){
        var all_images = la_threesixty_vars.images,
            image_array = $.parseJSON( all_images );

        var product_threesixty = $( '.la-threesixty' ).ThreeSixty({
            totalFrames : image_array.length,
            currentFrame: 1,
            endFrame    : image_array.length,
            framerate   : la_threesixty_vars.framerate,
            playSpeed   : la_threesixty_vars.playspeed,
            imgList     : '.threesixty_images',
            progress    : '.spinner',
            filePrefix  : '',
            height      : la_threesixty_vars.height,
            width       : la_threesixty_vars.width,
            navigation  : la_threesixty_vars.navigation,
            imgArray    : image_array,
            responsive  : la_threesixty_vars.responsive,
            drag        : la_threesixty_vars.drag,
            disableSpin : la_threesixty_vars.spin
        });

        $( document ).trigger( 'la_threesixty:init', [ product_threesixty ] );
    });

})(jQuery);