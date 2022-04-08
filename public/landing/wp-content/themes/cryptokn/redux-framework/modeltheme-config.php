<?php

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_demo";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Panel', 'cryptokn' ),
        'page_title'           => esc_html__( 'Theme Panel', 'cryptokn' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'cryptokn_redux',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.WordPress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'href'  => esc_url('http://modeltheme.ticksy.com/'),
        'title' => esc_html__( 'Theme Support', 'cryptokn'),
    );
    $args['admin_bar_links'][] = array(
        'href'  => esc_url('http://themeforest.net/downloads'),
        'title' => esc_html__( 'Rate this theme', 'cryptokn'),
    );
    $args['admin_bar_links'][] = array(
        'href'  => esc_url('http://modeltheme.com'),
        'title' => esc_html__( 'ModelTheme.com', 'cryptokn'),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => esc_url('https://www.facebook.com/modeltheme'),
        'title' => esc_html__('Like us on Facebook', 'cryptokn'),
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('http://twitter.com/modeltheme'),
        'title' => esc_html__('Follow us on Twitter', 'cryptokn'),
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('http://modeltheme.ticksy.com/'),
        'title' => esc_html__('Submit a Ticket', 'cryptokn'),
        'icon'  => 'el el-cog'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('http://modeltheme.com/'),
        'title' => esc_html__('ModelTheme Website', 'cryptokn'),
        'icon'  => 'el el-globe'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( '', $v );
    } else {
        $args['intro_text'] = '';
    }

    // Add content after the form.
    $args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'cryptokn' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'cryptokn' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'cryptokn' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'cryptokn' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( 'This is the sidebar content, HTML is allowed.', 'cryptokn' );
    Redux::setHelpSidebar( $opt_name, $content );
    /*
     * <--- END HELP TABS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */


    include_once(get_template_directory(). '/redux-framework/modeltheme-config.arrays.php');
    include_once(get_template_directory(). '/redux-framework/modeltheme-config.responsive.php');
    include_once(get_template_directory(). '/redux-framework/modeltheme-config.woocommerce.php');
    /**
    ||-> SECTION: General Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'General Settings', 'cryptokn' ),
        'id'    => 'mt_general',
        'icon'  => 'el el-icon-wrench'
    ));
    // GENERAL SETTINGS
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General Settings', 'cryptokn' ),
        'id'         => 'mt_general_settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_breadcrumbs',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Breadcrumbs</h3>' )
            ),
            array(
                'id'       => 'mt_breadcrumbs_delimitator',
                'type'     => 'text',
                'title'    => esc_html__('Breadcrumbs delimitator', 'cryptokn'),
                'subtitle' => esc_html__('Set a breadcrumbs delimitator.', 'cryptokn'),
                'desc'     => esc_html__('For example: "/", "-" or "->"', 'cryptokn'),
                'default'  => '/'
            ),
            array(
                'id' => 'mt_breadcrumbs_image',
                'type' => 'media',
                'url' => true,
                'title' => esc_attr__('Breadcrumbs Image', 'cryptokn'),
                'compiler' => 'true',
                'default' => array('url' => get_template_directory_uri().'/images/breadcrumbs_image.jpg'),
            ),
            array(
                'id'       => 'mt_body_global_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Body Global Background', 'cryptokn' ),
                'subtitle' => esc_html__( 'Default: #ffffff', 'cryptokn' ),
                'default'  => '#ffffff',
            ),

        ),
    ));
    // Back to Top
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Back to Top Button', 'cryptokn' ),
        'id'         => 'mt_general_back_to_top',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'mt_backtotop_status',
                'type'     => 'switch', 
                'title'    => esc_html__('Back to Top Button Status', 'cryptokn'),
                'subtitle' => esc_html__('Enable or disable "Back to Top Button"', 'cryptokn'),
                'default'  => true,
            ),
            array(
                'id'       => 'mt_backtotop_bg_color',
                'type'     => 'color',
                'title'    => esc_html__('Back to Top Button Backgrond', 'cryptokn'), 
                'subtitle' => esc_html__('Default: Inherit from Predefined Skin', 'cryptokn'),
                'validate' => 'color',
                'default' => 'transparent',
            ),
            array(
                'id'       => 'mt_backtotop_bg_color_hover',
                'type'     => 'color',
                'title'    => esc_html__('Back to Top Button Backgrond - Hover', 'cryptokn'), 
                'subtitle' => esc_html__('Default: Inherit from Predefined Skin', 'cryptokn'),
                'validate' => 'color',
                'default' => 'transparent',
            ),
            array(
                'id'       => 'mt_backtotop_text_color',
                'type'     => 'color',
                'title'    => esc_html__('Back to Top Button Icon Color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: Inherit from Predefined Skin', 'cryptokn'),
                'validate' => 'color',
                'default' => '#fff',
            ),
            array(
                'id'       => 'mt_backtotop_text_color_hover',
                'type'     => 'color',
                'title'    => esc_html__('Back to Top Button Icon Color - Hover', 'cryptokn'), 
                'subtitle' => esc_html__('Default: Inherit from Predefined Skin', 'cryptokn'),
                'validate' => 'color',
                'default' => '#fff',
            ),

        ),
    ));
        // GENERAL SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Page Preloader', 'cryptokn' ),
        'id' => 'mt_general_preloader',
        'subsection' => true,
        'fields' => array(
            array(
                'id'   => 'mt_divider_preloader_status',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Page Preloader Status</h3>' )
            ),
            array(
                'id'       => 'mt_preloader_status',
                'type'     => 'switch', 
                'title'    => esc_html__('Enable Page Preloader', 'cryptokn'),
                'subtitle' => esc_html__('Enable or disable page preloader', 'cryptokn'),
                'default'  => true,
            ),
            array(
                'id'   => 'mt_divider_preloader_styling',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Page Preloader Styling</h3>' )
            ),
            array(         
                'id'       => 'mt_preloader_bg_color',
                'type'     => 'background',
                'title'    => esc_html__('Page Preloader Backgrond', 'cryptokn'), 
                'subtitle' => esc_html__('Default: Inherit from Predefined Skin', 'cryptokn'),
                'output' => array(
                    'body .cryptokn_preloader_holder'
                )
            ),
            array(
                'id'       => 'mt_preloader_color',
                'type'     => 'color',
                'title'    => esc_html__('Preloader color:', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #ffffff', 'cryptokn'),
                'default'  => '#ffffff',
                'validate' => 'color',
            ),
            array(
                'id'   => 'mt_divider_preloader_animation',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Page Preloader Variant</h3>' )
            ),
            array(
                'id'       => 'mt_preloader_animation',
                'type'     => 'radio',
                'title'    => esc_html__('Preloader Animation', 'cryptokn'), 
                'subtitle' => esc_html__('Select Preloader Animation', 'cryptokn'),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'v1_ball_triangle' => '<div class="cryptokn_preloader v1_ball_triangle">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-triangle-path">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>', 

                    'v2_ball_pulse' => '<div class="cryptokn_preloader v2_ball_pulse">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner ball-pulse">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v3_ball_grid_pulse' => '<div class="cryptokn_preloader v3_ball_grid_pulse">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-grid-pulse">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v4_ball_clip_rotate' => '<div class="cryptokn_preloader v4_ball_clip_rotate">
                                                    <div class="loaders">
                                                        <div class="loader">
                                                            <div class="loader-inner ball-clip-rotate">
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>',

                    'v5_ball_clip_rotate_pulse' => '<div class="cryptokn_preloader v5_ball_clip_rotate_pulse">
                                                        <div class="loaders">
                                                            <div class="loader">
                                                                <div class="loader-inner ball-clip-rotate-pulse">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>',

                    'v6_square_spin' => '<div class="cryptokn_preloader v6_square_spin">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner square-spin">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v7_ball_clip_rotate_multiple' => '<div class="cryptokn_preloader v7_ball_clip_rotate_multiple">
                                                            <div class="loaders">
                                                                <div class="loader">
                                                                    <div class="loader-inner ball-clip-rotate-multiple">
                                                                        <div></div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>',

                    'v8_ball_pulse_rise' => '<div class="cryptokn_preloader v8_ball_pulse_rise">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-pulse-rise">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v9_ball_rotate' => '<div class="cryptokn_preloader v9_ball_rotate">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner ball-rotate">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v10_cube_transition' => '<div class="cryptokn_preloader v10_cube_transition">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner cube-transition">
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v11_ball_zig_zag' => '<div class="cryptokn_preloader v11_ball_zig_zag">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-zig-zag">
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v12_ball_zig_zag_deflect' => '<div class="cryptokn_preloader v12_ball_zig_zag_deflect">
                                                        <div class="loaders">
                                                            <div class="loader">
                                                                <div class="loader-inner ball-zig-zag-deflect">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>',

                    'v13_ball_scale' => '<div class="cryptokn_preloader v13_ball_scale">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner ball-scale">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v14_line_scale' => '<div class="cryptokn_preloader v14_line_scale">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner line-scale">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v15_line_scale_party' => '<div class="cryptokn_preloader v15_line_scale_party">
                                                    <div class="loaders">
                                                        <div class="loader">
                                                            <div class="loader-inner line-scale-party">
                                                                <div></div>
                                                                <div></div>
                                                                <div></div>
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>',

                    'v16_ball_scale_multiple' => '<div class="cryptokn_preloader v16_ball_scale_multiple">
                                                    <div class="loaders">
                                                        <div class="loader">
                                                            <div class="loader-inner ball-scale-multiple">
                                                                <div></div>
                                                                <div></div>
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>',

                    'v17_ball_pulse_sync' => '<div class="cryptokn_preloader v17_ball_pulse_sync">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-pulse-sync">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v18_ball_beat' => '<div class="cryptokn_preloader v18_ball_beat">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner ball-beat">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v19_line_scale_pulse_out' => '<div class="cryptokn_preloader v19_line_scale_pulse_out">
                                                        <div class="loaders">
                                                            <div class="loader">
                                                                <div class="loader-inner line-scale-pulse-out">
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>',

                    'v20_line_scale_pulse_out_rapid' => '<div class="cryptokn_preloader v20_line_scale_pulse_out_rapid">
                                                            <div class="loaders">
                                                                <div class="loader">
                                                                    <div class="loader-inner line-scale-pulse-out-rapid">
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>'


                ),
                'default' => 'v19_line_scale_pulse_out'
            )
        ),
    ));
    // SIDEBARS
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Sidebars', 'cryptokn' ),
        'id'         => 'mt_general_sidebars',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_sidebars',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Generate Infinite Number of Sidebars</h3>' )
            ),
            array(
                'id'       => 'mt_dynamic_sidebars',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'Sidebars', 'cryptokn' ),
                'subtitle' => esc_html__( 'Use the "Add More" button to create unlimited sidebars.', 'cryptokn' ),
                'add_text' => esc_html__( 'Add one more Sidebar', 'cryptokn' ),
                'options'   => array(
                    'Burger Navigation',
                    'Sidebar 2'
                ),
            ),
        ),
    ));
    

    /**
    ||-> SECTION: Styling Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Styling Settings', 'cryptokn' ),
        'id'    => 'mt_styling',
        'icon'  => 'el el-icon-magic'
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Global Fonts', 'cryptokn' ),
        'id'         => 'mt_styling_global_fonts',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_googlefonts',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Import Infinite Google Fonts</h3>')
            ),
            array(
                'id'       => 'mt_google_fonts_select',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__('Import Google Font Globally', 'cryptokn'), 
                'subtitle' => esc_html__('Select one or multiple fonts', 'cryptokn'),
                'desc'     => esc_html__('Importing fonts made easy', 'cryptokn'),
                'options'  => $google_fonts_list,
                'default'  => array(
                    'Nunito:300,regular,600,700,800,900,latin'
                ),
            ),
        ),
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Skin color', 'cryptokn' ),
        'id'         => 'mt_styling_skin_color',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_predefined_skin',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Select a Predefined Skin</h3>' )
            ),
            array(
                'id'       => 'mt_predefined_skin',
                'type'     => 'palette',
                'title'    => esc_html__( 'Predefined Skin', 'cryptokn' ),
                'default'  => 'skin_yellow2',
                'palettes' => array(
                    'skin_blue'  => array(
                        '#3498db',
                        '#2980b9',
                        '#454646',
                    ),
                    'skin_turquoise'  => array(
                        '#1abc9c',
                        '#16a085',
                        '#454646',
                    ),
                    'skin_green'  => array(
                        '#2ecc71',
                        '#27ae60',
                        '#454646',
                    ),
                    'skin_purple'  => array(
                        '#9b59b6',
                        '#8e44ad',
                        '#454646',
                    ),
                    'skin_yellow'  => array(
                        '#f1c40f',
                        '#f39c12',
                        '#454646',
                    ),
                    'skin_orange'  => array(
                        '#e67e22',
                        '#d35400',
                        '#454646',
                    ),
                    'skin_red'  => array(
                        '#e74c3c',
                        '#c0392b',
                        '#454646',
                    ),
                    'skin_gray'  => array(
                        '#95a5a6',
                        '#7f8c8d',
                        '#454646',
                    ),
                    'skin_yellow2'  => array(
                        '#ffd600',
                        '#e5c000',
                        '#272d4d',
                    ),
                )
            ),
            array(
                'id'   => 'mt_divider_links',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Links Colors(Regular, Hover, Active/Visited)</h3>' )
            ),
            array(
                'id'       => 'mt_global_link_styling',
                'type'     => 'link_color',
                'title'    => esc_html__('Links Color Option', 'cryptokn'),
                'subtitle' => esc_html__('Only color validation can be done on this field type(Default Regular: #ffd600; Default Hover: #252525; Default Active: #252525;)', 'cryptokn'),
                'default'  => array(
                    'regular'  => '#ffd600', // blue
                    'hover'    => '#252525', // blue-x3
                    'active'   => '#252525',  // blue-x3
                    'visited'  => '#252525',  // blue-x3
                )
            ),
            array(
                'id'   => 'mt_divider_main_colors',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Main Colors & Backgrounds</h3>' )
            ),
            array(
                'id'       => 'mt_style_main_texts_color',
                'type'     => 'color',
                'title'    => esc_html__('Main texts color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #ffd600', 'cryptokn'),
                'default'  => '#ffd600',
                'validate' => 'color',
            ),
            array(
                'id'       => 'mt_style_main_backgrounds_color',
                'type'     => 'color',
                'title'    => esc_html__('Main backgrounds color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #ffd600', 'cryptokn'),
                'default'  => '#ffd600',
                'validate' => 'color',
            ),
            array(
                'id'       => 'mt_style_main_backgrounds_color_hover',
                'type'     => 'color',
                'title'    => esc_html__('Main backgrounds color (hover)', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #252525', 'cryptokn'),
                'default'  => '#252525',
                'validate' => 'color',
            ),
            array(
                'id'       => 'mt_style_semi_opacity_backgrounds',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Semitransparent blocks background', 'cryptokn' ),
                'subtitle' => esc_html__( 'Default: rgba(14, 26, 33, 0.95)', 'cryptokn' ),
                'default'  => array(
                    'color' => '#252525',
                    'alpha' => '.95'
                ),
                'output' => array(
                    'background-color' => '.fixed-sidebar-menu',
                ),
                'mode'     => 'background'
            ),
            array(
                'id'   => 'mt_divider_text_selection',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Text Selection Color & Background</h3>' )
            ),
            array(
                'id'       => 'mt_text_selection_color',
                'type'     => 'color',
                'title'    => esc_html__('Text selection color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #ffffff', 'cryptokn'),
                'default'  => '#ffffff',
                'validate' => 'color',
            ),
            array(
                'id'       => 'mt_text_selection_background_color',
                'type'     => 'color',
                'title'    => esc_html__('Text selection background color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #ffd600', 'cryptokn'),
                'default'  => '#ffd600',
                'validate' => 'color',
            )
        ),
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Nav Menu', 'cryptokn' ),
        'id'         => 'mt_styling_nav_menu',
        'subsection' => true,
        'fields'     => array(

            array(
                'id'   => 'mt_divider_nav_menu_layout',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Nav Menu Hover / Layout</h3>' )
            ),
            array(
                'id'       => 'mt_nav_hover_variant',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_html__( 'Select Navigation Hover / Layout', 'cryptokn' ),
                'options'  => array(
                    'navstyle-v1' => array(
                        'alt' => esc_html__('Navstyle #1', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/navhovers/navhover_01.png'
                    ),
                    'navstyle-v2' => array(
                        'alt' => esc_html__('Navstyle #2', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/navhovers/navhover_02.png'
                    ),
                    'navstyle-v3' => array(
                        'alt' => esc_html__('Navstyle #3', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/navhovers/navhover_03.png'
                    ),
                    'navstyle-v4' => array(
                        'alt' => esc_html__('Navstyle #4', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/navhovers/navhover_04.png'
                    ),
                    'navstyle-v5' => array(
                        'alt' => esc_html__('Navstyle #5', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/navhovers/navhover_05.png'
                    ),
                    'navstyle-v6' => array(
                        'alt' => esc_html__('Navstyle #6', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/navhovers/navhover_06.png'
                    ),
                    'navstyle-v7' => array(
                        'alt' => esc_html__('Navstyle #7', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/navhovers/navhover_07.png'
                    ),
                    'navstyle-v8' => array(
                        'alt' => esc_html__('Navstyle #8', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/navhovers/navhover_08.png'
                    ),
                ),
                'default'  => 'navstyle-v8'
            ),


            array(
                'id'   => 'mt_divider_nav_menu',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Menus Styling</h3>' )
            ),
            array(
                'id'       => 'mt_nav_menu_color',
                'type'     => 'color',
                'title'    => esc_html__('Nav Menu Text Color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #ffffff', 'cryptokn'),
                'default'  => '#ffffff',
                'validate' => 'color',
                'output' => array(
                    'color' => '#navbar .menu-item > a,
                                .navbar-nav .search_products a,
                                .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus,
                                .navbar-default .navbar-nav > li > a',
                )
            ),
            array(
                'id'       => 'mt_nav_menu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__('Nav Menu Hover Text Color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: Inherit from Predefined Skin', 'cryptokn'),
                'default'  => '#ffd600',
                'validate' => 'color',
                'output' => array(
                    'color' => 'body #navbar .menu-item.selected > a, body #navbar .menu-item:hover > a',
                )
            ),
            array(
                'id'   => 'mt_divider_nav_submenu',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Submenus Styling</h3>' )
            ),
            array(
                'id'       => 'mt_nav_submenu_background',
                'type'     => 'color',
                'title'    => esc_html__('Nav Submenu Background Color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #272d4d', 'cryptokn'),
                'default'  => '#272d4d',
                'validate' => 'color',
                'output' => array(
                    'background-color' => '#navbar .sub-menu, .navbar ul li ul.sub-menu',
                )
            ),
            array(
                'id'       => 'mt_nav_submenu_color',
                'type'     => 'color',
                'title'    => esc_html__('Nav Submenu Text Color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #ffffff', 'cryptokn'),
                'default'  => '#ffffff',
                'validate' => 'color',
                'output' => array(
                    'color' => '#navbar ul.sub-menu li a',
                )
            ),
            array(
                'id'       => 'mt_nav_submenu_hover_background_color',
                'type'     => 'color',
                'title'    => esc_html__('Nav Submenu Hover Background Color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: transparent', 'cryptokn'),
                'default'  => 'transparent',
                'validate' => 'color',
                'output' => array(
                    'background-color' => '#navbar ul.sub-menu li a:hover',
                )
            ),
            array(
                'id'       => 'mt_nav_submenu_hover_text_color',
                'type'     => 'color',
                'title'    => esc_html__('Nav Submenu Hover Background Color', 'cryptokn'), 
                'subtitle' => esc_html__('Default: #ffd600', 'cryptokn'),
                'default'  => '#ffd600',
                'validate' => 'color',
                'output' => array(
                    'color' => 'body #navbar ul.sub-menu li a:hover',
                )
            ),
        ),
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Typography', 'cryptokn' ),
        'id'         => 'mt_styling_typography',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_4',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Body Font family</h3>' )
            ),
            array(
                'id'          => 'mt_body_typography',
                'type'        => 'typography', 
                'title'       => esc_html__('Body Font family', 'cryptokn'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => false,
                'line-height'  => false,
                'font-weight'  => false,
                'font-size'   => false,
                'font-style'  => false,
                'subsets'     => false,
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Nunito',
                    'font-weight' => '800', 
                    'google'      => true
                ),
            ),
            array(
                'id'   => 'mt_divider_5',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Headings</h3>' )
            ),
            array(
                'id'          => 'mt_heading_h1',
                'type'        => 'typography', 
                'title'       => esc_html__('Heading H1 Font family', 'cryptokn'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Nunito', 
                    'font-size' => '36px', 
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h2',
                'type'        => 'typography', 
                'title'       => esc_html__('Heading H2 Font family', 'cryptokn'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => true,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Nunito', 
                    'font-size' => '30px',
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h3',
                'type'        => 'typography', 
                'title'       => esc_html__('Heading H3 Font family', 'cryptokn'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Nunito', 
                    'font-size' => '24px', 
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h4',
                'type'        => 'typography', 
                'title'       => esc_html__('Heading H4 Font family', 'cryptokn'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Nunito', 
                    'font-size' => '18px', 
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h5',
                'type'        => 'typography', 
                'title'       => esc_html__('Heading H5 Font family', 'cryptokn'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Nunito', 
                    'font-size' => '14px', 
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h6',
                'type'        => 'typography', 
                'title'       => esc_html__('Heading H6 Font family', 'cryptokn'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Nunito', 
                    'font-size' => '12px', 
                    'google'      => true
                ),
            ),
            array(
                'id'   => 'mt_divider_6',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Inputs & Textareas Font family</h3>' )
            ),
            array(
                'id'                => 'mt_inputs_typography',
                'type'              => 'typography', 
                'title'             => esc_html__('Inputs Font family', 'cryptokn'),
                'google'            => true, 
                'font-backup'       => true,
                'color'             => false,
                'text-align'        => false,
                'letter-spacing'    => false,
                'line-height'       => false,
                'font-weight'       => false,
                'font-size'         => false,
                'font-style'        => false,
                'subsets'           => false,
                'units'             =>'px',
                'subtitle'          => esc_html__('Font family for inputs and textareas', 'cryptokn'),
                'default'           => array(
                    'font-family'       => 'Nunito', 
                    'google'            => true
                ),
            ),
            array(
                'id'   => 'mt_divider_7',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Buttons Font family</h3>' )
            ),
            array(
                'id'                => 'mt_buttons_typography',
                'type'              => 'typography', 
                'title'             => esc_html__('Buttons Font family', 'cryptokn'),
                'google'            => true, 
                'font-backup'       => true,
                'color'             => false,
                'text-align'        => false,
                'letter-spacing'    => false,
                'line-height'       => false,
                'font-weight'       => false,
                'font-size'         => false,
                'font-style'        => false,
                'subsets'           => false,
                'units'             =>'px',
                'subtitle'          => esc_html__('Font family for buttons', 'cryptokn'),
                'default'           => array(
                    'font-family'       => 'Nunito', 
                    'google'            => true
                ),
            ),

        ),
    ));

    /**
    ||-> SECTION: Responsive Typography
    */
    Redux::setSection( $opt_name, $responsive_headings);

    /**
    ||-> SECTION: Shop Settings
    */
    Redux::setSection( $opt_name, $woocommerce_tab);

    /**
    ||-> SECTION: Header Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Header Settings', 'cryptokn' ),
        'id'    => 'mt_header',
        'icon'  => 'el el-icon-arrow-up'
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header - General', 'cryptokn' ),
        'id'         => 'mt_header_general',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_generalheader',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Global Header Options</h3>' )
            ),
            array(
                'id'       => 'mt_header_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_html__( 'Select Header layout', 'cryptokn' ),
                'options'  => array(
                    'header1' => array(
                        'alt' => esc_html__('Header #1', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/headers/1.png'
                    ),
                    'header2' => array(
                        'alt' => esc_html__('Header #2', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/headers/2.png'
                    ),
                    'header3' => array(
                        'alt' => esc_html__('Header #3', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/headers/3.png'
                    ),
                    'header4' => array(
                        'alt' => esc_html__('Header #4', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/headers/4.png'
                    ),
                ),
                'default'  => 'header1'
            ),
            array(         
                'id'       => 'mt_header_main_background',
                'type'     => 'background',
                'title'    => esc_html__('Header (main-header) - background', 'cryptokn'),
                'subtitle' => esc_html__('Default color: #272d4d', 'cryptokn'),
                'output'      => array('.navbar-default'),
                'default'  => array(
                    'background-color' => '#272d4d',
                )
            ),
            array(
                'id'       => 'mt_is_nav_sticky',
                'type'     => 'switch', 
                'title'    => esc_html__('Sticky Navigation Menu?', 'cryptokn'),
                'subtitle' => esc_html__('Enable or disable "sticky positioned navigation menu".', 'cryptokn'),
                'default'  => false,
                'on'       => esc_html__( 'Enabled', 'cryptokn' ),
                'off'      => esc_html__( 'Disabled', 'cryptokn' )
            ),
            array(
                'id'   => 'mt_divider_header_stat',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Search Icon Settings(from header)</h3>' )
            ),
            array(
                'id'       => 'mt_header_is_search',
                'type'     => 'switch', 
                'title'    => esc_html__('Search Icon Status', 'cryptokn'),
                'subtitle' => esc_html__('Enable or Disable Search Icon".', 'cryptokn'),
                'default'  => true,
                'on'       => esc_html__( 'Enabled', 'cryptokn' ),
                'off'      => esc_html__( 'Disabled', 'cryptokn' )
            ),
            array(
                'id'       => 'mt_header_is_search_custom_styling',
                'type'     => 'switch', 
                'title'    => esc_html__('Search Icon - Custom Styling?', 'cryptokn'),
                'subtitle' => esc_html__('Enable or Disable Custom Styling for Search Icon".', 'cryptokn'),
                'default'  => false,
                'on'       => esc_html__( 'Yes - Add Custom Colors', 'cryptokn' ),
                'off'      => esc_html__( 'No - Keep Predefined Colors', 'cryptokn' )
            ),
            array(
                'id'       => 'mt_header_search_color',
                'type'     => 'color',
                'title'    => esc_html__('Search Icon Color', 'cryptokn'), 
                'default'  => '#ffffff',
                'validate' => 'color',
                'required' => array( 'mt_header_is_search_custom_styling', '=', true ),
            ),
            array(
                'id'       => 'mt_header_search_color_hover',
                'type'     => 'color',
                'title'    => esc_html__('Search Icon Color - Hover', 'cryptokn'), 
                'default'  => '#ffd600',
                'validate' => 'color',
                'required' => array( 'mt_header_is_search_custom_styling', '=', true ),
            ),
            array(
                'id'   => 'mt_divider_header_info_1',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => __( '<h3>Header Info First</h3>', 'cryptokn' )
            ),
            array(
                'id'       => 'mt_divider_header_info_1_status',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Info 1 Status', 'cryptokn' ),
                'subtitle' => esc_html__( 'Enable/Disable Header Info 1', 'cryptokn' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_divider_header_info_1_media_type',
                'type'     => 'select',
                'title'    => esc_html__( 'Media Type', 'cryptokn' ),
                'subtitle' => esc_html__( 'Choose to enter text or upload an image icon or select a font icon', 'cryptokn' ),
                'options'  => array(
                    'font_awesome'      => esc_html__( 'Font Icon', 'cryptokn' ),
                    'media_image'       => esc_html__( 'Media Image', 'cryptokn' ),
                    'text_title'        => esc_html__( 'Text Title', 'cryptokn' )
                ),
                'default'  => 'text_title',
                'required' => array( 'mt_divider_header_info_1_status', '=', '1' ),
            ),
            array(
                'id'       => 'mt_divider_header_info_1_faicon',
                'type'     => 'select',
                'select2'  => array( 'containerCssClass' => 'fa' ),
                'title'    => esc_html__('Icon for Header Info 1', 'cryptokn'),
                'options'  => $icons,
                'default'  => 'fa fa-phone',
                'required' => array( 
                    array('mt_divider_header_info_1_status', '=', '1'), 
                    array('mt_divider_header_info_1_media_type','=','font_awesome') 
                ),
            ),
            array(
                'id' => 'mt_divider_header_info_1_image_icon',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Upload Image Icon', 'cryptokn'),
                'compiler' => 'true',
                'required' => array( 
                    array('mt_divider_header_info_1_status', '=', '1'), 
                    array('mt_divider_header_info_1_media_type','=','media_image') 
                ),
                'default' => array('url' => esc_url(get_template_directory_uri().'/images/working_time1.png')),
            ),
            array(
                'id' => 'mt_divider_header_info_1_text_1',
                'type' => 'text',
                'title' => esc_html__('Title for Header Info 1', 'cryptokn'),
                'subtitle' => esc_html__('Type title for Header Info 1', 'cryptokn'),
                'default' => 'Call Us:',
                'required' => array( 
                    array('mt_divider_header_info_1_status', '=', '1'), 
                    array('mt_divider_header_info_1_media_type','=','text_title') 
                ), 
            ),
            array(
                'id' => 'mt_divider_header_info_1_heading1',
                'type' => 'text',
                'title' => esc_html__('Header Info first - value', 'cryptokn'),
                'subtitle' => esc_html__('Type header info first value', 'cryptokn'),
                'default' => '(+04) 743 323 424',
                'required' => array( 'mt_divider_header_info_1_status', '=', '1' ),
            ),
            array(
                'id'   => 'mt_divider_header_info_2',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => __( '<h3>Header Info Second</h3>', 'cryptokn' )
            ),
            array(
                'id'       => 'mt_divider_header_info_2_status',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Info 2 Status', 'cryptokn' ),
                'subtitle' => esc_html__( 'Enable/Disable Header Info 2', 'cryptokn' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_divider_header_info_2_media_type',
                'type'     => 'select',
                'title'    => esc_html__( 'Media Type', 'cryptokn' ),
                'subtitle' => esc_html__( 'Choose to enter text or upload an image icon or select a font icon', 'cryptokn' ),
                'options'  => array(
                    'font_awesome'      => esc_html__( 'Font Icon', 'cryptokn' ),
                    'media_image'       => esc_html__( 'Media Image', 'cryptokn' ),
                    'text_title'        => esc_html__( 'Text Title', 'cryptokn' )
                ),
                'default'  => 'text_title',
                'required' => array( 'mt_divider_header_info_2_status', '=', '1' ),
            ),
            array(
                'id'       => 'mt_divider_header_info_2_faicon',
                'type'     => 'select',
                'select2'  => array( 'containerCssClass' => 'fa' ),
                'title'    => esc_html__('Icon for Header Info 2', 'cryptokn'),
                'options'  => $icons,
                'default'  => 'fa fa-envelope',
                'required' => array( 
                    array('mt_divider_header_info_2_status', '=', '1'), 
                    array('mt_divider_header_info_2_media_type','=','font_awesome') 
                ),
            ),
            array(
                'id' => 'mt_divider_header_info_2_image_icon',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Upload Image Icon', 'cryptokn'),
                'compiler' => 'true',
                'required' => array( 
                    array('mt_divider_header_info_2_status', '=', '1'), 
                    array('mt_divider_header_info_2_media_type','=','media_image') 
                ),
                'default' => array('url' => esc_url(get_template_directory_uri().'/images/working_location1.png')),
            ),
            array(
                'id' => 'mt_divider_header_info_2_text_2',
                'type' => 'text',
                'title' => esc_html__('Title for Header Info 2', 'cryptokn'),
                'subtitle' => esc_html__('Type title for Header Info 2', 'cryptokn'),
                'default' => 'Address:',
                'required' => array( 
                    array('mt_divider_header_info_2_status', '=', '1'), 
                    array('mt_divider_header_info_2_media_type','=','text_title') 
                ), 
            ),
            array(
                'id' => 'mt_divider_header_info_2_heading1',
                'type' => 'text',
                'title' => esc_html__('Header Info Second - Value', 'cryptokn'),
                'subtitle' => esc_html__('Type header info Second value', 'cryptokn'),
                'default' => 'New York, Thomas Nolan 5322',
                'required' => array( 'mt_divider_header_info_2_status', '=', '1' ),
            ),
            array(
                'id'   => 'mt_divider_header_info_3',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Header Info Third</h3>')
            ),
            array(
                'id'       => 'mt_divider_header_info_3_status',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Info 3 Status', 'cryptokn' ),
                'subtitle' => esc_html__( 'Enable/Disable Header Info 3', 'cryptokn' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_divider_header_info_3_media_type',
                'type'     => 'select',
                'title'    => esc_html__( 'Media Type', 'cryptokn' ),
                'subtitle' => esc_html__( 'Choose to enter text or upload an image icon or select a font icon', 'cryptokn' ),
                'options'  => array(
                    'font_awesome'      => esc_html__( 'Font Icon', 'cryptokn' ),
                    'media_image'       => esc_html__( 'Media Image', 'cryptokn' ),
                    'text_title'        => esc_html__( 'Text Title', 'cryptokn' )
                ),
                'default'  => 'text_title',
                'required' => array( 'mt_divider_header_info_3_status', '=', '1' ),
            ),
            array(
                'id'       => 'mt_divider_header_info_3_faicon',
                'type'     => 'select',
                'select2'  => array( 'containerCssClass' => 'fa' ),
                'title'    => esc_html__('Icon for Header Info 3', 'cryptokn'),
                'options'  => $icons,
                'default'  => 'fa fa-clock-o',
                'required' => array( 
                    array('mt_divider_header_info_3_status', '=', '1'), 
                    array('mt_divider_header_info_3_media_type','=','font_awesome') 
                ),
            ),
            array(
                'id' => 'mt_divider_header_info_3_image_icon',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Upload Image Icon', 'cryptokn'),
                'compiler' => 'true',
                'required' => array( 
                    array('mt_divider_header_info_3_status', '=', '1'), 
                    array('mt_divider_header_info_3_media_type','=','media_image') 
                ),
                'default' => array('url' => esc_url(get_template_directory_uri().'/images/working_phone.png')),
            ),
            array(
                'id' => 'mt_divider_header_info_3_text_3',
                'type' => 'text',
                'title' => esc_html__('Title for Header Info 3', 'cryptokn'),
                'subtitle' => esc_html__('Type title for Header Info 3', 'cryptokn'),
                'default' => 'Schedule:',
                'required' => array( 
                    array('mt_divider_header_info_3_status', '=', '1'), 
                    array('mt_divider_header_info_3_media_type','=','text_title') 
                ), 
            ),
            array(
                'id' => 'mt_divider_header_info_3_heading1',
                'type' => 'text',
                'title' => esc_html__('Header Info Third - Value', 'cryptokn'),
                'subtitle' => esc_html__('Type header info Third value', 'cryptokn'),
                'default' => 'Mon-Sat: 09:00 - 18:00',
                'required' => array( 'mt_divider_header_info_3_status', '=', '1' ),
            ),

        ),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo &amp; Favicon', 'cryptokn' ),
        'id'         => 'mt_header_logo',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_logo',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Logo Settings</h3>' )
            ),
            array(
                'id' => 'mt_logo',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Logo image', 'cryptokn'),
                'compiler' => 'true',
                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
            ),
            array(
                'id'        => 'mt_logo_max_width',
                'type'      => 'slider',
                'title'     => esc_html__('Logo Max Width', 'cryptokn'),
                'subtitle'  => esc_html__('Use the slider to increase/decrease max size of the logo.', 'cryptokn'),
                'desc'      => esc_html__('Min: 1px, max: 500px, step: 1px, default value: 190px', 'cryptokn'),
                "default"   => 190,
                "min"       => 1,
                "step"      => 1,
                "max"       => 500,
                'display_value' => 'label'
            ),
            array(
                'id'   => 'mt_divider_favicon',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Favicon Settings</h3>' )
            ),
            array(
                'id' => 'mt_favicon',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Favicon url', 'cryptokn'),
                'compiler' => 'true',
                'subtitle' => esc_html__('Use the upload button to import media.', 'cryptokn'),
                'default' => array('url' => get_template_directory_uri().'/images/favicon.png'),
            )
        ),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Fixed Sidebar Menu', 'cryptokn' ),
        'id'         => 'mt_header_fixed_sidebar_menu',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_fixed_headerstatus',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Status</h3>' )
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_status',
                'type'     => 'switch',
                'title'    => esc_html__( 'Burger Sidebar Menu Status', 'cryptokn' ),
                'subtitle' => esc_html__( 'Enable/Disable Burger Sidebar Menu Status', 'cryptokn' ),
                'desc'     => esc_html__( 'This Option Will Enable/Disable The Navigation Burger + Sidebar Menu triggered by the burger menu', 'cryptokn' ),
                'default'  => 1,
                'on'       => esc_html__( 'Enabled', 'cryptokn' ),
                'off'      => esc_html__( 'Disabled', 'cryptokn' ),
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_custom_styling',
                'type'     => 'switch', 
                'title'    => esc_html__('Burger Sidebar Menu - Custom Styling?', 'cryptokn'),
                'subtitle' => esc_html__('Enable or Disable Custom Styling for Burger Sidebar Menu Icon".', 'cryptokn'),
                'default'  => false,
                'on'       => esc_html__( 'Yes - Add Custom Colors', 'cryptokn' ),
                'off'      => esc_html__( 'No - Keep Predefined Colors', 'cryptokn' )
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_color',
                'type'     => 'color',
                'title'    => esc_html__('Burger Sidebar Menu Color', 'cryptokn'), 
                'default'  => '#ffffff',
                'validate' => 'color',
                'required' => array( 'mt_header_fixed_sidebar_menu_custom_styling', '=', true ),
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_color_hover',
                'type'     => 'color',
                'title'    => esc_html__('Burger Sidebar Menu Color - Hover', 'cryptokn'), 
                'default'  => '#ffd600',
                'validate' => 'color',
                'required' => array( 'mt_header_fixed_sidebar_menu_custom_styling', '=', true ),
            ),
            array(
                'id'   => 'mt_divider_fixed_header',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Other Options</h3>' )
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_bgs',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sidebar Menu Background', 'cryptokn' ),
                'subtitle' => esc_html__( 'Default: rgba(255, 255, 255, 0.95) - #ffffff - Opacity: 0.95', 'cryptokn' ),
                'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => '.95'
                ),
                'output' => array(
                    'background-color' => '.fixed-sidebar-menu'
                ),
                // These options display a fully functional color palette.  Omit this argument
                // for the minimal color picker, and change as desired.
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),                        
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_text_color',
                'type'     => 'color',
                'title'    => esc_html__('Texts Color', 'cryptokn'), 
                'default'  => '#000000',
                'validate' => 'color'
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_site_title_status',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Show Title or Logo', 'cryptokn' ),
                'subtitle' => esc_html__( 'Choose what to show on fixed sidebar', 'cryptokn' ),
                'desc'     => esc_html__( 'Choose Between Site Title or Site Logo', 'cryptokn' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'site_title' => 'Title',
                    'site_logo' => 'Logo',
                    'site_nothing' => 'Disable This Feature'
                ),
                'default'  => 'site_logo'
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar',
                'type'     => 'select',
                'data'     => 'sidebars',
                'title'    => esc_html__( 'Fixed Sidebar Menu - Sidebar', 'cryptokn' ),
                'subtitle' => esc_html__( 'Select Sidebar.', 'cryptokn' ),
                'default'   => 'sidebar-1',

            ),
            

        ),
    ) );

    /**

    ||-> SECTION: Footer Settings
    
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Footer Settings', 'cryptokn' ),
        'id'    => 'mt_footer',
        'icon'  => 'el el-icon-arrow-down'
    ) );


    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Top Rows', 'cryptokn' ),
        'id'         => 'mt_footer_top',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_footer_top',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Footer Top Rows</h3>' )
            ),
            array(         
                'id'       => 'mt_footer_top_background',
                'type'     => 'background',
                'title'    => esc_html__('Footer (top) - background', 'cryptokn'),
                'subtitle' => esc_html__('Footer background with image or color.', 'cryptokn'),
                'output'      => array('footer .footer-top'),
                'default'  => array(
                    'background-image' => get_template_directory_uri(). '/images/footer.jpg',
                    'background-size' => 'cover',
                    'background-position' => 'top',
                )
            ),
            array(
                'id'        => 'mt_footer_top_texts_color',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Footer Top Text Color', 'cryptokn' ),
                'subtitle'  => esc_html__( 'Set color and alpha channel', 'cryptokn' ),
                'desc'      => esc_html__( 'Set color and alpha channel for footer texts (Especially for widget titles)', 'cryptokn' ),
                'output'    => array('color' => 'footer .footer-top h1.widget-title, footer .footer-top h3.widget-title, footer .footer-top .widget-title'),
                'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => 1
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),                        
            ),
            array(
                'id'   => 'mt_divider_footer_row1',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Footer Rows - Row #1</h3>' )
            ),
            array(
                'id'       => 'mt_footer_row_1',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Row #1 - Status', 'cryptokn' ),
                'subtitle' => esc_html__( 'Enable/Disable Footer ROW 1', 'cryptokn' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_footer_row_1_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_html__( 'Footer Row #1 - Layout', 'cryptokn' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_html__('Footer 1 Column', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_1.png'
                    ),
                    '2' => array(
                        'alt' => esc_html__('Footer 2 Columns', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_2.png'
                    ),
                    '3' => array(
                        'alt' => esc_html__('Footer 3 Columns', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_3.png'
                    ),
                    '4' => array(
                        'alt' => esc_html__('Footer 4 Columns', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_4.png'
                    ),
                    '5' => array(
                        'alt' => esc_html__('Footer 5 Columns', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_5.png'
                    ),
                    '6' => array(
                        'alt' => esc_html__('Footer 6 Columns', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_6.png'
                    ),
                    'column_half_sub_half' => array(
                        'alt' => esc_html__('Footer 6 + 3 + 3', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_half_sub_half.png'
                    ),
                    'column_sub_half_half' => array(
                        'alt' => esc_html__('Footer 3 + 3 + 6', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_half_half.png'
                    ),
                    'column_sub_fourth_third' => array(
                        'alt' => esc_html__('Footer 2 + 2 + 2 + 2 + 4', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_fourth_third.png'
                    ),
                    'column_third_sub_fourth' => array(
                        'alt' => esc_html__('Footer 4 + 2 + 2 + 2 + 2', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_third_sub_fourth.png'
                    ),
                    'column_sub_third_half' => array(
                        'alt' => esc_html__('Footer 2 + 2 + 2 + 6', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half.png'
                    ),
                    'column_half_sub_third' => array(
                        'alt' => esc_html__('Footer 6 + 2 + 2 + 2', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half2.png'
                    ),
                ),
                'default'  => '1',
                'required' => array( 'mt_footer_row_1', '=', '1' ),
            ),
            array(
                'id'             => 'mt_footer_row_1_spacing',
                'type'           => 'spacing',
                'output'         => array('.footer-row-1'),
                'mode'           => 'padding',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_html__('Footer Row #1 - Padding', 'cryptokn'),
                'subtitle'       => esc_html__('Choose the spacing for the first row from footer.', 'cryptokn'),
                'required' => array( 'mt_footer_row_1', '=', '1' ),
                'default'            => array(
                    'padding-top'     => '90px', 
                    'padding-bottom'  => '90px', 
                    'units'          => 'px', 
                )
            ),
            array(
                'id'             => 'mt_footer_row_1margin',
                'type'           => 'spacing',
                'output'         => array('.footer-row-1'),
                'mode'           => 'margin',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_html__('Footer Row #1 - Margin', 'cryptokn'),
                'subtitle'       => esc_html__('Choose the margin for the first row from footer.', 'cryptokn'),
                'required' => array( 'mt_footer_row_1', '=', '1' ),
                'default'            => array(
                    'margin-top'     => '0px', 
                    'margin-bottom'  => '0px', 
                    'units'          => 'px', 
                )
            ),
            array( 
                'id'       => 'mt_footer_row_1border',
                'type'     => 'border',
                'title'    => esc_html__('Footer Row #1 - Borders', 'cryptokn'),
                'subtitle' => esc_html__('Only color validation can be done on this field', 'cryptokn'),
                'output'   => array('.footer-row-1'),
                'all'      => false,
                'required' => array( 'mt_footer_row_1', '=', '1' ),
                'default'  => array(
                    'border-color'  => '#515b5e', 
                    'border-style'  => 'solid', 
                    'border-top'    => '0', 
                    'border-right'  => '0', 
                    'border-bottom' => '0', 
                    'border-left'   => '0'
                )
            ),
            array(
                'id'   => 'mt_divider_footer_row2',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Footer Rows - Row #2</h3>' )
            ),
            array(
                'id'       => 'mt_footer_row_2',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Row #2 - Status', 'cryptokn' ),
                'subtitle' => esc_html__( 'Enable/Disable Footer ROW 2', 'cryptokn' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_footer_row_2_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_html__( 'Footer Row #1 - Layout', 'cryptokn' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_html__('Footer 1 Column', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_1.png'
                    ),
                    '2' => array(
                        'alt' => esc_html__('Footer 2 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_2.png'
                    ),
                    '3' => array(
                        'alt' => esc_html__('Footer 3 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_3.png'
                    ),
                    '4' => array(
                        'alt' => esc_html__('Footer 4 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_4.png'
                    ),
                    '5' => array(
                        'alt' => esc_html__('Footer 5 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_5.png'
                    ),
                    '6' => array(
                        'alt' => esc_html__('Footer 6 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_6.png'
                    ),
                    'column_half_sub_half' => array(
                        'alt' => esc_html__('Footer 6 + 3 + 3', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_half_sub_half.png'
                    ),
                    'column_sub_half_half' => array(
                        'alt' => esc_html__('Footer 3 + 3 + 6', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_half_half.png'
                    ),
                    'column_sub_fourth_third' => array(
                        'alt' => esc_html__('Footer 2 + 2 + 2 + 2 + 4', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_fourth_third.png'
                    ),
                    'column_third_sub_fourth' => array(
                        'alt' => esc_html__('Footer 4 + 2 + 2 + 2 + 2', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_third_sub_fourth.png'
                    ),
                    'column_sub_third_half' => array(
                        'alt' => esc_html__('Footer 2 + 2 + 2 + 6', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half.png'
                    ),
                    'column_half_sub_third' => array(
                        'alt' => esc_html__('Footer 6 + 2 + 2 + 2', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half2.png'
                    ),

                ),
                'default'  => '4',
                'required' => array( 'mt_footer_row_2', '=', '1' ),
            ),
            array(
                'id'             => 'footer_row_2_spacing',
                'type'           => 'spacing',
                'output'         => array('.footer-row-2'),
                'mode'           => 'padding',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_html__('Footer Row #2 - Padding', 'cryptokn'),
                'subtitle'       => esc_html__('Choose the spacing for the second row from footer.', 'cryptokn'),
                'required' => array( 'mt_footer_row_2', '=', '1' ),
                'default'            => array(
                    'padding-top'     => '0px', 
                    'padding-bottom'  => '40px', 
                    'units'          => 'px', 
                )
            ),
            array(
                'id'             => 'mt_footer_row_2margin',
                'type'           => 'spacing',
                'output'         => array('.footer-row-2'),
                'mode'           => 'margin',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_html__('Footer Row #2 - Margin', 'cryptokn'),
                'subtitle'       => esc_html__('Choose the margin for the first row from footer.', 'cryptokn'),
                'required' => array( 'mt_footer_row_2', '=', '1' ),
                'default'            => array(
                    'margin-top'     => '0px', 
                    'margin-bottom'  => '40px', 
                    'units'          => 'px', 
                )
            ),
            array( 
                'id'       => 'mt_footer_row_2border',
                'type'     => 'border',
                'title'    => esc_html__('Footer Row #2 - Borders', 'cryptokn'),
                'subtitle' => esc_html__('Only color validation can be done on this field', 'cryptokn'),
                'output'   => array('.footer-row-2'),
                'all'      => false,
                'required' => array( 'mt_footer_row_2', '=', '1' ),
                'default'  => array(
                    'border-color'  => '#515b5e', 
                    'border-style'  => 'solid', 
                    'border-top'    => '0', 
                    'border-right'  => '0', 
                    'border-bottom' => '2', 
                    'border-left'   => '0'
                )
            ),
            array(
                'id'   => 'mt_divider_footer_row3',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Footer Rows - Row #3</h3>' )
            ),
            array(
                'id'       => 'mt_footer_row_3',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Row #3 - Status', 'cryptokn' ),
                'subtitle' => esc_html__( 'Enable/Disable Footer ROW 3', 'cryptokn' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_footer_row_3_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_html__( 'Footer Row #3 - Layout', 'cryptokn' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_html__('Footer 1 Column', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_1.png'
                    ),
                    '2' => array(
                        'alt' => esc_html__('Footer 2 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_2.png'
                    ),
                    '3' => array(
                        'alt' => esc_html__('Footer 3 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_3.png'
                    ),
                    '4' => array(
                        'alt' => esc_html__('Footer 4 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_4.png'
                    ),
                    '5' => array(
                        'alt' => esc_html__('Footer 5 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_5.png'
                    ),
                    '6' => array(
                        'alt' => esc_html__('Footer 6 Columns', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_6.png'
                    ),
                    'column_half_sub_half' => array(
                        'alt' => esc_html__('Footer 6 + 3 + 3', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_half_sub_half.png'
                    ),
                    'column_sub_half_half' => array(
                        'alt' => esc_html__('Footer 3 + 3 + 6', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_half_half.png'
                    ),
                    'column_sub_fourth_third' => array(
                        'alt' => esc_html__('Footer 2 + 2 + 2 + 2 + 4', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_fourth_third.png'
                    ),
                    'column_third_sub_fourth' => array(
                        'alt' => esc_html__('Footer 4 + 2 + 2 + 2 + 2', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_third_sub_fourth.png'
                    ),
                    'column_sub_third_half' => array(
                        'alt' => esc_html__('Footer 2 + 2 + 2 + 6', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half.png'
                    ),
                    'column_half_sub_third' => array(
                        'alt' => esc_html__('Footer 6 + 2 + 2 + 2', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half2.png'
                    ),

                ),
                'default'  => '4',
                'required' => array( 'mt_footer_row_3', '=', '1' ),
            ),
            array(
                'id'             => 'mt_footer_row_3_spacing',
                'type'           => 'spacing',
                'output'         => array('.footer-row-3'),
                'mode'           => 'padding',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_html__('Footer Row #3 - Padding', 'cryptokn'),
                'subtitle'       => esc_html__('Choose the spacing for the third row from footer.', 'cryptokn'),
                'required' => array( 'mt_footer_row_3', '=', '1' ),
                'default'            => array(
                    'padding-top'     => '0px', 
                    'padding-bottom'  => '40px', 
                    'units'          => 'px', 
                )
            ),
            array(
                'id'             => 'mt_footer_row_3margin',
                'type'           => 'spacing',
                'output'         => array('.footer-row-3'),
                'mode'           => 'margin',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_html__('Footer Row #3 - Margin', 'cryptokn'),
                'subtitle'       => esc_html__('Choose the margin for the first row from footer.', 'cryptokn'),
                'required' => array( 'mt_footer_row_3', '=', '1' ),
                'default'            => array(
                    'margin-top'     => '0px', 
                    'margin-bottom'  => '20px', 
                    'units'          => 'px', 
                )
            ),
            array( 
                'id'       => 'mt_footer_row_3border',
                'type'     => 'border',
                'title'    => esc_html__('Footer Row #3 - Borders', 'cryptokn'),
                'subtitle' => esc_html__('Only color validation can be done on this field', 'cryptokn'),
                'output'   => array('.footer-row-3'),
                'all'      => false,
                'required' => array( 'mt_footer_row_3', '=', '1' ),
                'default'  => array(
                    'border-color'  => '#515b5e', 
                    'border-style'  => 'solid', 
                    'border-top'    => '0', 
                    'border-right'  => '0', 
                    'border-bottom' => '2', 
                    'border-left'   => '0'
                )
            )
        ),
    ));



    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Bottom Bar', 'cryptokn' ),
        'id'         => 'mt_footer_bottom',
        'subsection' => true,
        'fields'     => array(
            array(
                'id' => 'mt_footer_text',
                'type' => 'editor',
                'title' => esc_html__('Footer Text', 'cryptokn'),
                'default' => esc_html__('Bitcoin WordPress Theme by ModelTheme. 2019 All Rights Reserved.','cryptokn'),
            ),
            array(         
                'id'       => 'mt_footer_bottom_background',
                'type'     => 'background',
                'title'    => esc_html__('Footer (bottom) - background', 'cryptokn'),
                'subtitle' => esc_html__('Footer background with image or color.', 'cryptokn'),
                'output'      => array('footer .footer'),
                'default'  => array(
                    'background-color' => '#FFD600',
                )
            ),
            array(
                'id' => 'mt_logo_footer',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Logo image footer', 'cryptokn'),
                'compiler' => 'true',
                'default' => array('url' => get_template_directory_uri().'/images/logo-light.png'),
            ),
            array(
                'id'        => 'mt_footer_bottom_texts_color',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Footer Bottom Text Color', 'cryptokn' ),
                'subtitle'  => esc_html__( 'Set color and alpha channel', 'cryptokn' ),
                'desc'      => esc_html__( 'Set color and alpha channel for footer texts (Especially for widget titles)', 'cryptokn' ),
                'output'    => array('color' => 'footer .footer h1.widget-title, footer .footer h3.widget-title, footer .footer .widget-title'),
                'default'   => array(
                    'color'     => '#272d4d',
                    'alpha'     => 1
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),                        
            ),
        ),
    ));



    /**

    ||-> SECTION: Contact Settings
    
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Contact Settings', 'cryptokn' ),
        'id'    => 'mt_contact',
        'icon'  => 'el el-icon-map-marker-alt'
    ));
    // GENERAL
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Contact', 'cryptokn' ),
        'id'         => 'mt_contact_settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id' => 'mt_contact_phone',
                'type' => 'text',
                'title' => esc_html__('Phone Number', 'cryptokn'),
                'subtitle' => esc_html__('Contact phone number displayed on the contact us page.', 'cryptokn'),
                'default' => '(+40) 74 0920 2288'
            ),
            array(
                'id' => 'mt_contact_email',
                'type' => 'text',
                'title' => esc_html__('Email', 'cryptokn'),
                'subtitle' => esc_html__('Contact email displayed on the contact us page., additional info is good in here.', 'cryptokn'),
                'validate' => 'email',
                'msg' => 'custom error message',
                'default' => 'office@example.com'
            ),
            array(
                'id' => 'mt_contact_address',
                'type' => 'text',
                'title' => esc_html__('Address', 'cryptokn'),
                'subtitle' => esc_html__('Enter your contact address', 'cryptokn'),
                'default' => 'New York 11673 Collins Street West Victoria United State.'
            )
        ),
    ));
    
    // MAILCHIMP
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Mailchimp', 'cryptokn' ),
        'id'         => 'mt_contact_mailchimp',
        'subsection' => true,
        'fields'     => array(
            array(
                'id' => 'mt_mailchimp_apikey',
                'type' => 'text',
                'title' => esc_html__('Mailchimp apiKey', 'cryptokn'),
                'subtitle' => esc_html__('To enable Mailchimp please type in your apiKey', 'cryptokn'),
                'default' => 'da1175811870557923759df1b4258d0a-us9'
            ),
            array(
                'id' => 'mt_mailchimp_listid',
                'type' => 'text',
                'title' => esc_html__('Mailchimp listId', 'cryptokn'),
                'subtitle' => esc_html__('To enable Mailchimp please type in your listId', 'cryptokn'),
                'default' => '7ffd6ecdde'
            ),
            array(
                'id' => 'mt_mailchimp_data_center',
                'type' => 'text',
                'title' => esc_html__('Mailchimp form datacenter', 'cryptokn'),
                'subtitle' => esc_html__('To enable Mailchimp please type in your form datacenter', 'cryptokn'),
                'default' => 'us9'
            )
        ),
    ));



    /**
    ||-> SECTION: Blog Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog Settings', 'cryptokn' ),
        'id'    => 'mt_blog',
        'icon'  => 'el el-icon-comment'
    ));
    // SIDEBARS
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog Archive', 'cryptokn' ),
        'id'         => 'mt_blog_archive',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_blog_layout',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Blog List Layout</h3>' )
            ),
            array(
                'id'       => 'mt_blogloop_variant',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_html__( 'Select Blog Loop Design', 'cryptokn' ),
                'options'  => array(
                    'blogloop-v1' => array(
                        'alt' => esc_html__('Blogloop v1', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/blogloops/blogloop-v1.png'
                    ),
                    'blogloop-v2' => array(
                        'alt' => esc_html__('Blogloop v2', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/blogloops/blogloop-v2.png'
                    ),
                    'blogloop-v3' => array(
                        'alt' => esc_html__('Blogloop v3', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/blogloops/blogloop-v3.png'
                    ),
                    'blogloop-v4' => array(
                        'alt' => esc_html__('Blogloop v4', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/blogloops/blogloop-v4.png'
                    ),
                    'blogloop-v5' => array(
                        'alt' => esc_html__('Blogloop v4', 'cryptokn'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/blogloops/blogloop-v5.png'
                    ),
                ),
                'default'  => 'blogloop-v2'
            ),
            array(
                'id'       => 'mt_blog_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_html__( 'Blog List Layout', 'cryptokn' ),
                'subtitle' => esc_html__( 'Select Blog List layout.', 'cryptokn' ),
                'options'  => array(
                    'mt_blog_left_sidebar' => array(
                        'alt' => esc_html__('2 Columns - Left sidebar', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                    ),
                    'mt_blog_fullwidth' => array(
                        'alt' => esc_html__('1 Column - Full width', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                    ),
                    'mt_blog_right_sidebar' => array(
                        'alt' => esc_html__('2 Columns - Right sidebar', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                    )
                ),
                'default'  => 'mt_blog_right_sidebar'
            ),
            array(
                'id'       => 'mt_blog_layout_sidebar',
                'type'     => 'select',
                'data'     => 'sidebars',
                'title'    => esc_html__( 'Blog List Sidebar', 'cryptokn' ),
                'subtitle' => esc_html__( 'Select Blog List Sidebar.', 'cryptokn' ),
                'default'   => 'sidebar-1',
                'required' => array('mt_blog_layout', '!=', 'mt_blog_fullwidth'),
            ),
            array(
                'id'   => 'mt_divider_blog_elements',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Blog List Elements</h3>' )
            ),
            array(
                'id' => 'mt_blog_post_title',
                'type' => 'text',
                'title' => esc_html__('Blog Post Title', 'cryptokn'),
                'subtitle' => esc_html__('Enter the text you want to display as blog post title.', 'cryptokn'),
                'default' => 'All Blog Posts'
            )
        ),
    ));

    // SIDEBARS
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Post', 'cryptokn' ),
        'id'         => 'mt_blog_single_pos',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_single_blog_layout',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Single Blog List Layout</h3>' )
            ),
            array(
                'id'       => 'mt_single_blog_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_html__( 'Single Blog List Layout', 'cryptokn' ),
                'subtitle' => esc_html__( 'Select Blog List layout.', 'cryptokn' ),
                'options'  => array(
                    'mt_single_blog_left_sidebar' => array(
                        'alt' => esc_html__('2 Columns - Left sidebar', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                    ),
                    'mt_single_blog_fullwidth' => array(
                        'alt' => esc_html__('1 Column - Full width', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                    ),
                    'mt_single_blog_right_sidebar' => array(
                        'alt' => esc_html__('2 Columns - Right sidebar', 'cryptokn' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                    )
                ),
                'default'  => 'mt_single_blog_fullwidth'
            ),
            array(
                'id'       => 'mt_single_blog_layout_sidebar',
                'type'     => 'select',
                'data'     => 'sidebars',
                'title'    => esc_html__( 'Single Blog List Sidebar', 'cryptokn' ),
                'subtitle' => esc_html__( 'Select Blog List Sidebar.', 'cryptokn' ),
                'default'   => 'sidebar-1',
                'required' => array('mt_single_blog_layout', '!=', 'mt_single_blog_fullwidth'),
            ),
            array(
                'id'   => 'mt_divider_single_blog_typo',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Single Blog Post Font family</h3>' )
            ),
            array(
                'id'          => 'mt_single_post_typography',
                'type'        => 'typography', 
                'title'       => esc_html__('Blog Post Font family', 'cryptokn'),
                'subtitle'    => esc_html__( 'Default color: #454646; Font-size: 18px; Line-height: 29px;', 'cryptokn' ),
                'google'      => true, 
                'font-size'   => true,
                'line-height' => true,
                'color'       => true,
                'font-backup' => false,
                'text-align'  => false,
                'letter-spacing'  => false,
                'font-weight'  => false,
                'font-style'  => false,
                'subsets'     => false,
                'units'       =>'px',
                'default'     => array(
                    'color' => '#a7a7a7', 
                    'font-size' => '16px', 
                    'line-height' => '25px', 
                    'text-align' => 'left',
                    'font-family' => 'Nunito', 
                    'google'      => true
                ),
            ),
            array(
                'id'   => 'mt_divider_single_blog_elements',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Other Single Post Elements</h3>' )
            ),
            array(
                'id'       => 'mt_post_featured_image',
                'type'     => 'switch', 
                'title'    => esc_html__('Single post featured image.', 'cryptokn'),
                'subtitle' => esc_html__('Show or Hide the featured image from blog post page.".', 'cryptokn'),
                'default'  => true,
            ),
            array(
                'id'       => 'mt_enable_related_posts',
                'type'     => 'switch', 
                'title'    => esc_html__('Related Posts', 'cryptokn'),
                'subtitle' => esc_html__('Enable or disable related posts', 'cryptokn'),
                'default'  => true,
            ),
            array(
                'id'       => 'mt_enable_post_navigation',
                'type'     => 'switch', 
                'title'    => esc_html__('Post Navigation', 'cryptokn'),
                'subtitle' => esc_html__('Enable or disable post navigation', 'cryptokn'),
                'default'  => true,
            ),
            array(
                'id'       => 'mt_enable_authorbio',
                'type'     => 'switch', 
                'title'    => esc_html__('About Author', 'cryptokn'),
                'subtitle' => esc_html__('Enable or disable "About author" section on single post', 'cryptokn'),
                'default'  => false,
            ),
            // Author Bio Default Placeholder
            array(
                'id' => 'mt_author_default_placeholder',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Author Default Placeholder Thumbnail', 'cryptokn'),
                'compiler' => 'true',
                'subtitle' => esc_html__('Use the upload button to import media.', 'cryptokn'),
                'default' => array('url' => 'http://placehold.it/128x128'),
            ),
            array( 
                'id'       => 'mt_opt_raw',
                'type'     => 'raw',
                'title'    => esc_html__('Post Formats Icons', 'cryptokn'),
            ),
        ),
    ));
    

    /**
    ||-> SECTION: Social Media Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Social Media Settings', 'cryptokn' ),
        'id'    => 'mt_social_media',
        'icon'  => 'el el-icon-myspace'
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Media', 'cryptokn' ),
        'id'         => 'mt_social_media_settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_global_social_links',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Global Social Links</h3>' )
            ),
            array(
                'id' => 'mt_social_fb',
                'type' => 'text',
                'title' => esc_html__('Facebook URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Facebook url.', 'cryptokn'),
                'validate' => 'url',
                'default' => 'http://facebook.com'
            ),
            array(
                'id' => 'mt_social_tw',
                'type' => 'text',
                'title' => esc_html__('Twitter username', 'cryptokn'),
                'subtitle' => esc_html__('Type your Twitter username.', 'cryptokn'),
                'default' => 'envato'
            ),
            array(
                'id' => 'mt_social_pinterest',
                'type' => 'text',
                'title' => esc_html__('Pinterest URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Pinterest url.', 'cryptokn'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_skype',
                'type' => 'text',
                'title' => esc_html__('Skype Name', 'cryptokn'),
                'subtitle' => esc_html__('Type your Skype username.', 'cryptokn'),
                'default' => ''
            ),
            array(
                'id' => 'mt_social_instagram',
                'type' => 'text',
                'title' => esc_html__('Instagram URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Instagram url.', 'cryptokn'),
                'validate' => 'url',
                'default' => 'http://instagram.com'
            ),
            array(
                'id' => 'mt_social_youtube',
                'type' => 'text',
                'title' => esc_html__('YouTube URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your YouTube url.', 'cryptokn'),
                'validate' => 'url',
                'default' => 'http://youtube.com'
            ),
            array(
                'id' => 'mt_social_dribbble',
                'type' => 'text',
                'title' => esc_html__('Dribbble URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Dribbble url.', 'cryptokn'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_gplus',
                'type' => 'text',
                'title' => esc_html__('Google+ URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Google+ url.', 'cryptokn'),
                'validate' => 'url',
                'default' => 'http://plus.google.com'
            ),
            array(
                'id' => 'mt_social_linkedin',
                'type' => 'text',
                'title' => esc_html__('LinkedIn URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your LinkedIn url.', 'cryptokn'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_deviantart',
                'type' => 'text',
                'title' => esc_html__('Deviant Art URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Deviant Art url.', 'cryptokn'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_digg',
                'type' => 'text',
                'title' => esc_html__('Digg URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Digg url.', 'cryptokn'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_flickr',
                'type' => 'text',
                'title' => esc_html__('Flickr URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Flickr url.', 'cryptokn'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_stumbleupon',
                'type' => 'text',
                'title' => esc_html__('Stumbleupon URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Stumbleupon url.', 'cryptokn'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_tumblr',
                'type' => 'text',
                'title' => esc_html__('Tumblr URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Tumblr url.', 'cryptokn'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_vimeo',
                'type' => 'text',
                'title' => esc_html__('Vimeo URL', 'cryptokn'),
                'subtitle' => esc_html__('Type your Vimeo url.', 'cryptokn'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id'   => 'mt_divider_twitter_keys',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Twitter Keys - Necessary for Tweets Feed Shortcode</h3>' )
            ),
            array(
                'id' => 'mt_tw_consumer_key',
                'type' => 'text',
                'title' => esc_html__('Twitter Consumer Key', 'cryptokn'),
                'subtitle' => esc_html__('Type your Twitter Consumer key.', 'cryptokn'),
                'default' => 'iSbkrNtDw51LUizz5ouEkQ'
            ),
            array(
                'id' => 'mt_tw_consumer_secret',
                'type' => 'text',
                'title' => esc_html__('Twitter Consumer Secret key', 'cryptokn'),
                'subtitle' => esc_html__('Type your Twitter Consumer Secret key.', 'cryptokn'),
                'default' => 'pZe6vUWyWdHmfDEbGfcAJpu9uJnGeEDrgujuySqk'
            ),
            array(
                'id' => 'mt_tw_access_token',
                'type' => 'text',
                'title' => esc_html__('Twitter Access Token', 'cryptokn'),
                'subtitle' => esc_html__('Type your Access Token.', 'cryptokn'),
                'default' => '2385448772-FXizji2NK4imcKoohcVu036VykIp5goymadiiYF'
            ),
            array(
                'id' => 'mt_tw_access_token_secret',
                'type' => 'text',
                'title' => esc_html__('Twitter Access Token Secret', 'cryptokn'),
                'subtitle' => esc_html__('Type your Twitter Access Token Secret.', 'cryptokn'),
                'default' => '2wUWJhhnd0ErTCgOYoVokrGKPWV055F9K4Xv5JpOmUL2e'
            )
        ),
    ));
    /*
     * <--- END SECTIONS
     */
