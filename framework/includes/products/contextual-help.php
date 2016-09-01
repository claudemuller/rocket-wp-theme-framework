<?php
/**
 * contextual-help.php
 *
 * Contextual help for the product custom post type
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_cpt_product_contextual_help' ) ) {
    /**
     * Contextual help for the product custom post type
     */
    function rocket_cpt_product_contextual_help( $contextual_help, $screen_id, $screen ) {
        if ( 'product' == $screen->id ) {
            $contextual_help = '<h2>Products</h2>
                <p>Products show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p>
                <p>You can view/edit the details of each product by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';
        } elseif ( 'edit-product' == $screen->id ) {
            $contextual_help = '<h2>Editing products</h2>
                <p>This page allows you to view/modify product details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';
        }

        return $contextual_help;
    }

    add_action( 'contextual_help', 'rocket_cpt_product_contextual_help', 10, 3 );
}
