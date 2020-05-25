<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Townsville_Jazz_club
 * @Template name: Events_Page
 */
get_header();
?>

<htm>
    <head>

    </head>
    <body>
        <div id="nav-container">
            <br>
            <div class="event-header">
                <h1>Jazz has never been more alive</h1>
                <h3>The Townsville Jazz Club prides itself in bringing the best Jazz entertainment in the area.
                    We host events fortnightly for all audiences and age ranges, making us the perfect place to get your Jazz fix. Sign up to be member to get </h3>
            </div>
        </div>
        <?php
            $posts=get_posts();
            foreach ($posts as $post){
                new_event($post);
            }
        ?>
    </body>
</htm>
