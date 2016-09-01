<?php
/**
 * template-full-width.php
 *
 * Template Name: Full Width Page
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php get_header(); ?>

<div class="main-content medium-12 columns" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Article header -->
            <header class="entry-header">
                <?php // If the post has a thumbnail and it's not password protected then display the thumbnail
                if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                    <figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
                <?php endif; ?>

                <h1><?php the_title(); ?></h1>
            </header> <!-- /.entry-header -->

            <!-- Article content -->
            <div class="entry-content">
                <?php the_content(); ?>

                <?php wp_link_pages(); ?>
            </div> <!-- /.entry-content -->

            <!-- Article footer -->
            <footer class="entry-footer">
               <?php
                if ( is_user_logged_in() ) {
                    echo '<p>';
                    edit_post_link( __( 'Edit', 'rocket' ), '<span class="meta-edit">', '</span>' );
                    echo '</p>';
                }
                ?>
            </footer>
        </article>

        <?php comments_template(); ?>
    <?php endwhile; ?>
</div> <!-- /.main-content -->

<?php get_footer(); ?>
