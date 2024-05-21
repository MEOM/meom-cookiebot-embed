<?php
/**
 * Plugin name: MEOM Cookiebot embed
 * Author: MEOM
 * Author URI: https://www.meom.fi/
 * Description: Replace embeds with notice if videos are blocked by Cookiebot.
 * Version: 1.1.1
 * License: GPL2 or later.
 * Text Domain: meom-cookiebot-embed
 * Domain Path: /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load text domain.
function meom_cookiebot_embed_i18n() {
    load_muplugin_textdomain( 'meom-cookiebot-embed', trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) . 'languages' );

}
add_action( 'plugins_loaded', 'meom_cookiebot_embed_i18n', 2 );

require_once dirname( __FILE__ ) . '/inc/filters.php';
