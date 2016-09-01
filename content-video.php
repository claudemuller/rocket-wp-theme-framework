<?php
/**
 * content-video.php
 *
 * The default template for displaying posts with the Video post format
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
        <?php the_content( __( 'Continue reading &rarr;', 'rocket' ) ); ?>
        <?php wp_link_pages(); ?>
    </div> <!-- /.entry-content -->

    <!-- Article footer -->
    <footer class="entry-footer">
        <?php if ( is_single() && get_the_author_meta( 'description' ) ) : ?>
            <h2><?php echo __( 'Written by ', 'rocket' ) . get_the_author(); ?></h2>
            <p><?php the_author_meta( 'description' ); ?></p>
       <?php endif; ?>
    </footer> <!-- /.entry-footer -->
</article>
