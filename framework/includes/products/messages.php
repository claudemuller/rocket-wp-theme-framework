<?php
/**
 * messages.php
 *
 * Custom messages for the product custom post type
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_cpt_product_update_messages' ) ) {
    /**
     * Custom messages for the product custom post type
     */
    function rocket_cpt_product_update_messages() {
        global $post, $post_ID;

        $messages['product'] = array(
            0  => '',
            1  => sprintf( __( 'Product updated. <a href="%s">View product</a>'), esc_url( get_permalink( $post_ID ) ) ),
            2  => __( 'Custom field updated.' ),
            3  => __( 'Custom field deleted.' ),
            4  => __( 'Product updated.' ),
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Product restored to revision from %s' ), wp_post_revision_title( ( int ) $_GET['revision'], false ) ) : false,
            6  => sprintf( __( 'Product published. <a href="%s">View product</a>'), esc_url( get_permalink( $post_ID ) ) ),
            7  => __( 'Product saved.' ),
            8  => sprintf( __( 'Product submitted. <a target="_blank" href="%s">Preview product</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
            9  => sprintf( __( 'Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
            10 => sprintf( __( 'Product draft updated. <a target="_blank" href="%s">Preview product</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
        );

        return $messages;
    }

    add_action( 'post_updated_messages', 'rocket_cpt_product_update_messages' );
}
