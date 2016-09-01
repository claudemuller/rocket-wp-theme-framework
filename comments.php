<?php
/**
 * comments.php
 *
 * The template for displaying comments
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
// Prevent the direct loading of comments.php
if ( ! empty( $_SERVER['SCRIPT-FILENAME'] ) && basename( $_SERVER['SCRIPT-FILENAME'] ) == 'comments.php' ) {
    die( __( 'You cannot access this page directly.', 'rocket' ) );
}
?>

<?php
// if the post is password protected, display info text and return
if ( post_password_required() ) :
?>
    <p>
        <?php
        _e( 'This post is password protected, Enter the password to view the comments.', 'rocket' );

        return;
        ?>
    </p>
<?php endif; ?>

<!-- Comments area -->
<div class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'Comment title', 'rocket' ), number_format_i18n( get_comments_number() ) ); ?>
        </h2> <!-- /.comments-title -->

        <ol class="comments">
            <?php wp_list_comments(); ?>
        </ol> <!-- /.comments -->

        <?php
        // If the comments are paginated, display the controls
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
            <nav class="comment-nav" role="navigation">
                <p class="comment-nav-prev">
                    <?php previous_comments_link( __( '&larr; Older Comments', 'rocket' ) ); ?>
                </p>

                <p class="comment-nav-next">
                    <?php next_comments_link( __( 'Newer Comments &rarr;', 'rocket' ) ); ?>
                </p>
            </nav> <!-- /.comment-nav -->
        <?php endif; ?>

        <?php
        // If the comments are closed, display an info text
        if ( ! comments_open() && get_comments_number() ) :
        ?>
            <p class="no-comments">
                <?php _e( 'Comments are closed', 'rocket' ); ?>
            </p>
        <?php endif; ?>

        <?php comment_form(); ?>

    <?php endif; ?>
</div> <!-- /.comments-area -->
