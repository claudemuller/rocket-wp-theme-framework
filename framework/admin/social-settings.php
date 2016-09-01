<?php
/**
 * social-settings.php
 *
 * Functions for the social settings section
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_create_social_settings' ) ) {
    /**
     * Register the social settings
     */
    function rocket_create_social_settings() {
        // Create facebook setting
        $section_group = 'rocket-settings-social-page';  // settings group and page slug are the same
        $setting_name  = 'rocket_setting_facebook';

        register_setting( $section_group, $setting_name );

        // Create section of page
        $settings_section = 'rocket-settings-social-section';
        $page = $section_group;
        $section_title = __( 'Social Settings', 'rocket' );
        $output_callback = 'rocket_setting_display_social_section';

        add_settings_section( $settings_section, $section_title, $output_callback, $page );

        // Add facebook field to the section
        $setting_title = __( 'Facebook Url', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_facebook';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);
    }

    add_action( 'admin_init', 'rocket_create_social_settings' );
}

if ( ! function_exists( 'rocket_setting_display_social_section' ) ) {
    /**
     * Display social section
     */
    function rocket_setting_display_social_section() {
        // echo '<h2>' . __( 'Social Section', 'rocket' ) . '</h2>';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_facebook' ) ) {
    /**
     * Display the facebook setting input
     */
    function rocket_setting_display_setting_facebook() {
        echo '<input type="text" name="rocket_setting_facebook" value="' . esc_attr( get_option( 'rocket_setting_facebook' ) ) . '" />';
    }
}
