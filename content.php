<?php
/**
 * content.php
 *
 * The default template for displaying content
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- Article header -->
    <header class="entry-header">
        <?php // If the post has a thumbnail and it's not password protected then display the thumbnail
        if ( has_post_thumbnail() && ! post_password_required() ) : ?>
            <figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
        <?php endif; ?>
        <?php // If single page, display the title, else display the title in a link
        if ( is_single() ) : ?>
            <h1><?php the_title(); ?></h1>
        <?php else: ?>
            <h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php endif; ?>

        <p class="entry-meta">
            <?php // Display the meta information
            rocket_post_meta();
            ?>
        </p>
    </header> <!-- /.entry-header -->

    <!-- Article content -->
    <div class="entry-content">
        <?php
        if ( is_search() ) {
            the_excerpt();
        } else {
            the_content( __( 'Continue reading &rarr;', 'rocket' ) );
            wp_link_pages();
        }
        ?>
    </div> <!-- /.entry-content -->

    <!-- Article footer -->
    <footer class="entry-footer">
        <?php if ( is_single() && get_the_author_meta( 'description' ) ) : ?>
            <h2><?php echo __( 'Written by ', 'rocket' ) . get_the_author(); ?></h2>
            <p><?php the_author_meta( 'description' ); ?></p>
       <?php endif; ?>
    </footer>
</article>
