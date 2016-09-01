<?php
/**
 * archive.php
 *
 * The template for displaying archive pages
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php get_header(); ?>

<div class="main-content large-8 columns" role="main">
    <?php if ( have_posts() ) : ?>
        <header class="page-header">
            <h1>
                <?php
                if ( is_day() ) {
                    printf( __( 'Daily Archives for %s', 'rocket' ), get_the_date() );
                } elseif ( is_month() ) {
                    printf( __( 'Monthly Archives for %s', 'rocket' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'rocket' ) ) );
                } elseif ( is_year() ) {
                    printf( __( 'Yearly Archives for %s', 'rocket' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'rocket' ) ) );
                } else {
                    _e( 'Archives', 'rocket' );
                }
                ?>
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
