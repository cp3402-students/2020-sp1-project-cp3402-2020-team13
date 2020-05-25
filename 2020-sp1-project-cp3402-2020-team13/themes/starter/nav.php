<html>
<div id="nav-container">
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'townsville-jazz-club' ); ?></a>

        <header id="masthead" class="site-header">
            <img class="head-logo" src="https://townsvillejazzclub.s3-ap-southeast-2.amazonaws.com/LOGO+V1.png" <!-- .site-branding -->

            <nav class="site-nav" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu"
                        aria-expanded="false"><?php esc_html_e('Primary Menu', 'townsville-jazz-club'); ?></button>
                <?php echo wp_nav_menu(); ?>

            </nav><!-- #site-navigation -->
        </header>
        <?php include "media_player.php"; ?>
    </div>
</div>
</html>
