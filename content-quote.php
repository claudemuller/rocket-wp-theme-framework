<?php
/**
 * content-quote.php
 *
 * The default template for displaying posts with the Quote post format
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- Article content -->
    <div class="entry-content">
        <?php the_content( __( 'Continue reading &rarr;', 'rocket' ) ); ?>
        <?php wp_link_pages(); ?>
    </div> <!-- /.entry-content -->

    <!-- Article footer -->
    <footer class="entry-footer">
        <p class="entry-meta">
            <?php // Display the meta information
            rocket_post_meta();
            ?>
        </p>
    </footer> <!-- /.entry-footer -->
</article>
