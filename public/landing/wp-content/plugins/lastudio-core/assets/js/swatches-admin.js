(function($) {
    'use strict';

    var $document = $(document),
        $body = $('body');

    var cache_key = 'la_swatches_galleries';
    var local_cache = {
        /**
         * timeout for cache in millis
         * @type {number}
         */
        timeout: 1800000, // 30 minutes
        /**
         * @type {{_: number, data: {}}}
         **/
        data: {},
        remove: function (key) {
            delete local_cache.data[key];
        },
        exist: function (key) {
            return !!local_cache.data[key] && ((new Date().getTime() - local_cache.data[key]._) < local_cache.timeout);
        },
        get: function (key) {
            return local_cache.data[key].data;
        },
        set: function ( key, cachedData, callback) {
            local_cache.remove(key);
            local_cache.data[key] = {
                _: new Date().getTime(),
                data: cachedData
            };
            if ($.isFunction(callback)) callback(cachedData);
        }
    };

    function input_variation_gallery_changed( $input ) {
        $input
            .closest( '.woocommerce_variation' )
            .addClass( 'variation-needs-update' );

        $( 'button.cancel-variation-changes, button.save-variation-changes' ).removeAttr( 'disabled' );
        $( '#variable_product_options' ).trigger( 'woocommerce_variations_input_changed' );
    }

    // Update Selected Images
    function update_selected_images( $table_col ) {
        // Get all selected images
        var $selectedImgs = [],
            $gallery_field = $table_col.find('.la_variation_image_gallery');

        $table_col.find('.la_variation_thumbs .image').each(function(){
            $selectedImgs.push($(this).attr('data-attachment_id'));
        });
        // Update hidden input with chosen images
        $gallery_field.val($selectedImgs.join(','));
        input_variation_gallery_changed( $gallery_field );
    }

    function refresh_gallery_html(){
        $body.on('gallery_ready', function( e, $btn, variation_id ){

            var galleries = {};

            if (local_cache.exist( cache_key )) {
                galleries = local_cache.get( cache_key );
            }

            if( typeof(galleries[variation_id]) != "undefined" && galleries[variation_id] !== null ) {

                var _wrapper_class = 'la_variation_thumb--'+variation_id;

                $('.'+_wrapper_class).remove();

                var _html = '<div class="la_variation_thumb '+_wrapper_class+'"><h4>Additional Images</h4>'+galleries[variation_id]+'<a href="#" class="la_swatches--manage_variation_thumbs button">Add Additional Images</a></div>';
                $btn.after(_html);

            }
            // Sort Images
            $( '.la_variation_thumbs' ).sortable({
                deactivate: function(en, ui) {
                    var $table_col = $(ui.item).closest('.upload_image');
                    update_selected_images($table_col);
                },
                placeholder: 'ui-state-highlight'
            });

        });
    }

    function trigger_get_gallery_data() {

        var $upload_image_button = $('.woocommerce_variations .upload_image_button');
        // set an empty object to store our variation galleries by id
        local_cache.set( cache_key, {} );
        // loop through each upload image btn
        $upload_image_button.each(function(){

            var $upload_btn = $(this),
                variation_id = $upload_btn.attr('rel'),
                galleries = {};

            // if the cache is already set, get the current data
            if (local_cache.exist( cache_key )) {
                galleries = local_cache.get( cache_key );
            }
            if( typeof(galleries[variation_id]) != "undefined" && galleries[variation_id] !== null ) {
                // this gallery has been loaded before, so
                // trigger this button as ready
                $body.trigger( 'gallery_ready', [ $upload_btn, variation_id ] );
            } else {
                // Set up content to inset after variation Image
                var ajax_data = {
                    'action': 		'la_swatch_admin_load_thumbnails',
                    'nonce':   		la_swatches_vars.nonce,
                    'variation_id': variation_id
                };
                $.ajax({
                    url: la_swatches_vars.ajax_url,
                    data: ajax_data,
                    context: this
                }).success(function(data) {
                    // add our gallery to the galleries data
                    // and add it to the cache
                    galleries[variation_id] = data;
                    local_cache.set( cache_key, galleries );
                    // this gallery is now loaded, so,
                    // trigger this button as ready
                    $body.trigger( 'gallery_ready', [ $upload_btn, variation_id ] );
                });

            }

        });
        refresh_gallery_html();
    }

    // Setup Variation Image Manager
    function setup_variation_image_manager(){
        trigger_get_gallery_data();
        var product_gallery_frame;
        $document.on('click', '.la_swatches--manage_variation_thumbs', function(e){
            e.preventDefault();
            var $el = $(this),
                $variation_thumbs = $el.siblings('.la_variation_thumbs'),
                $image_gallery_ids = $el.siblings('.la_variation_image_gallery'),
                attachment_ids = $image_gallery_ids.val();

            // Create the media frame.
            product_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                // Set the title of the modal.
                title: 'Manage Variation Images',
                button: {
                    text: 'Add to variation'
                },
                multiple: true
            });

            // When an image is selected, run a callback.
            product_gallery_frame.on( 'select', function() {
                var selection = product_gallery_frame.state().get('selection');
                selection.map( function( attachment ) {
                    attachment = attachment.toJSON();
                    if ( attachment.id ) {
                        attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
                        $variation_thumbs.append('\
                            <li class="image" data-attachment_id="' + attachment.id + '">\
                                <a href="#" class="delete" title="Delete image"><img src="' + attachment.url + '" /></a>\
                            </li>');
                    }
                } );

                $image_gallery_ids.val( attachment_ids );
                input_variation_gallery_changed( $image_gallery_ids );
            });

            // Finally, open the modal.
            product_gallery_frame.open();

            return false;
        });

        // Delete Image
        $document.on('click', '.la_variation_thumbs .delete', function(e){
            e.preventDefault();
            var $table_col = $(this).closest('.upload_image');
            // Remove clicked image
            $(this).closest('li').remove();
            update_selected_images($table_col);
        });

        // after variations load
        $( '#woocommerce-product-data' ).on( 'woocommerce_variations_loaded', function(){
            trigger_get_gallery_data();
        });

        // Once a new variation is added
        $('#variable_product_options').on('woocommerce_variations_added', function(){
            trigger_get_gallery_data();
        });
    }

    $(function(){
        setup_variation_image_manager();
    })

    $(document).ready(function(){
        $( '#panel_la_swatches').LA_FRAMEWORK_RELOAD_PLUGINS();


        $(document)
            .on('click', '.la_swatch_field_meta', function(e){
                e.preventDefault();
                $(this).toggleClass('open-form');
            })

            .on('change', '.tab_la_swatches .fields .sub_field select', function(e){
                var $this = $(this);
                $this.closest('.sub_field').find('.attribute_swatch_type').html($this.find('option:selected').text());
                if($this.val() == 'color'){
                    $this.closest('.sub_field').find('.attr-prev-type-color').show();
                    $this.closest('.sub_field').find('.attr-prev-type-image').hide();
                }else{
                    $this.closest('.sub_field').find('.attr-prev-type-color').hide();
                    $this.closest('.sub_field').find('.attr-prev-type-image').show();
                }
            })
            .on('change', '.tab_la_swatches .fields .sub_field input.wp-color-picker', function(){
                var $this = $(this);
                $this.closest('.sub_field').find('.attr-prev-type-color').css('background-color', $this.val());
            })
            .on('change', '.tab_la_swatches .fields .sub_field .la-field-image input', function(){
                var $this = $(this);
                $this.closest('.sub_field').find('.attr-prev-type-image').html($this.closest('.la-fieldset').find('.la-preview').html());
            })
            .on('change', '.tab_la_swatches .fields .la-parent-type-class', function(){
                var $this = $(this);
                $this.closest('.field').find('> .la_swatch_field_meta .attribute_swatch_type').html($this.find('option:selected').text());
            })
            .on('reload', '#variable_product_options', function(e){

                if($('#panel_la_swatches_inner').length == 0){
                    return;
                }
                $( '#woocommerce-product-data' ).block({
                    message: null,
                    overlayCSS: {
                        background: '#fff',
                        opacity: 0.6
                    }
                });
                var this_page = window.location.toString().replace( 'post-new.php?', 'post.php?post=' + woocommerce_admin_meta_boxes.post_id + '&action=edit&' );
                $( '#panel_la_swatches' ).load( this_page + ' #panel_la_swatches_inner', function() {
                    $( '#panel_la_swatches').trigger('reload');
                    $( '#panel_la_swatches').LA_FRAMEWORK_DEPENDENCY();
                    $( '#panel_la_swatches').LA_FRAMEWORK_RELOAD_PLUGINS();
                });
            })
            .on('woocommerce_variations_saved', '#woocommerce-product-data' ,function(e){
                if($('#panel_la_swatches_inner').length == 0){
                    return;
                }
                $( '#woocommerce-product-data' ).block({
                    message: null,
                    overlayCSS: {
                        background: '#fff',
                        opacity: 0.6
                    }
                });
                var this_page = window.location.toString().replace( 'post-new.php?', 'post.php?post=' + woocommerce_admin_meta_boxes.post_id + '&action=edit&' );
                $( '#panel_la_swatches' ).load( this_page + ' #panel_la_swatches_inner', function() {
                    $( '#panel_la_swatches').trigger('reload');
                    $( '#panel_la_swatches').LA_FRAMEWORK_DEPENDENCY();
                    $( '#panel_la_swatches').LA_FRAMEWORK_RELOAD_PLUGINS();
                });
            })
    })

})(jQuery);