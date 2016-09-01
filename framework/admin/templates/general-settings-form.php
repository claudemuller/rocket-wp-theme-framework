<?php
/**
 * general-settings-form.php
 *
 * The template file for the general settings form
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<div class="wrap">
    <h1><?php _e( 'General Settings Page', 'rocket' ); ?></h1>

    <?php settings_errors(); ?>

    <form action="options.php" method="post" enctype="multipart/form-data">
        <?php
        settings_fields( 'rocket-settings-page' );
        do_settings_sections( 'rocket-settings-page' );
        submit_button();
        ?>
    </form>
</div>
