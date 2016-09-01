<?php
/**
 * meta-boxes.php
 *
 * Products custom post type meta boxes
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_cpt_product_create_meta_box' ) ) {
    /**
     * Create the product meta boxes
     *
     * @param $post_type string the custom post type
     * @param $post      object the post object
     */
    function rocket_cpt_product_create_meta_box( $post_type, $post ) {
        $unique_identifier = 'rocket_product_price_meta_box';
        $title = __( 'Product price', 'rocket' );
        $meta_box_renderer = 'rocket_product_price_meta_box_content';
        $custom_post_type = 'product';
        $placement = 'side';
        $priority = 'high';

        add_meta_box(
            $unique_identifier,
            $title,
            $meta_box_renderer,
            $custom_post_type,
            $placement,
            $priority
        );
    }

    add_action( 'add_meta_boxes', 'rocket_cpt_product_create_meta_box', 10, 2 );
}

if ( ! function_exists( 'rocket_product_price_meta_box_content' ) ) {
    /**
     * Display the meta box
     *
     * @param $post object post object
     */
    function rocket_product_price_meta_box_content( $post ) {
        wp_nonce_field( basename( __FILE__ ), 'product_price_meta_box_content_nonce' );
        echo '<label for="product_price"></label>';
        echo '<input type="text" id="product_price" name="product_price" placeholder="Enter a price" value="', get_post_meta( $post->ID, 'product_price', true ), '" />';
    }
}

if ( ! function_exists( 'rocket_product_price_meta_box_save' ) ) {
    /**
     * Handle the meta field on post save
     *
     * @param $post_id integer the current post id
     */
    function rocket_product_price_meta_box_save( $post_id, $post ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( isset( $_POST['product_price_meta_box_content_nonce'] ) && ! wp_verify_nonce( $_POST['product_price_meta_box_content_nonce'], basename( __FILE__ ) ) ) {
            return;
        }

        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

        if ( isset( $_POST['product_price'] ) ) {
            $product_price = $_POST['product_price'];
            update_post_meta( $post_id, 'product_price', $product_price );
        }
    }

    add_action( 'save_post', 'rocket_product_price_meta_box_save', 10, 2 );
}
