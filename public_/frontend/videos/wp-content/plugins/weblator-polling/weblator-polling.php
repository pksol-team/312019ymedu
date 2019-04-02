<?php
/**
 *
 * @package   Weblator_Polling
 * @author    Weblator <daniel.prior@weblator.com>
 * @license   GPL-2.0+
 * @link      http://weblator.com
 * @copyright 2014 Weblator
 *
 * @wordpress-plugin
 * Plugin Name:       Weblator Polling
 * Plugin URI:        http://weblator.com
 * Description:       A Responsive Polling System
 * Version:           1.3.0
 * Author:            Weblator
 * Author URI:        http://weblator.com
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/
require_once( plugin_dir_path( __FILE__ ) . 'public/class-weblator-polling.php' );

register_activation_hook( __FILE__, array( 'Weblator_Polling', 'activate' ) );

add_action( 'plugins_loaded', array( 'Weblator_Polling', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-weblator-polling-admin.php' );
	add_action( 'plugins_loaded', array( 'Weblator_Polling_Admin', 'get_instance' ) );

}

/*----------------------------------------------------------------------------*
 * Ajax Functionality
 *----------------------------------------------------------------------------*/
require_once("admin/class-weblator-polling-ajax.php");
require_once("public/class-weblator-public-ajax.php");

add_action( 'wp_ajax_save_poll', array('Weblator_Polling_Ajax','save_poll') );
add_action( 'wp_ajax_update_poll', array('Weblator_Polling_Ajax','update_poll') );
add_action( 'wp_ajax_delete_poll', array('Weblator_Polling_Ajax','delete_poll') );
add_action( 'wp_ajax_chart_style_options', array('Weblator_Polling_Ajax','chart_style_options') );

add_action( 'wp_ajax_save_vote', array( 'Weblator_Public_Ajax', 'save_vote' ) );
add_action( 'wp_ajax_nopriv_save_vote', array( 'Weblator_Public_Ajax', 'save_vote' ) );
add_action( 'wp_ajax_chart_data', array( 'Weblator_Public_Ajax', 'get_chart_data' ) );
add_action( 'wp_ajax_nopriv_chart_data', array( 'Weblator_Public_Ajax', 'get_chart_data' ) );
add_action( 'wp_ajax_has_voted', array( 'Weblator_Public_Ajax', 'load_poll' ) );
add_action( 'wp_ajax_nopriv_has_voted', array( 'Weblator_Public_Ajax', 'load_poll' ) );
add_action( 'wp_ajax_result_action', array( 'Weblator_Public_Ajax', 'result_view' ) );
add_action( 'wp_ajax_nopriv_result_action', array( 'Weblator_Public_Ajax', 'result_view' ) );

//This solves the wp_redirect header problem
function app_output_buffer() {
    ob_start();
}
add_action('init', 'app_output_buffer');

ob_start();

if (!function_exists('array_column')) {
    function array_column($input, $column_key, $index_key = null)
    {
        if ($index_key !== null) {
            // Collect the keys
            $keys = array();
            $i = 0; // Counter for numerical keys when key does not exist

            foreach ($input as $row) {
                if (array_key_exists($index_key, $row)) {
                    // Update counter for numerical keys
                    if (is_numeric($row[$index_key]) || is_bool($row[$index_key])) {
                        $i = max($i, (int) $row[$index_key] + 1);
                    }

                    // Get the key from a single column of the array
                    $keys[] = $row[$index_key];
                } else {
                    // The key does not exist, use numerical indexing
                    $keys[] = $i++;
                }
            }
        }

        if ($column_key !== null) {
            // Collect the values
            $values = array();
            $i = 0; // Counter for removing keys

            foreach ($input as $row) {
                if (array_key_exists($column_key, $row)) {
                    // Get the values from a single column of the input array
                    $values[] = $row[$column_key];
                    $i++;
                } elseif (isset($keys)) {
                    // Values does not exist, also drop the key for it
                    array_splice($keys, $i, 1);
                }
            }
        } else {
            // Get the full arrays
            $values = array_values($input);
        }

        if ($index_key !== null) {
            return array_combine($keys, $values);
        }

        return $values;
    }

}