<?php
/**
 * search.php
 *
 * The template for displaying search results
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php get_header(); ?>

<div class="main-content medium-8 columns" role="main">
    <?php if ( have_posts() ) : ?>
        <header class="page-header">
            <h1>
                <?php printf( __( 'Search Results for &quot;%s&quot;', 'rocket' ), get_search_query() ); ?>
            </h1>
        </header>

        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', get_post_format() ); ?>
        <?php endwhile; ?>

        <?php rocket_paging_nav(); ?>

    <?php else: ?>
        <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>
</div> <!-- /.main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
