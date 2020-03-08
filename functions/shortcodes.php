<?php
/*-----------------------------------------------------------------------------------*/
/* Shortcodes
/*-----------------------------------------------------------------------------------*/

// Site URL
// Usage: [url]
function basetheme_shortcode_site_url($atts, $content = null) {
 return get_bloginfo('url');
}
add_shortcode('url', 'basetheme_shortcode_site_url');

// Theme URL
// Usage: [theme]
function basetheme_shortcode_theme_url($atts, $content = null) {
 return get_bloginfo('template_url');
}
add_shortcode('theme', 'basetheme_shortcode_theme_url');

// Permalink
// Usage: [permalink id=49]
function basetheme_permalink($atts) {
 extract(shortcode_atts(array(
     'id' => 1,
     'text' => ""
 ), $atts));

 if ($text) {
     $url = get_permalink($id);
     return "<a href='$url'>$text</a>";
 } else {
     return get_permalink($id);
 }
}
add_shortcode('permalink', 'basetheme_permalink');
