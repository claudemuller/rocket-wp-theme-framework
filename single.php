<?php
/**
 * single.php
 *
 * The template for displaying single posts
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php get_header(); ?>

<div class="main-content medium-8 columns" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', get_post_format() ); ?>

        <?php comments_template(); ?>
    <?php endwhile; ?>
</div> <!-- /.main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
