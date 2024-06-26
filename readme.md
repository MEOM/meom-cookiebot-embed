# MEOM Cookiebot embed

When using Cookiebot, for example Youtube videos might be blocked by Cookiebot

This plugin adds placeholder text and link to Cookiebot settings where user can accept marketing cookies.

> Please accept marketing-cookies to watch this video.

After accepting marketing cookies, video will show up.

## Installation

Note that composer package install this plugin as must-use plugin in `mu-plugins` folder.

Use Composer to install the package.

```bash
composer require meom/meom-cookiebot-embed
```

Or if living on the edge:

```bash
composer require meom/meom-cookiebot-embed:dev-main
```

## Styles

This plugin doesn't output any styles. Example styles for your theme styles:

```css
.wp-block-embed__cookiebot-message {
    aspect-ratio: 16 / 9;
    background-color: #f2f2f2;
    display: grid;
    padding: 1rem;
    place-items: center;
    text-align: center;
}
```

## Filters

By default this plugin adds Cookiebot placeholder text only for Video embed block.

This condition can be changed with `meom_cookiebot_embed_condition` filter.

Code example for adding placeholder text for Youtube and Vimeo videos:

```php
/**
 * Change condition when to show Cookiebot message.
 *
 * @param string $condition     Condition.
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function my_prefix_cookiebot_embed_condition( $condition, $block_content, $block ) {
    $condition = 'core/embed' === $block['blockName'] && ( 'youtube' === $block['attrs']['providerNameSlug'] || 'vimeo' === $block['attrs']['providerNameSlug'] );

    return $condition;
}
add_filter( 'meom_cookiebot_embed_condition', 'my_prefix_cookiebot_embed_condition', 10, 3 );
```

Default placeholder text is `Oops! This video will not be shown because you have disabled the marketing cookies. To see the video, <a href="%s">accept marketing cookies</a>.`. Code example for changing that message:

```php
/**
 * Filters the placeholder text added to the embed block.
 *
 * @param string $text Placeholder text.
 */
function my_prefix_cookiebot_placeholder_text( $text ) {
    $text = __( 'Oops! This embed will not be shown because you have disabled the marketing cookies. To see the embed, <a href="%s">accept marketing cookies</a>.', 'kala' );
    return $text;
}
add_filter( 'meom_cookiebot_placeholder_text', 'my_prefix_cookiebot_placeholder_text' );
``
