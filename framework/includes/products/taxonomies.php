<?php
/**
 * taxonomies.php
 *
 * Products custom post type taxonomies
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_cpt_product_taxonomies' ) ) {
    /**
     * Create product custom post type taxonomies
     */
    function rocket_cpt_product_taxonomies() {
        $labels = array(
            'name'              => _x( 'Product Categories', 'taxonomy general name' ),
            'singular_name'     => _x( 'Product Category', 'taxonomy singular name' ),
            'search_items'      => __( 'Search Product Categories' ),
            'all_items'         => __( 'All Product Categories' ),
            'parent_item'       => __( 'Parent Product Category' ),
            'parent_item_colon' => __( 'Parent Product Category:' ),
            'edit_item'         => __( 'Edit Product Category' ),
            'update_item'       => __( 'Update Product Category' ),
            'add_new_item'      => __( 'Add New Product Category' ),
            'new_item_name'     => __( 'New Product Category' ),
            'menu_name'         => __( 'Product Categories' ),
        );

        $args = array(
            'labels'       => $labels,
            'hierarchical' => true,
        );

        register_taxonomy( 'product_category', 'product', $args );
    }

    add_action( 'init', 'rocket_cpt_product_taxonomies', 0 );
}
