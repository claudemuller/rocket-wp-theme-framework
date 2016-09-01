<?php
/**
 * contact-settings-form.php
 *
 * The template file for the contact settings form
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<div class="wrap">
    <h1><?php _e( 'Contact Settings Page', 'rocket' ); ?></h1>

    <?php settings_errors(); ?>

    <form action="options.php" method="post">
        <?php
        settings_fields( 'rocket-settings-contact-page' );
        do_settings_sections( 'rocket-settings-contact-page' );
        submit_button();
        ?>
    </form>
</div>
