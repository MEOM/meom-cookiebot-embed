# MEOM Cookiebot embed

When using Cookiebot, for example Youtube videos might be blocked by Cookiebot

This plugin adds placeholder text and link to Cookiebot settings where user can accept marketing cookies.

> Please accept marketing-cookies to watch this video.

After accepting marketing cookies, video will show up.

## Styles

This plugin doesn't output any styles. Here is one example what you add to your theme styles:

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
