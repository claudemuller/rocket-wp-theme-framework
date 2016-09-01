<?php
/**
 * author.php
 *
 * The template for displaying author archive pages
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php get_header(); ?>

<div class="main-content large-8" role="main">
    <?php if ( have_posts() ) : the_post(); ?>
        <header class="page-header">
            <h1><?php printf( __( 'All posts by %s.', 'rocket' ), get_the_author() ); ?></h1>

            <?php
            // If the author biography exists, display it
            if ( get_the_author_meta( 'description' ) ) {
                echo '<p>' . the_author_meta( 'description' ) . '</p>';
            }
            ?>

            <?php rewind_posts(); ?>
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
