<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Not Found)
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php get_header(); ?>

<div class="container-404">
    <h1><?php _e( 'Error 404 - Nothing Found', 'rocket' ); ?></h1>
    <p><?php _e( 'It looks like nothing was found here. Maybe try search?', 'rocket' ); ?></p>
    <?php get_search_form(); ?>
</div> <!-- /.container-404 -->

<?php get_footer(); ?>
