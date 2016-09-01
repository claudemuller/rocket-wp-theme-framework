<?php
/**
 * shortcodes.php
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
 * Shortcode to display the recent posts
 *
 * @param  $atts array  an array with all the attributes
 * @return       string generated markup
 */
function rocket_recent_posts_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'numbers' => '5',
    ), $atts ) );

    $rposts = new WP_Query( array( 'posts_per_page' => $numbers, 'orderby' => 'date' ) );

    if ( $rposts->have_posts() ) {
        $html = '<h3>Recent Posts</h3><ul class="recent-posts">';

        while( $rposts->have_posts() ) {
            $rposts->the_post();
            $html .= sprintf(
                '<li><a href="%s" title="%s">%s</a></li>',
                get_permalink($rposts->post->ID),
                get_the_title(),
                get_the_title()
            );
        }

        $html .= '</ul>';
    }

    wp_reset_query();

    return $html;
}
add_shortcode( 'recent-post', 'rocket_recent_posts_shortcode' );
