<?php
/**
 * Filters manipulating WP embed blocks.
 *
 * @package MEOM Cookiebot Embed;
 */

namespace MEOM\CookiebotEmbed;

/**
 * Add Cookiebot embed text.
 *
 * @param string $block_content  The block content about to be appended.
 * @param array  $block          The full block, including name and attributes.
 *
 * @return string The block contents, rendered (or altered).
 */
function render_block( $block_content, $block ) {
    if ( 'core/embed' === $block['blockName'] ) {
        $cookie_text  = '<div class="wp-block-embed__cookiebot-message cookieconsent-optout-marketing">';
        $cookie_text .= __( 'Please <a href="javascript:Cookiebot.renew()">accept marketing-cookies</a> to watch this video.', 'meom-cookiebot-embed' );
        $cookie_text .= '</div>';

        $block_content = str_replace( '</figure>', $cookie_text . '</figure>', $block_content );
    }

    return $block_content;
}
add_filter( 'render_block', __NAMESPACE__ . '\render_block', 10, 2 );

