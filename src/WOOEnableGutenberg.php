<?php
    /*
     * Plugin Name: WOOEnableGutenberg
     * Description: Quick and dirty gutenberg enabling for Woocommerce
     * Version: 0.1
     * Author: Immature Dawn
     * Author URI: http://immaturedawn.co.uk
     */
    if (!class_exists('WOOEnableGutenberg')) {
        /**
         * Simple static, singleton class to enable Gutenberg functionality in WOOCommerce
         * @class WOOEnableGutenberg
         * @static
         * @requires Wordpress, WOOCommerce
         * @author immaturedawn.co.uk
         */
        class WOOEnableGutenberg
        {
            /**
             * Return for use_block_editor_for_post_type and gutenberg_can_edit_post_type filters,
             * uses the classic-editor rollback by Kalimah Apps (dev.to/kalimahapps/)
             * @method activate_gutenberg_product
             * @static
             * @param {Boolean} $can_edit
             * @param {String} $post_type
             * @return Boolean
             */
            public static function activate_gutenberg_product ($can_edit, $post_type): Boolean
            {
                $disable = in_array('classic-editor', array_keys($_GET));
                if ($post_type === 'product' && !$disable) {
                    return true;
                }
                return $can_edit;
            }
            /**
             * Enables retrevial from REST
             * @method enable_taxonomy_rest
             * @static
             * @param {Array} $args
             * @return {Array} $args
             */
            public static function enable_taxonomy_rest ($args): Array
            {
                $args['show_in_rest'] = true;
                return $args;
            }
            /**
             * Assigns the functions to correct hooks, note the 11 so as to overide WOOCommerce trying to stop it
             * @method init
             * @static
             * @requires add_filter, add_action
             */
            public static function init(): void
            {
                if (function_exists('add_filter')) {
                    add_filter('use_block_editor_for_post_type', 'WOOEnableGutenberg::activate_gutenberg_product', 11, 2);
                    add_filter('gutenberg_can_edit_post_type', 'WOOEnableGutenberg::activate_gutenberg_product', 11, 2);
                    add_filter('woocommerce_taxonomy_args_product_cat', 'WOOEnableGutenberg::enable_taxonomy_rest', 11, 1);
                    add_filter('woocommerce_taxonomy_args_product_tag', 'WOOEnableGutenberg::enable_taxonomy_rest', 11, 1);
                }
                if (function_exists('add_action')) {
                    add_action('add_meta_boxes', 'WOOEnableGutenberg::register_catalog_meta_boxes');
                }
            }
            /*
             * Adds hook to allow catalog visibility to be shown using static class method product_data_visibility_from_WC_Admin_Post_Types
             * @method register_catalog_meta_boxes
             * @static
             */
            public static function register_catalog_meta_boxes(): void
            {
                global $current_screen;
                if (function_exists('add_meta_box') && method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor()) {
                    add_meta_box('catalog-visibility', __('Catalog visibility', 'textdomain'), 'WOOEnableGutenberg::product_data_visibility_from_WC_Admin_Post_Types', 'product', 'advanced');
                }
            }
            /*
             * Grabs and uses WC_Admin_Post_Types from WOOCommerce default, and then uses it to display the product_data_visibility metabox
             * @method product_data_visibility_from_WC_Admin_Post_Types
             * @static
             * @requires uses WC_Admin_Post_Types->product_data_visibility function from WOOCommerce default setup
             */
            public static function product_data_visibility_from_WC_Admin_Post_Types()
            {
                if (class_exists('WC_Admin_Post_Types') && method_exists('WC_Admin_Post_Types', 'product_data_visibility')) {
                    $m = new WC_Admin_Post_Types();
                    $m->product_data_visibility();
                }
            }
        }
        WOOEnableGutenberg::init();
    }
