<?php
/**
 * custom-table-headers.php
 *
 * Products custom post type table header columns
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_cpt_product_custom_headers_columns' ) ) {
    /**
     * Setup custom table header columns
     *
     * @param  $columns array the table header columns
     * @return          array the altered table header columns
     */
    function rocket_cpt_product_custom_headers_columns( $columns ) {
        $date = $columns['date'];
        unset( $columns['date'] );
        $comments = $columns['comments'];
        unset( $columns['comments'] );

        $columns['price'] = __( 'Price', 'rocket' );
        $columns['category'] = __( 'Category', 'rocket' );
        $columns['comments'] = $comments;
        $columns['date'] = $date;

        return $columns;
    }

    add_action( 'manage_edit-product_columns', 'rocket_cpt_product_custom_headers_columns' );
}

if ( ! function_exists( 'rocket_cpt_product_custom_headers_columns_content' ) ) {
    /**
     * Display the contents of the custom column headers
     *
     * @param $column_name string  the column name being processed
     * @param $post_id     integer the post id of the current post
     */
    function rocket_cpt_product_custom_headers_columns_content( $column_name, $post_id ) {
        if ( 'category' == $column_name ) {
            $terms = get_the_terms( $post_id, 'product_category' );

            echo ! empty( $terms ) ? $terms[0]->name : '<em>' . __( 'undefined', 'rocket' ) . '</em>';
        }

        if ( 'price' == $column_name ) {
            $price = get_post_meta( $post_id, 'product_price', true );
            echo number_format( (float)$price, 2, '.', ' ' );
        }
    }

    add_action( 'manage_product_posts_custom_column', 'rocket_cpt_product_custom_headers_columns_content', 10, 2 );
}

if ( ! function_exists( 'rocket_cpt_product_custom_header_columns_sorting' ) ) {
    /**
     * Setup sortable columns
     *
     * @param  $columns array the table header columns
     * @return          array the altered table header columns
     */
    function rocket_cpt_product_custom_header_columns_sorting( $columns ) {
        $columns['category'] = 'category';
        $columns['price'] = 'price';

        return $columns;
    }

    add_filter( 'manage_edit-product_sortable_columns', 'rocket_cpt_product_custom_header_columns_sorting' );
}

if ( ! function_exists( 'rocket_cpt_product_custom_headers_columns_orderby' ) ) {
    /**
     * Alter query for columns
     *
     * @param $vars array vars array
     * @return      array altered vars array
     */
    function rocket_cpt_product_custom_headers_columns_orderby( $vars ) {
        if ( ! is_admin() ) {
            return;
        }

        if (isset($wp_query->query['orderby']) && 'category' == $wp_query->query['orderby']) {

            $vars['join'] .= <<< SQL
            term_relationships} ON {$wpdb->posts}.ID={$wpdb->term_relationships}.object_id
LEFT OUTER JOIN {$wpdb->term_taxonomy} USING (term_taxonomy_id)
LEFT OUTER JOIN {$wpdb->terms} USING (term_id)
SQL;

            $vars['where'] .= " AND (taxonomy = 'product_category' OR taxonomy IS NULL)";
            $vars['groupby'] = "object_id";
            $vars['orderby'] = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC) ";
            $vars['orderby'] .= ( 'ASC' == strtoupper($wp_query->get('order')) ) ? 'ASC' : 'DESC';
        }

        if ( isset( $vars['orderby'] ) && 'price' == $vars['orderby'] ) {
            $vars = array_merge( $vars, array(
                'meta_key' => 'product_price',
                'orderby'  => 'meta_value',
            ) );
        }

        return $vars;
    }

    add_action( 'posts_orderby', 'rocket_cpt_product_custom_headers_columns_orderby' );
}
