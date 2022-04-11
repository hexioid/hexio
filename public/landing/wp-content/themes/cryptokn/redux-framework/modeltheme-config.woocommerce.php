<?php 
$woocommerce_tab =  array(
                'icon' => 'el-icon-shopping-cart-sign',
                'title' => esc_html__('Shop Settings', 'cryptokn'),
                'fields' => array(
                     array(
                            'id'       => 'cryptokn_shop_layout',
                            'type'     => 'image_select',
                            'compiler' => true,
                            'title'    => esc_html__( 'Shop List Products Layout', 'cryptokn' ),
                            'subtitle' => esc_html__( 'Select Shop List Products layout.', 'cryptokn' ),
                            'options'  => array(
                                'cryptokn_shop_left_sidebar' => array(
                                    'alt' => '2 Columns - Left sidebar',
                                    'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                                ),
                                'cryptokn_shop_fullwidth' => array(
                                    'alt' => '1 Column - Full width',
                                    'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                                ),
                                'cryptokn_shop_right_sidebar' => array(
                                    'alt' => '2 Columns - Right sidebar',
                                    'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                                )
                            ),
                            'default'  => 'cryptokn_shop_left_sidebar'
                        ),
                    array(
                        'id'       => 'cryptokn_shop_layout_sidebar',
                        'type'     => 'select',
                        'data'     => 'sidebars',
                        'title'    => esc_html__( 'Shop List Sidebar', 'cryptokn' ),
                        'subtitle' => esc_html__( 'Select Shop List Sidebar.', 'cryptokn' ),
                        'default'   => 'woocommerce',
                        'required' => array('cryptokn_shop_layout', '!=', 'cryptokn_shop_fullwidth'),
                    ),
                    array(
                        'id'        => 'cryptokn-shop-columns',
                        'type'      => 'select',
                        'title'     => esc_html__('Number of shop columns', 'cryptokn'),
                        'subtitle'  => esc_html__('Number of products per column to show on shop list template.', 'cryptokn'),
                        'options'   => array(
                            '2'   => '2 columns',
                            '3'   => '3 columns',
                            '4'   => '4 columns'
                        ),
                        'default'   => '3',
                    ),
                     array(
                        'id'       => 'cryptokn_single_product_layout',
                        'type'     => 'image_select',
                        'compiler' => true,
                        'title'    => esc_html__( 'Single Product Layout', 'cryptokn' ),
                        'subtitle' => esc_html__( 'Select Single Product Layout.', 'cryptokn' ),
                        'options'  => array(
                            'cryptokn_shop_left_sidebar' => array(
                                'alt' => '2 Columns - Left sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                            ),
                            'cryptokn_shop_fullwidth' => array(
                                'alt' => '1 Column - Full width',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                            ),
                            'cryptokn_shop_right_sidebar' => array(
                                'alt' => '2 Columns - Right sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                            )
                        ),
                        'default'  => 'cryptokn_shop_right_sidebar'
                    ),
                    array(
                        'id'       => 'cryptokn_single_shop_sidebar',
                        'type'     => 'select',
                        'data'     => 'sidebars',
                        'title'    => esc_html__( 'Shop Single Product Sidebar', 'cryptokn' ),
                        'subtitle' => esc_html__( 'Select Shop List Sidebar.', 'cryptokn' ),
                        'default'   => 'woocommerce',
                        'required' => array('cryptokn_single_product_layout', '!=', 'cryptokn_shop_fullwidth'),
                    ),
                    array(
                        'id'       => 'is_add_to_compare_active',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Enable/disable compare products feature', 'cryptokn'),
                        'subtitle' => esc_html__('Show or Hide "Add to Compare" button for shop".', 'cryptokn'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'is_add_to_wishlist_active',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Enable/disable wishlist feature', 'cryptokn'),
                        'subtitle' => esc_html__('Show or Hide "Add to Wishlist" button and Header Wishlist link".', 'cryptokn'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'is_quick_view_active',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Enable/disable shop Quick View', 'cryptokn'),
                        'subtitle' => esc_html__('Show or Hide "Quick View" button from the shop".', 'cryptokn'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'cryptokn-enable-related-products',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Related Products', 'cryptokn'),
                        'subtitle' => esc_html__('Enable or disable related products on single product', 'cryptokn'),
                        'default'  => true,
                    ),
                    array(
                        'id'        => 'cryptokn-related-products-number',
                        'type'      => 'select',
                        'title'     => esc_html__('Number of related products', 'cryptokn'),
                        'subtitle'  => esc_html__('Number of related products to show on single product template.', 'cryptokn'),
                        'options'   => array(
                            '2'   => '3',
                            '3'   => '6',
                            '4'   => '9'
                        ),
                        'default'   => '3',
                        'required' => array('cryptokn-enable-related-products', '=', true),
                    ),
                )
            );