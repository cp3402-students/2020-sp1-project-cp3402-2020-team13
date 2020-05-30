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
            <div class="event-header">
                <h1>Jazz has never been more alive</h1>
                <h3>The Townsville Jazz Club prides itself in bringing the best Jazz entertainment in the area.
                    We host events fortnightly for all audiences and age ranges, making us the perfect place to get your Jazz fix, come for the smooth sounds of The pacific
                    mainstream band or the upbeat melodies of counterpoint. Sign up to be member to get special offers on entry, food and drinks. </h3>
            </div>
            <div class="dropup">
                <button class="dropbtn">Sort by</button>
                <div class="dropup-content">
                    <a href="#">Name</a>
                    <a href="#">Date</a>
                </div>
            </div>
        <?php
        $args=array(
            'category'=>'4',
            'orderby'=>'date'
        );
        $posts=get_posts($args);
            foreach ($posts as $post){
                new_event($post);
            }
        ?>
    </body>
</htm>
