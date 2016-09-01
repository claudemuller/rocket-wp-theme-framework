<?php
/**
 * functions.php
 *
 * Products custom post type
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_custom_post_type_product' ) ) {
    /**
     * Create a 'product' custom post type
     */
    function rocket_custom_post_type_product() {
        $labels = array(
            'name'               => _x( 'Products', 'post type general name' ),
            'singular_name'      => _x( 'Product', 'post type singular name' ),
            'add_new'            => _x( 'Add New', 'product' ),
            'add_new_item'       => __( 'Add New Product' ),
            'edit_item'          => __( 'Edit Product' ),
            'new_item'           => __( 'New Product' ),
            'all_items'          => __( 'All Products' ),
            'view_item'          => __( 'View Product' ),
            'search_items'       => __( 'Search Products' ),
            'not_found'          => __( 'No products found' ),
            'not_found_in_trash' => __( 'No products found in the Trash' ),
            'parent_item_colon'  => '',
            'menu_name'          => 'Products',
        );

        $args = array(
            'labels'        => $labels,
            'description'   => 'Holds products and product specific data',
            'public'        => true,
            'menu_position' => 5,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
            'has_archive'   => true,
        );

        register_post_type( 'product', $args );
    }

    add_action( 'init', 'rocket_custom_post_type_product' );
}

// Include product taxonomies
require __DIR__ . '/taxonomies.php';

// Include product meta boxes
require __DIR__ . '/meta-boxes.php';

// Include product custom table headers
require __DIR__ . '/custom-table-headers.php';

// Include product custom messages
require __DIR__ . '/messages.php';

// Include product contextual help
require __DIR__ . '/contextual-help.php';
