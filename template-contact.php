<?php
/*
 * template-contact.php
 *
 * Template Name: Contact Page
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
$errors = array();
$isError = false;

$errorName = __( 'Please enter your name', 'rocket' );
$errorEmail = __( 'Please enter a valid email address', 'rocket' );
$errorMessage = __( 'Please enter a message', 'rocket' );

// Get the posted variables and validate them
if ( isset( $_POST['is-submitted'] ) ) {
    $name = $_POST['cName'];
    $email = $_POST['cEmail'];
    $message = $_POST['cMessage'];

    // Check the name
    if ( ! rocket_validate_length( $name, 2 ) ) {
        $isError             = true;
        $errors['errorName'] = $errorName;
    }

    // Check the email
    if ( ! is_email( $email ) ) {
        $isError             = true;
        $errors['errorEmail'] = $errorEmail;
    }

    // Check the message
    if ( ! rocket_validate_length( $message, 2 ) ) {
        $isError                = true;
        $errors['errorMessage'] = $errorMessage;
    }

    // If there's no error, send mail
    if ( ! $isError ) {
        // Get admin email
        $emailReceiver = get_option( 'admin_email' );

        $emailSubject = sprintf( __( 'You have been contacted by %s', 'rocket' ), $name );

        $emailBody = sprintf( __( 'You have been contacted by %1$s. Their message is: ', 'rocket' ), $name) . PHP_EOL . PHP_EOL;
        $emailBody .= $message . PHP_EOL . PHP_EOL;
        $emailBody .= sprintf( __( 'You can contact %1$s via email at %2$s', 'rocket' ), $name, $email );
        $emailBody .= PHP_EOL . PHP_EOL;

        $emailHeaders[] = "Reply-To: $email" . PHP_EOL;

        $emailIsSent = wp_mail( $emailReceiver, $emailSubject, $emailBody, $emailHeaders );
    }
}
?>

<?php get_header(); ?>

<div class="main-content col-md-8" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Article header -->
            <header class="entry-header">
                <?php
                // If the post has a thumbnail and it's not password protected then display the thumbnail
                if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                    <figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
                <?php endif; ?>

                <h1><?php the_title(); ?></h1>
            </header> <!-- /.entry-header -->

            <!-- Article content -->
            <div class="entry-content">
                <?php if ( isset( $emailIsSent ) && $emailIsSent ) : ?>
                    <div class="alert alert-success">
                        <?php _e( 'Your message has been successfully sent, thank you!', 'rocket' ); ?>
                    </div> <!-- /.alert -->
                <?php else: ?>

                    <?php the_content(); ?>

                    <?php if ( isset( $isError ) && $isError ) : ?>
                        <div class="alert alert-danger">
                            <?php _e( 'Sorry, it seems there was an error.', 'rocket' ); ?>
                        </div> <!-- /.alert -->
                    <?php endif; ?>
                <?php endif; ?>

                <form id="contact-form" action="<?php the_permalink(); ?>" method="POST" role="form">
                    <div class="form-group <?php if ( isset ( $errors['errorName'] ) ) echo 'has-error'; ?>">
                        <label class="control-label" for="contact-name"><span class="required">* </span><?php _e( 'Name:', 'rocket' ); ?></label>
                        <input class="form-control" id="contact-name" name="cName" type="text" value="<?php if ( isset( $_POST['cName'] ) ) { echo $_POST['cName']; } ?>"/>
                        <?php if ( isset( $errors['errorName'] ) ) : ?>
                            <p class="help-block"><?php echo $errors['errorName']; ?></p>
                        <?php endif; ?>
                    </div> <!-- /.form-group -->

                    <div class="form-group <?php if ( isset ( $errors['errorEmail'] ) ) echo 'has-error'; ?>">
                        <label class="control-label" for="contact-email"><span class="required">* </span><?php _e( 'Email:', 'rocket' ); ?></label>
                        <input class="form-control" id="contact-email" name="cEmail" type="text" value="<?php if ( isset( $_POST['cEmail'] ) ) { echo $_POST['cEmail']; } ?>"/>
                        <?php if ( isset( $errors['errorEmail'] ) ) : ?>
                            <p class="help-block"><?php echo $errors['errorEmail']; ?></p>
                        <?php endif; ?>
                    </div> <!-- /.form-group -->

                    <div class="form-group <?php if ( isset ( $errors['errorMessage'] ) ) echo 'has-error'; ?>">
                        <label class="control-label" for="contact-message"><span class="required">* </span><?php _e( 'Message:', 'rocket' ); ?></label>
                        <textarea class="form-control" id="contact-message" name="cMessage"><?php if ( isset( $_POST['cMessage'] ) ) { echo $_POST['cMessage']; } ?></textarea>
                        <?php if ( isset( $errors['errorMessage'] ) ) : ?>
                            <p class="help-block"><?php echo $errors['errorMessage']; ?></p>
                        <?php endif; ?>
                    </div> <!-- /.form-group -->

                    <input type="hidden" name="is-submitted" id="is-submitted" value="true">

                    <button class="btn btn-default" type="submit"><?php _e( 'Send Message', 'rocket'); ?></button>
                </form>
            </div>
        </article>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>
