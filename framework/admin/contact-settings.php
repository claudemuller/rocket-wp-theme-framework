<?php
/**
 * contact-settings.php
 *
 * Functions for the contact settings section
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_create_contact_settings' ) ) {
    /**
     * Register the contact settings
     */
    function rocket_create_contact_settings() {
        /**-----------------------------------------------------------**
         * Address setting field                                       *
         **-----------------------------------------------------------**/
        // Create address setting
        $section_group = 'rocket-settings-contact-page';  // settings group and page slug are the same
        $setting_name  = 'rocket_setting_address';

        register_setting( $section_group, $setting_name );

        // Create section of page
        $settings_section = 'rocket-settings-contact-section';
        $page = $section_group;
        $section_title = __( 'Contact Settings', 'rocket' );
        $output_callback = 'rocket_setting_display_contact_section';

        add_settings_section( $settings_section, $section_title, $output_callback, $page );

        // Add address field to the section
        $setting_title = __( 'Address', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_address';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);

        /**-----------------------------------------------------------**
         * Phonenumber setting field                                   *
         **-----------------------------------------------------------**/
        // Create phonenumber setting
        $setting_name  = 'rocket_setting_phonenumber';

        register_setting( $section_group, $setting_name );

        // Add phonenumber field to the section
        $setting_title = __( 'Phone Number', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_phonenumber';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);

        /**-----------------------------------------------------------**
         * Email setting field                                   *
         **-----------------------------------------------------------**/
        // Create email setting
        $setting_name  = 'rocket_setting_email';

        register_setting( $section_group, $setting_name );

        // Add email field to the section
        $setting_title = __( 'Email address', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_email';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);
    }

    add_action( 'admin_init', 'rocket_create_contact_settings' );
}

if ( ! function_exists( 'rocket_setting_display_contact_section' ) ) {
    /**
     * Display contact section
     */
    function rocket_setting_display_contact_section() {
        // echo '<h2>' . __( 'Contact Section', 'rocket' ) . '</h2>';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_address' ) ) {
    /**
     * Display the address setting input
     */
    function rocket_setting_display_setting_address() {
        echo '<input type="text" name="rocket_setting_address" value="' . esc_attr( get_option( 'rocket_setting_address' ) ) . '" />';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_phonenumber' ) ) {
    /**
     * Display the phonenumber setting input
     */
    function rocket_setting_display_setting_phonenumber() {
        echo '<input type="text" name="rocket_setting_phonenumber" value="' . esc_attr( get_option( 'rocket_setting_phonenumber' ) ) . '" />';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_email' ) ) {
    /**
     * Display the email setting input
     */
    function rocket_setting_display_setting_email() {
        echo '<input type="text" name="rocket_setting_email" value="' . esc_attr( get_option( 'rocket_setting_email' ) ) . '" />';
    }
}
