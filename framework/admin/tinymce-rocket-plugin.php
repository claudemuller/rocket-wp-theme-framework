<?php
/**
 * tinymce-rocket-plugin.php
 *
 * The shortcode code
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php

/**
 * The Drop Caps shortcode styles
 */
function rocket_drop_caps_styles() {
    echo <<< STYLE
<style type="text/css">
        .dropcap {
            float: left;
            font-size: 80px;
            padding-right: 7px;
            line-height: 72px;
        }
    </style>
STYLE;
}
add_action( 'wp_head', 'rocket_drop_caps_styles' );


// Registering a new TinyMCE plugin
/**
 * @TODO
 */
function rocket_tinymce_buttons() {
    // Used to hook the plugin to TinyMCE
    add_filter( 'mce_external_plugins', 'rocket_add_tinymce_buttons' );
    add_filter( 'mce_buttons', 'rocket_register_tinymce_buttons' );
}
add_action( 'init', 'rocket_tinymce_buttons' );

/**
 * Register plugin .js with WP
 *
 * @params $plugin_array array the TinyMCE plugins
 * @return           array the modified TinyMCE plugins array
 */
function rocket_add_tinymce_buttons( $plugin_array ) {
    // Pass plugin id and absolute url to the .js file
    $plugin_array['rocket'] = get_template_directory_uri() . '/js/shortcodes.js';

    return $plugin_array;
}

/**
 * Register the individual buttons
 *
 * @params $buttons array the buttons array
 * @return          array the modified buttons array
 */
function rocket_register_tinymce_buttons( $buttons ) {
    // Which buttons to show using there id values
    array_push( $buttons, 'dropcap', 'showrecent' );

    return $buttons;
}
