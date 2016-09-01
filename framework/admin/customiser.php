<?php
/**
 * customiser.php
 *
 * Customiser code for the WordPress Customiser
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
if ( ! function_exists( 'rocket_customiser_register' ) ) {
    /**
     * Registers and handles customiser code
     *
     * @param $wp_customise object
     */
    function rocket_customiser_register( $wp_customise ) {

        // create a class that defines a textarea control
        class Rocket_Customise_Textarea_Control extends WP_Customize_Control {

            /**
             * Type of control
             *
             * @access public
             */
            public $type = 'textarea';

            /**
             * Render the control
             *
             * @access public
             */
            public function render_content() {
                echo '<label>', '<span class="customize-control-title">', esc_html( $this->label ), '</span>';
                echo '<textarea rows="2" style="width: 100%;"';
                $this->link();
                echo '>', esc_textarea( $this->value() ), '</textarea>', '</label>';
            }

        }

        /**-----------------------------------------------------------**
         * Add contact details section                                 *
         **-----------------------------------------------------------**/
        $wp_customise->add_section( 'rocket_customiser_contact', array(
            'title' => __( 'Contact Details', 'rocket' ),
        ) );

        // Address setting
        $wp_customise->add_setting( 'rocket_setting_address', array(
            'default' => __( 'Your address', 'rocket' ),
            'type'    => 'option',
        ) );

        $wp_customise->add_control( new Rocket_Customise_Textarea_Control(
            $wp_customise,
            'rocket_setting_address',
            array(
                'label'    => __( 'Address', 'rocket' ),
                'section'  => 'rocket_customiser_contact',
                'settings' => 'rocket_setting_address',
            )
        ) );

        // Phone number setting
        $wp_customise->add_setting( 'rocket_setting_phonenumber', array(
            'default' => __( 'Your phone number', 'rocket' ),
            'type'    => 'option',
        ) );

        $wp_customise->add_control( new Rocket_Customise_Textarea_Control(
            $wp_customise,
            'rocket_setting_phonenumber',
            array(
                'label'    => __( 'Phone number', 'rocket' ),
                'section'  => 'rocket_customiser_contact',
                'settings' => 'rocket_setting_phonenumber',
            )
        ) );

        // Email address setting
        $wp_customise->add_setting( 'rocket_setting_email', array(
            'default' => __( 'Your email address', 'rocket' ),
            'type'    => 'option',
        ) );

        $wp_customise->add_control( new Rocket_Customise_Textarea_Control(
            $wp_customise,
            'rocket_setting_email',
            array(
                'label'    => __( 'Email address', 'rocket' ),
                'section'  => 'rocket_customiser_contact',
                'settings' => 'rocket_setting_email',
            )
        ) );

        /**-----------------------------------------------------------**
         * Add logo upload section                                     *
         **-----------------------------------------------------------**/
        $wp_customise->add_section( 'rocket_customiser_logo_upload', array(
            'title' => __( 'Images', 'rocket' ),
        ) );

        // Logo setting
        $wp_customise->add_setting( 'rocket_setting_logo', array(
            'type' => 'option',
        ) );

        $wp_customise->add_control( new WP_Customize_Image_Control(
            $wp_customise,
            'rocket_setting_logo',
            array(
                'label'    => __( 'Upload your logo', 'rocket' ),
                'section'  => 'rocket_customiser_logo_upload',
                'settings' => 'rocket_setting_logo',
            )
        ) );

        // Retina logo setting
        $wp_customise->add_setting( 'rocket_setting_retina_logo', array(
            'type' => 'option',
        ) );

        $wp_customise->add_control( new WP_Customize_Image_Control(
            $wp_customise,
            'rocket_setting_retina_logo',
            array(
                'label'    => __( 'Upload your retina logo', 'rocket' ),
                'section'  => 'rocket_customiser_logo_upload',
                'settings' => 'rocket_setting_retina_logo',
            )
        ) );

        /**-----------------------------------------------------------**
         * Color scheme section                                        *
         **-----------------------------------------------------------**/
        $wp_customise->add_section( 'rocket_customiser_colours', array(
            'title' => __( 'Colour Scheme', 'rocket' ),
        ) );

        // Primary colour
        $textcolours[] = array(
            'slug'    => 'rocket_setting_primary_colour',
            'default' => '#333',
            'label'   => __( 'Primary colour', 'rocket' ),
        );

        // Secondary colour
        $textcolours[] = array(
            'slug'    => 'rocket_setting_secondary_colour',
            'default' => '#666',
            'label'   => __( 'Secondary colour', 'rocket' ),
        );

        // Link colour
        $textcolours[] = array(
            'slug'    => 'rocket_setting_link_colour',
            'default' => '#008ab7',
            'label'   => __( 'Link colour', 'rocket' ),
        );

        // Link hover colour
        $textcolours[] = array(
            'slug'    => 'rocket_setting_link_hover_colour',
            'default' => '#9e4059',
            'label'   => __( 'Link hover colour', 'rocket' ),
        );

        // Add settings and controls for each colour
        foreach ( $textcolours as $textcolour ) {
            // Add setting
            $wp_customise->add_setting(
                $textcolour['slug'],
                array(
                    'default' => $textcolour['default'],
                    'type'    => 'option',
                )
            );

            // Add control
            $wp_customise->add_control( new WP_Customize_Color_Control(
                $wp_customise,
                $textcolour['slug'],
                array(
                    'label'    => $textcolour['label'],
                    'section'  => 'rocket_customiser_colours',
                    'settings' => $textcolour['slug'],
                )
            ) );
        }

    }

    add_action( 'customize_register', 'rocket_customiser_register' );
}

if ( ! function_exists( 'rocket_display_contact_details_in_header' ) ) {
    /**
     * Hook into rocket_in_header and display the address, phone number and email address
     */
    function rocket_display_contact_details_in_header() {
        echo '<address>';

        // Display address
        echo '<p class="address">';
        echo get_option( 'rocket_setting_address', 'Your address' );
        echo '</p>';

        // Display phone number
        echo '<p class="phonenumber">';
        echo get_option( 'rocket_setting_phonenumber', 'Phone number' );
        echo '</p>';

        // Display email address
        $email = get_option( 'rocket_setting_email', 'Email address' );
        echo '<p class="email">';
        if ( 'Email address' == $email ) {
            echo $email;
        } else {
            echo '<a href="mailto:', $email, '">', $email, '</a>';
        }
        echo '</p>';

        echo '</address>';
    }

    add_action( 'rocket_in_header', 'rocket_display_contact_details_in_header' );
}
