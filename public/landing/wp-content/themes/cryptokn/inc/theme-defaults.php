<?php
/**
||-> Defining Default datas
*/
function cryptokn_init_function( $key = null ){

    $cryptokn_init = array(
        /* Blog Variant
        Choose from: blogloop-v1, blogloop-v2, blogloop-v3, blogloop-v4, blogloop-v5 */
        'blog_variant' => 'blogloop-v2',
        /* Header Variant 
        Choose from: header1, header2, header3, header4, header5, header8, header9 */
        'header_variant' => 'header1',
        /* Footer Variant 
        Choose from: footer1, footer2 */
        'footer_variant' => 'footer1',
        /* Header Navigation Hover
        Choose from: navstyle-v1, navstyle-v2, navstyle-v3, navstyle-v4, navstyle-v5, navstyle-v6, navstyle-v7, navstyle-v8 */
        'header_nav_hover' => 'navstyle-v8',
        /* Header Navigation Submenus Variant
        Choose from: nav-submenu-style1, nav-submenu-style2 */
        'header_nav_submenu_variant' => 'nav-submenu-style2',
        /* Sidebar Widgets Defaults
        Choose from: widgets_v1, widgets_v2 */
        'sidebar_widgets_variant' => 'widgets_v1',
        /* 404 Template Variant
        Choose from: page_404_v1_center, page_404_v2_left */
        'page_404_template_variant' => 'page_404_v1_left',
        /* Default Styling
        Set a HEXA Color Code */
        'fallback_primary_color' => '#ffd600', // Primary Color
        'fallback_primary_color_hover' => '#e5c000', // Primary Color - Hover
        'fallback_main_texts' => '#303030', // Main Texts Color
        'fallback_semitransparent_blocks' => 'rgba(255, 214, 0, 0.7)' // Semitransparent Blocks
    );

    // The Condition
    if ( is_null($key) ){
        return $cryptokn_init;
    } else if ( array_key_exists($key, $cryptokn_init) ) {
        return $cryptokn_init[$key];
    }
}

class cryptokn_init_class{
    public function cryptokn_get_blog_variant(){
        return cryptokn_init_function('blog_variant');
    }
    public function cryptokn_get_header_variant(){
        return cryptokn_init_function('header_variant');
    }
    public function cryptokn_get_header_nav_hover(){
        return cryptokn_init_function('header_nav_hover');
    }
    public function cryptokn_get_sidebar_widgets_variant(){
        return cryptokn_init_function('sidebar_widgets_variant');
    }
    public function cryptokn_get_page_404_template_variant(){
        return cryptokn_init_function('page_404_template_variant');
    }
    public function cryptokn_get_fallback_primary_color(){
        return cryptokn_init_function('fallback_primary_color');
    }
    public function cryptokn_get_fallback_primary_color_hover(){
        return cryptokn_init_function('fallback_primary_color_hover');
    }
    public function cryptokn_get_fallback_main_texts(){
        return cryptokn_init_function('fallback_main_texts');
    }
    public function cryptokn_get_fallback_semitransparent_blocks(){
        return cryptokn_init_function('fallback_semitransparent_blocks');
    }

    // Blog Loop Variant
    public function cryptokn_blogloop_variant(){
        if ( !class_exists( 'ReduxFrameworkPlugin' ) ) {
            $theme_init = new cryptokn_init_class;
            return $theme_init->cryptokn_get_blog_variant();
        }else{
            // GET VALUE FROM REDUX - THEME PANEL
            $redux_blogloop = cryptokn_redux('mt_blogloop_variant');
            return $redux_blogloop;
        }
    }

    // Navstyle Variant
    public function cryptokn_navstyle_variant(){
    	if ( !class_exists( 'ReduxFrameworkPlugin' ) ) {
			$theme_init = new cryptokn_init_class;
    		return $theme_init->cryptokn_get_header_nav_hover();
    	}else{
    		// GET VALUE FROM REDUX - THEME PANEL
            $redux_navstyle = cryptokn_redux('mt_nav_hover_variant');
    		return $redux_navstyle;
    	}
    }
}

?>