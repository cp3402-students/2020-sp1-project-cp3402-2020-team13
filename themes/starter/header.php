<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Townsville_Jazz_club
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@700&display=swap" rel="stylesheet">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="nav-container">
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'townsville-jazz-club' ); ?></a>

        <header id="masthead" class="site-header">
            <img class="head-logo" src="https://townsvillejazzclub.s3-ap-southeast-2.amazonaws.com/LOGO+V1.png" <!-- .site-branding -->

            <nav class="site-nav" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu"
                        aria-expanded="false"><?php esc_html_e('Primary Menu', 'townsville-jazz-club'); ?></button>
                <?php echo wp_nav_menu(); include "media_player.php"?>


            </nav><!-- #site-navigation -->
        </header>

    </div>
</div>
</html>
