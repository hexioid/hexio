<?php

defined( 'VCW_INDEX' ) or die( '' );

class VCW_Admin {

    static public function load()
    {
        //add_action( 'admin_init', array(get_class(), 'init') );

        add_action( 'admin_menu', array(get_class(), 'addToMenu') );
        add_action( 'admin_enqueue_scripts', array(get_class(), 'enqueueAssets') );
    }

    static public function addToMenu()
    {
        add_menu_page( 'Virtual Coin Widgets',
            'Coin Widgets',
            'manage_options',
            'vcw',
            array(get_class(), 'adminPage'),
            'dashicons-layout'
        );
    }

    static public function enqueueAssets()
    {

        wp_enqueue_script('jquery', '', array(), false, true);
        wp_enqueue_script('angularjs','https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.js', array('jquery'), '1.5.6', true);
        wp_enqueue_script('angularjs-sanitize','https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-sanitize.js', array(), '1.5.6', true);
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');
        wp_enqueue_style('vcw-style', VCW_URL.'css/vcw.css', array('font-awesome'), '1.1');
        wp_enqueue_script('money-js','https://cdnjs.cloudflare.com/ajax/libs/money.js/0.2.0/money.min.js', array(), '0.2.0', true);
        wp_register_script('vcw-script', VCW_URL.'js/vcw.min.js', array('jquery','angularjs','money-js'), '1.1', true);
        wp_enqueue_script('vcw-script');
        wp_localize_script('vcw-script', 'VCWConstants', array(
            'urls' => array(
                'ajax' => VCW_AJAX_URL
            ),
            'data' => VCW_Data::$data
        ));
        // Admin Assets
        wp_enqueue_style('vcw-admin-css', VCW_URL.'css/admin.css', array(), '1.1');
        wp_enqueue_script('vcw-admin-js', VCW_URL.'js/admin.min.js', array('jquery','angularjs','angularjs-sanitize','vcw-script'), '1.1', true);

    }

    static public function adminPage()
    {
        ?>
        <div id="vcw-admin-page" class="wrap" ng-app="VCW_AdminApp" ng-controller="vcwBuilderCtrl as builder">

            <h1>Virtual Coin Widgets</h1>

            <div class="card">
                <h2>Builder:</h2>
                <table id="vcw-admin-builder" class="form-table" ng-cloak>

                    <tbody>
                    <tr>
                        <th scope="row"><label for="shortcode">Shortcode</label></th>
                        <td><select name="shortcode" ng-options="s.v as s.n for s in builder.shortcodes" ng-model="builder.settings.shortcode"></select></td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="color">Color</label></th>
                        <td><select name="color" ng-options="color.v as color.n for color in builder.colors" ng-model="builder.settings.color"></select></td>
                    </tr>

                    <tr ng-if="!builder.isShortcode(['converter','table','small_table'])">
                        <th scope="row"><label for="symbol">Symbol</label></th>
                        <td><select name="symbol" ng-options="crypto.symbol as crypto.name for crypto in builder.cryptos" ng-model="builder.settings.symbol"></select></td>
                    </tr>

                    <tr ng-if="builder.isShortcode('converter')">
                        <th scope="row"><label for="symbol1">Symbol #1</label></th>
                        <td><select name="symbol1" ng-options="crypto.symbol as crypto.name for crypto in builder.cryptos" ng-model="builder.settings.symbols[0]"></select></td>
                    </tr>

                    <tr ng-if="builder.isShortcode('converter')">
                        <th scope="row"><label for="symbol2">Symbol #2</label></th>
                        <td><select name="symbol2" ng-options="crypto.symbol as crypto.name for crypto in builder.cryptos" ng-model="builder.settings.symbols[1]"></select></td>
                    </tr>

                    <tr ng-if="builder.isShortcode(['table','small_table'])">
                        <th scope="row"><label for="symbols_list">Symbols List</label></th>
                        <td><input class="regular-text code" name="symbols_list" type="text" ng-model="builder.settings.symbols_list"></td>
                    </tr>

                    <tr ng-if="builder.isShortcode(['price_label','big_price_label','table','small_table'])">
                        <th scope="row"><label for="currency">Price Currency</label></th>
                        <td><select name="currency" ng-options="currency.code as currency.name for currency in builder.currencies" ng-model="builder.settings.currency"></select></td>
                    </tr>


                    <tr ng-if="builder.isShortcode(['price_big_label','price_card','full_card'])">
                        <th scope="row"><label for="currency1">Price Currency #1</label></th>
                        <td><select name="currency1" ng-options="currency.code as currency.name for currency in builder.currencies" ng-model="builder.settings.currencies[0]"></select></td>
                    </tr>

                    <tr ng-if="builder.isShortcode(['price_big_label','price_card','full_card'])">
                        <th scope="row"><label for="currency2">Price Currency #2</label></th>
                        <td><select name="currency2" ng-options="currency.code as currency.name for currency in builder.currencies" ng-model="builder.settings.currencies[1]"></select></td>
                    </tr>

                    <tr ng-if="builder.isShortcode(['price_big_label','price_card','full_card'])">
                        <th scope="row"><label for="currency3">Price Currency #3</label></th>
                        <td><select name="currency3" ng-options="currency.code as currency.name for currency in builder.currencies" ng-model="builder.settings.currencies[2]"></select></td>
                    </tr>

                    <tr ng-if="!builder.isShortcode(['converter','table','small_table'])">
                        <th scope="row"><label for="url">URL</label></th>
                        <td><input class="regular-text code" name="url" type="text" ng-model="builder.settings.url"></td>
                    </tr>

                    <tr ng-if="!builder.isShortcode(['converter','table','small_table'])">
                        <th scope="row"><label for="target">Target</label></th>
                        <td><select name="target" ng-model="builder.settings.target">
                                <option value="_blank">New Tab</option>
                                <option value="_self">Same Tab</option>
                            </select></td>
                    </tr>
                    </tbody>


                </table>
            </div>

            <div class="card">

                <h2>Preview:</h2>
                <div id="vcw-admin-preview" compile="builder.preview_html">

                </div>
            </div>

            <div class="card">
                <h2>Shortcode:</h2>

                <form id="vcw-admin-shortcode">
                    <textarea class="large-text code" rows="3" ng-model="builder.output" readonly></textarea>
                </form>
            </div>


        </div>

        <?php
    }



}

VCW_Admin::load();