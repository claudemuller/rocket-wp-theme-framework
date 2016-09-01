<?php
/**
 * social-settings-form.php
 *
 * The template file for the social settings form
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<div class="wrap">
    <h1><?php _e( 'Social Settings Page', 'rocket' ); ?></h1>

    <?php settings_errors(); ?>

    <form action="options.php" method="post">
        <?php
        settings_fields( 'rocket-settings-social-page' );
        do_settings_sections( 'rocket-settings-social-page' );
        submit_button();
        ?>
    </form>
</div>
