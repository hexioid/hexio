<?php 
// CHECK IF PLUGIN ACTIVE OR NOT
function mt_plugin_active( $plugin ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( is_plugin_active( $plugin ) ) {
        return true;
    }

    return false;
}



// DFI SHOWING GALLERY IMAGES
function mt_dfi_ids($postID){
    global  $dynamic_featured_image;
    $featured_images = $dynamic_featured_image->get_featured_images( $postID );

    //Loop through the image to display your image
    if( !is_null($featured_images) ){

        $medias = array();

        foreach($featured_images as $images){
            $attachment_id = $images['attachment_id'];
            $medias[] = $attachment_id;
        }

        $ids = '';
        $len = count($medias);
        $i = 0;
        foreach($medias as $media){

            if ($i == $len - 1) {
                $ids .= $media;
            }else{
                $ids .= $media . ',';
            }

            $i++;

        }
    } 

    return $ids;
}


?>