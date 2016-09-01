<?php
/**
 * functions.php
 *
 * Functions and Definitions
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */

// Define constants
define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/images' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'FRAMEWORK', get_template_directory() . '/framework' );
define( 'LOGO_PLACEHOLDER', 'https://placeholdit.imgix.net/~text?txtsize=20&txt=No+Logo&w=100&h=100&txttrack=0' );

// Load the framework
require_once( FRAMEWORK . '/init.php' );

// Set up the content width value based on the theme's design
if ( ! isset( $content_width ) ) {
    $content_width = 800;
}

if ( ! function_exists( 'rocket_setup' ) ) {
    /**
     * Set up theme default and register various supported features
     */
    function rocket_setup() {
        // Make the theme available for translation
        $lang_dir = THEMEROOT . '/languages';
        load_theme_textdomain( 'rocket', $lang_dir );

        // Add support for post formats
        add_theme_support( 'post-formats', array(
            'gallery',
            'link',
            'image',
            'quote',
            'video',
            'audio',
        ) );

        // Add support for automatic feed links
        add_theme_support( 'automatic-feed-links' );

        // Add support for post thumbnails
        add_theme_support( 'post-thumbnails' );

        // Register nav menus
        register_nav_menus(array(
            'main-menu' => __( 'Main Menu', 'rocket' ),
        ) );

        // Ensure that search and comment form as well as comments output valid HTML5
        add_theme_support( 'html5', array(
	    'search-form',
	    'comment-form',
	    'comment-list',
	    'gallery',
	    'caption',
	) );
    }

    add_action( 'after_setup_theme', 'rocket_setup' );
}

if ( ! function_exists( 'rocket_post_meta' ) ) {
    /**
     * Display meta information for a specific post
     */
    function rocket_post_meta() {
        echo '<ul class="list-inline entry meta">';

        if ( get_post_type() === 'post' ) {
            // if post is sticky mark it
            if ( is_sticky() ) {
                echo '<li class="meta-featured-post"><i class="fa fa-thumb-tack"></i> ' . __( 'Sticky', 'rocket' ) . '</li>';
            }

            // Get the post author
            printf(
                '<li class="meta-author"><a href="%1$s" rel="author">%2$s</a></li>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
            );

            // Get the date
            echo '<li class="meta-date">' . get_the_date() . '</li>';


            // The categories
            $category_list = get_the_category_list( ', ' );
            if ( $category_list ) {
                echo '<li class="meta-categories">' . $category_list . '</li>';
            }

            // The tags
            $tag_list = get_the_tag_list( '', ', ' );
            if ( $tag_list ) {
                echo '<li class="meta-tags">' . $tag_list . '</li>';
            }

            // Comments link
            if ( comments_open() ) {
                echo '<li>';
                echo '<span class="meta-reply">';
                comments_popup_link( __( 'Leave a comment', 'rocket' ), __( 'One comment so far', 'rocket' ), __( 'View all % comments', 'rocket' ) );
                echo '</span>';
                echo '</li>';
            }

            // Edit link
            if ( is_user_logged_in() ) {
                echo '<li>';
                edit_post_link( __( 'Edit', 'rocket' ), '<span class="meta-edit">', '</span>' );
                echo '</li>';
            }
        }
    }
}

if ( ! function_exists( 'rocket_paging_nav' ) ) {
    /**
     * Display navigation to the next/previous set of posts
     */
    function rocket_paging_nav() { ?>
        <ul>
            <?php if ( get_previous_posts_link() ) : ?>
                <li class="next">
                    <?php previous_posts_link( __( 'Newer Posts &rarr;', 'rocket' ) ); ?>
                </li>
            <?php endif; ?>
            <?php if ( get_next_posts_link() ) : ?>
                <li class="previous">
                    <?php next_posts_link( __( '&larr; Older Posts', 'rocket' ) ); ?>
                </li>
            <?php endif; ?>
        </ul>
        <?php
    }
}

