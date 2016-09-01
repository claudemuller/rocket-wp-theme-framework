<?php
/**
 * general-settings.php
 *
 * Functions for the general settings section
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_create_general_settings' ) ) {
    /**
     * Register the general settings
     */
    function rocket_create_general_settings() {
        /**-----------------------------------------------------------**
         * Logo setting field                                          *
         **-----------------------------------------------------------**/
        // Create logo setting
        $section_group = 'rocket-settings-page';  // settings group and page slug are the same
        $setting_name  = 'rocket_setting_logo';

        register_setting( $section_group, $setting_name );

        // Create section of page
        $settings_section = 'rocket-settings-general-section';
        $page = $section_group;
        $section_title = __( 'General Settings', 'rocket' );
        $output_callback = 'rocket_setting_display_general_section';

        add_settings_section( $settings_section, $section_title, $output_callback, $page );

        // Add logo field to the section
        $setting_title = __( 'Logo', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_logo';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);

        /**-----------------------------------------------------------**
         * Retina Logo setting field                                   *
         **-----------------------------------------------------------**/
        // Create retina_logo setting
        $section_group = 'rocket-settings-page';  // settings group and page slug are the same
        $setting_name  = 'rocket_setting_retina_logo';

        register_setting( $section_group, $setting_name );

        // Add retina logo field to the section
        $setting_title = __( 'Retina Logo', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_retina_logo';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);

        /**-----------------------------------------------------------**
         * Primary colour setting field                                *
         **-----------------------------------------------------------**/
        // Create primary colour setting
        $section_group = 'rocket-settings-page';  // settings group and page slug are the same
        $setting_name  = 'rocket_setting_primary_colour';

        register_setting( $section_group, $setting_name );

        // Add primary colour field to the section
        $setting_title = __( 'Primary colour', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_primary_colour';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);

        /**-----------------------------------------------------------**
         * Secondary colour setting field                              *
         **-----------------------------------------------------------**/
        // Create secondary colour setting
        $section_group = 'rocket-settings-page';  // settings group and page slug are the same
        $setting_name  = 'rocket_setting_secondary_colour';

        register_setting( $section_group, $setting_name );

        // Add secondary colour field to the section
        $setting_title = __( 'Secondary colour', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_secondary_colour';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);

        /**-----------------------------------------------------------**
         * Link colour setting field                                   *
         **-----------------------------------------------------------**/
        // Create link colour setting
        $section_group = 'rocket-settings-page';  // settings group and page slug are the same
        $setting_name  = 'rocket_setting_link_colour';

        register_setting( $section_group, $setting_name );

        // Add link colour field to the section
        $setting_title = __( 'Link colour', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_link_colour';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);

        /**-----------------------------------------------------------**
         * Link hover colour setting field                             *
         **-----------------------------------------------------------**/
        // Create link_hover colour setting
        $section_group = 'rocket-settings-page';  // settings group and page slug are the same
        $setting_name  = 'rocket_setting_link_hover_colour';

        register_setting( $section_group, $setting_name );

        // Add link_hover colour field to the section
        $setting_title = __( 'Link hover colour', 'rocket' );
        $setting_renderer = 'rocket_setting_display_setting_link_hover_colour';

        add_settings_field( $setting_name, $setting_title, $setting_renderer, $page, $settings_section);

        // Validation example
        /* function rocket_validate_email( $input ) {
            $validated = sanitize_email( $input );

            if ( $validated !== $input ) {
                $setting_name = 'rocket_setting_email';
                $identifier_used_in_css = esc_attr( 'settings_updated' );
                $type = 'error';  // or 'updated' for positive message
                $message = __( 'Email was invalid.', 'rocket' );

                add_settings_error( $setting_name, $identifier_used_in_css, $message, $type );
            }

            return $validated;
        } */
    }

    add_action( 'admin_init', 'rocket_create_general_settings' );
}

if ( ! function_exists( 'rocket_setting_display_general_section' ) ) {
    /**
     * Display general section
     */
    function rocket_setting_display_general_section() {
        // echo '<h2>' . __( 'General Section', 'rocket' ) . '</h2>';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_logo' ) ) {
    /**
     * Display the logo setting input
     */
    function rocket_setting_display_setting_logo() {
        $logo_url = esc_url( get_option( 'rocket_setting_logo' ) ) ? esc_url( get_option( 'rocket_setting_logo' ) ) : esc_url( LOGO_PLACEHOLDER );

        echo '<div class="image-upload-group">';
        echo '<img class="image-upload-preview" src="', $logo_url , '" /><br>';
        echo '<input class="image-upload-url" type="hidden" id="rocket-setting-logo-url" name="rocket_setting_logo" value="', esc_url( get_option( 'rocket_setting_logo' ) ), '" />';
        echo '<input class="image-upload-button button" type="button" value="', __( 'Upload Logo', 'rocket' ), '" />';
        echo '<input class="image-remove-button button" type="button" value="', __( 'Remove Logo', 'rocket' ), '" />';
        echo '</div>';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_retina_logo' ) ) {
    /**
     * Display the retina_logo setting input
     */
    function rocket_setting_display_setting_retina_logo() {
        $logo_url = esc_url( get_option( 'rocket_setting_retina_logo' ) ) ? esc_url( get_option( 'rocket_setting_retina_logo' ) ) : esc_url( LOGO_PLACEHOLDER );

        echo '<div class="image-upload-group">';
        echo '<img class="image-upload-preview" src="', $logo_url, '" /><br>';
        echo '<input class="image-upload-url" type="hidden" id="rocket-setting-retina_logo-url" name="rocket_setting_retina_logo" value="', esc_url( get_option( 'rocket_setting_retina_logo' ) ), '" />';
        echo '<input class="image-upload-button button" type="button" value="', __( 'Upload Logo', 'rocket' ), '" />';
        echo '<input class="image-remove-button button" type="button" value="', __( 'Remove Logo', 'rocket' ), '" />';
        echo '<p class="description">Your retina logo should be double your logo\'s size</p>';
        echo '</div>';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_primary_colour' ) ) {
    /**
     * Display the primary_colour setting
     */
    function rocket_setting_display_setting_primary_colour() {
        echo '<input class="colour-field" type="text" name="rocket_setting_primary_colour" value="', get_option( 'rocket_setting_primary_colour' ), '" />';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_secondary_colour' ) ) {
    /**
     * Display the secondary_colour setting
     */
    function rocket_setting_display_setting_secondary_colour() {
        echo '<input class="colour-field" type="text" name="rocket_setting_secondary_colour" value="', get_option( 'rocket_setting_secondary_colour' ), '" />';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_link_colour' ) ) {
    /**
     * Display the link_colour setting
     */
    function rocket_setting_display_setting_link_colour() {
        echo '<input class="colour-field" type="text" name="rocket_setting_link_colour" value="', get_option( 'rocket_setting_link_colour' ), '" />';
    }
}

if ( ! function_exists( 'rocket_setting_display_setting_link_hover_colour' ) ) {
    /**
     * Display the link_hover_colour setting
     */
    function rocket_setting_display_setting_link_hover_colour() {
        echo '<input class="colour-field" type="text" name="rocket_setting_link_hover_colour" value="', get_option( 'rocket_setting_link_hover_colour' ), '" />';
    }
}
