<?php
/**
 * theme-settings.php
 *
 * The theme settings page
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_create_settings_pages' ) ) {
    /**
     * Create the settings page
     */
    function rocket_create_settings_pages() {
        // Main settings page
        $page_title        = __( 'Rocket Settings', 'rocket' );
        $menu_title        = __( 'Rocket Settings', 'rocket' );
        $capability        = 'manage_options';
        $menu_slug         = 'rocket-settings-page';
        $function_callback = 'rocket_display_settings_page';
        $icon_url          = get_template_directory_uri() . '/images/logo-admin.png';
        $position          = 100;

        add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function_callback, $icon_url, $position );

        // General settings sub page
        $parent_slug            = $menu_slug;
        $sub_page_page_title    = __( 'General Settings', 'rocket' );
        $sub_page_menu_title    = __( 'General', 'rocket' );
        $sub_page_capability    = $capability;
        $sub_page_menu_slug     = $parent_slug;
        $sub_page_menu_callback = 'rocket_display_settings_general_page';

        add_submenu_page( $parent_slug, $sub_page_page_title, $sub_page_menu_title, $sub_page_capability, $sub_page_menu_slug, $sub_page_menu_callback );

        // Social settings sub page
        $parent_slug            = $menu_slug;
        $sub_page_page_title    = __( 'Social Settings', 'rocket' );
        $sub_page_menu_title    = __( 'Social', 'rocket' );
        $sub_page_capability    = $capability;
        $sub_page_menu_slug     = 'rocket-settings-social-page';
        $sub_page_menu_callback = 'rocket_display_settings_social_page';

        add_submenu_page( $parent_slug, $sub_page_page_title, $sub_page_menu_title, $sub_page_capability, $sub_page_menu_slug, $sub_page_menu_callback );

        // Contact settings sub page
        $parent_slug            = $menu_slug;
        $sub_page_page_title    = __( 'Contact Settings', 'rocket' );
        $sub_page_menu_title    = __( 'Contact', 'rocket' );
        $sub_page_capability    = $capability;
        $sub_page_menu_slug     = 'rocket-settings-contact-page';
        $sub_page_menu_callback = 'rocket_display_settings_contact_page';

        add_submenu_page( $parent_slug, $sub_page_page_title, $sub_page_menu_title, $sub_page_capability, $sub_page_menu_slug, $sub_page_menu_callback );
    }

    add_action( 'admin_menu', 'rocket_create_settings_pages' );
}

if ( ! function_exists( 'rocket_display_settings_page' ) ) {
    function rocket_display_settings_page() {
    }
}

/**-----------------------------------------------------------**
 * General settings page                                       *
 **-----------------------------------------------------------**/
if ( ! function_exists( 'rocket_display_settings_general_page' ) ) {
    /**
     * Display the general settings page
     */
    function rocket_display_settings_general_page() {
        require_once get_template_directory() . '/framework/admin/templates/general-settings-form.php';
    }
}

// Include general settings
require_once FRAMEWORK . '/admin/general-settings.php';

/**-----------------------------------------------------------**
 * Contact settings page                                        *
 **-----------------------------------------------------------**/
if ( ! function_exists( 'rocket_display_settings_contact_page' ) ) {
    /**
     * Display the social settings page
     */
    function rocket_display_settings_social_page() {
        require_once get_template_directory() . '/framework/admin/templates/social-settings-form.php';
    }
}

// Include social settings
require_once FRAMEWORK . '/admin/social-settings.php';

/**-----------------------------------------------------------**
 * Contact settings page                                       *
 **-----------------------------------------------------------**/
if ( ! function_exists( 'rocket_display_settings_contact_page' ) ) {
    /**
     * Display the contact settings page
     */
    function rocket_display_settings_contact_page() {
        require_once get_template_directory() . '/framework/admin/templates/contact-settings-form.php';
    }
}

// Include contact settings
require_once FRAMEWORK . '/admin/contact-settings.php';

if ( ! function_exists( 'rocket_admin_scripts' ) ) {
    /**
     * Enqueue the need scripts and styles for the admin section
     */
    function rocket_admin_scripts() {
        $current_screen_id = get_current_screen()->id;

        // Only load the media related scripts and styles when needed
        if (
            'toplevel_page_rocket-settings-page' == $current_screen_id
            // || 'some-other-admin-page' == $current_screen_id
        ) {
            // Media Library scripts
            wp_enqueue_media();

            // Color Picker API scripts and styles
            wp_enqueue_script( 'wp-color-picker');
            wp_enqueue_style( 'wp-color-picker' );
        }

        // Load admin scripts
        wp_register_script( 'rocket-admin-custom', SCRIPTS . '/admin-scripts.min.js', array( 'jquery' ) );
        wp_enqueue_script( 'rocket-admin-custom' );

        // Load admin styles
        wp_enqueue_style( 'rocket-admin-style', THEMEROOT . '/css/admin.css' );
    }

    add_action( 'admin_enqueue_scripts', 'rocket_admin_scripts' );
}

if ( ! function_exists( 'rocket_load_logo_placeholder_js' ) ) {
    /**
     * Load the logo placeholder string into a .js variable to be used by theme settings
     */
    function rocket_load_logo_placeholder_js() {
        echo '<script>window.LOGO_PLACEHOLDER = "', LOGO_PLACEHOLDER, '";</script>';
    }

    add_action( 'admin_head', 'rocket_load_logo_placeholder_js' );
}