if ( ! function_exists( 'rocket_widget_init' ) ) {
    /**
     * Register the widget area
     */
    function rocket_widget_init() {
        if ( function_exists( 'register_sidebar' ) ) {
            register_sidebar( array(
                'name'          => __( 'Main Widget Area', 'rocket' ),
                'id'            => 'sidebar-1',
                'description'   => __( 'Appears on posts and pages', 'rocket' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div> <!-- /.widget -->',
                'before_title'  => '<h5 class="widget-title">',
                'after_title'   => '</h5>',
            ) );

            register_sidebar( array(
                'name'          => __( 'Footer Widget Area', 'rocket' ),
                'id'            => 'sidebar-2',
                'description'   => __( 'Appears on the footer', 'rocket' ),
                'before_widget' => '<div id="%1$s" class="widget col-sm-3 %2$s">',
                'after_widget'  => '</div> <!-- /.widget -->',
                'before_title'  => '<h5 class="widget-title">',
                'after_title'   => '</h5>',
            ) );
        }
    }

    add_action( 'widgets_init', 'rocket_widget_init' );
}

if ( ! function_exists( 'rocket_validate_length' ) ) {
    /**
     * Validates a field's length
     *
     * @param string $fieldValue value to strip
     * @param int    $minLength  length to compare to
     * @return string
     */
    function rocket_validate_length( $fieldValue, $minLength ) {
        // Remove trailing and leading whitespace
        return ( strlen( trim( $fieldValue ) ) > $minLength );
    }
}

if ( ! function_exists( 'rocket_load_wp_head' ) ) {
    /**
     * Include the generated CSS in the page header
     */
    function rocket_load_wp_head() {
        // Get the logos
        $logo = esc_url( get_option( 'rocket_setting_logo' ) ) ? esc_url( get_option( 'rocket_setting_logo' ) ) : IMAGES . '/logo.png';
        $logo_retina = esc_url( get_option( 'rocket_setting_retina_logo' ) ) ? esc_url( get_option( 'rocket_setting_retina_logo' ) ) : IMAGES . '/logo@2x.png';

        $logo_size = getimagesize( $logo );
        ?>

        <!-- Logo CSS -->
        <style type="text/css">
            .site-logo a {
                background: transparent url(<?php echo $logo; ?>) 0 0 no-repeat;
                width: <?php echo $logo_size[0]; ?>px;
                height: <?php echo $logo_size[0]; ?>px;
                display: inline-block;
            }

            @media only screen and (-webkit-min-device-pixel-ratio: 1.5),
            only screen and (-moz-min-device-pixel-ratio: 1.5),
            only screen and (-o-min-device-pixel-ratio: 3/2),
            only screen and (min-device-pixel-ratio: 1.5) {
                .site-logo a {
                    background: transparent url(<?php echo $logo_retina; ?>) 0 0 no-repeat;
                    background-size: <?php echo $logo_size[0]; ?>px <?php echo $logo_size[1]; ?>px;
                }
            }
        </style>
        <?php
    }

    add_action( 'wp_head', 'rocket_load_wp_head' );
}

if ( ! function_exists( 'rocket_load_colourscheme_wp_head' ) ) {
    /**
     * Load the custom colourscheme colours into the head
     */
    function rocket_load_colourscheme_wp_head() {
        // Get the colours
        $primary_colour = get_option( 'rocket_primary_color' );
        $secondary_colour = get_option( 'rocket_secondary_color' );
        $link_colour = get_option( 'rocket_link_colour' );
        $link_hover_colour = get_option( 'rocket_link_hover_colour' );

        // start a <style> and insert styles with the above colours
    }

    add_action( 'wp_head', 'rocket_load_colourscheme_wp_head' );
}

if ( ! function_exists( 'rocket_scripts' ) ) {
    /**
     * Enqueue the needed scripts and stylesheets
     */
    function rocket_scripts() {
        // Adds support for pages with threaded Comments
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-replay' );
        }

        // Register scripts
        wp_register_script( 'foundation-what-input', SCRIPTS . '/what-input.js', array( 'jquery' ), false, true );
        wp_register_script( 'foundation', SCRIPTS . '/foundation.js', array( 'jquery' ), false, true );
        wp_register_script( 'rocket-custom', SCRIPTS . '/scripts.js', array( 'jquery' ), false, true );

        // Load the scripts
        wp_enqueue_script( 'foundation-what-input' );
        wp_enqueue_script( 'foundation' );
        wp_enqueue_script( 'rocket-custom' );

        // Load the stylesheets
        wp_enqueue_style( 'rocket-style', THEMEROOT . '/css/styles.css' );
    }

    add_action( 'wp_enqueue_scripts', 'rocket_scripts' );
}

// Require admin settings page
require FRAMEWORK . '/admin/theme-settings.php';

// Customiser settings
require FRAMEWORK . '/admin/customiser.php';

// Shortcodes
require FRAMEWORK . '/admin/shortcodes/shortcodes.php';

// TinyMCE custom plugin
require FRAMEWORK . '/admin/tinymce-rocket-plugin.php';

// Products custom post type
require FRAMEWORK . '/includes/products/functions.php';
