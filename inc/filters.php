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
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 *
 * @return string The block contents, rendered (or altered).
 */
function render_block( $block_content, $block ) {
    /**
     * Filters the condition when to add Cookiebot message to the embed block.
     *
     * @param string $condition     Condition.
     * @param string $block_content The block content about to be appended.
     * @param array  $block         The full block, including name and attributes.
     */
    $condition = apply_filters( 'meom_cookiebot_embed_condition', 'core/embed' === $block['blockName'] && 'youtube' === $block['attrs']['providerNameSlug'], $block_content, $block );

    if ( $condition ) {
        /**
         * Filters the placeholder text added to the embed block.
         *
         * @param string $text Text.
         */
        $text = apply_filters( 'meom_cookiebot_placeholder_text', __( 'Oops! This video will not be shown because you have disabled the marketing cookies. To see the video, <a href="%s">accept marketing cookies</a>.', 'meom-cookiebot-embed' ) );

        $cookie_text  = '<div class="wp-block-embed__cookiebot-message cookieconsent-optout-marketing"><p>';
        $cookie_text .= sprintf( $text, 'javascript:Cookiebot.renew()' );
        $cookie_text .= '</p></div>';

        $block_content = str_replace( 'src=', 'data-cookieconsent="marketing" data-cookieblock-src=', $block_content );

        // If there is <figcaption>, add the cookie text before it.
        $figcaption_check = strpos( $block_content, '<figcaption' );
        if ( false !== $figcaption_check ) {
            $block_content = str_replace( '<figcaption', $cookie_text . '<figcaption', $block_content );
        } else {
            $block_content = str_replace( '</figure>', $cookie_text . '</figure>', $block_content );
        }
    }

    return $block_content;
}
add_filter( 'render_block', __NAMESPACE__ . '\render_block', 10, 2 );

