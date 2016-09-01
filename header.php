 <?php
/**
 * header.php
 *
 * The header for the theme
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php
$favicon = IMAGES . '/icons/favicon.png';
$touch_icon = IMAGES . '/icons/apple-touch-icon-152x152-precomposed.png';
?>

<!doctype html>
<!-- [if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif] -->
<!-- [if !IE]> <html <?php language_attributes(); ?>> <!-- <![endif] -->

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">

    <!-- Mobile specific meta -->
    <meta name="author" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Pingback URL -->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <!-- Stylesheets -->
    <link rel="stylesheets" href="css/style.css" />

    <!-- [if lt IE 9]>
         <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicon and Apple icons -->
    <link href="<?php echo $favicon; ?>" rel="shortcut icon"/>
    <link href="<?php echo $touch_icon; ?>" sizes="152x152" rel="apple-touch-icon-precomposed"/>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <!-- Header -->
    <header class="site-header" role="banner">
        <div class="container header-contents">
            <div class="row">
                <div class="small-3 columns">
                    <div class="site-logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a>
                    </div> <!-- /.site-logo -->
                </div>
                <div class="small-9 columns">
                    <?php do_action( 'rocket_in_header' ); ?>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <nav class="site-navigation" role="navigation">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'main-menu',
                            'menu_class' => 'site-menu',
                        ) );
                        ?>
                    </nav> <!-- /.site-navigation -->
                </div>
            </div>
        </div> <!-- /.header-contents -->
    </header>

    <!-- Main content area -->
    <div class="container">
        <div class="row">
