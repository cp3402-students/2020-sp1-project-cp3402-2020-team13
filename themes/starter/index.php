<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Townsville_Jazz_club
 */

$posts =wp_get_recent_posts(5);
$current_post=$posts[0];
$dates=get_field("dates",$post->ID);
$next_date=explode(",",$dates)[0];
get_header(); ?>
<html>
<head>

</head>

<body>
<div class="header-image">
<div class="landing-content">
                <p>
                    Come and enjoy our regular jazz nights <br><br>
                    We feature a range of very talented local bands playing great jazz music in a relaxed yet vibrant
                    environment. The regular jazz nights feature a sit-in bracket and dancers are most welcome.
                    Meals and bar facility available. No need to book
                </p>
            </div>
</div>
<div class="event-head">

</div>
<div class="events">

    <h2>
        <b> UPCOMING EVENTS </b>
    </h2>
    <table>
        <tr>
            <th class="events-left">
                <?php
                    echo "<h2>" , get_the_title($current_post) , "</h2>";
                    the_field("dates_copy",$post->ID);
                    echo "<p>" , get_field("start_time",$post->ID) , "</p>";
                    echo "<p>" , get_field("finish_time",$post->ID)  , "</p>";
                ?>
            </th>
            <th>rfagfrgvd</th>
        </tr>
    </table>
</div>

</body>
</html>
