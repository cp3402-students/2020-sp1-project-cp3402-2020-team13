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

get_header();
?>
<html>
<head>

</head>
<body>
<div class="landing-header">
    The Best entertainment in Townsville<br>
    <button onclick="location.href = 'http://localhost/wp-login.php';">Sign Up</button>
    <button onclick="location.href = 'http://localhost/events';">See our Events</button>
</div>
<div class="description-container">
    <div class="description-header">
        <h1>World class performers right at your front door</h1>
        <p>Our friendly and relaxed club has a strong history of supporting
            jazz in Townsville and has made a great contribution to the Townsville
            Arts and Music Community over many years. Our well established clubs regular events that span multiple
            locations.
            We have a wide variety of jazz bands, so your guarenteed to find something that you like.</p>
    </div>

</div>
<h1 class="event">Whats Coming Up....</h1>



<?php
$args = array(
    'category' => '4',
    'orderby' => 'date'
);
$posts = get_posts($args);
new_event($posts[0]);
?>

<?php include "footer.php"; ?>
</body>
</html>
