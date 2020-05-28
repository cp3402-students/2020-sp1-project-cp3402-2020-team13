<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Townsville_Jazz_club
* Template Name: Gallery template page
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


  <div class="page_container">

    <div class="gallery-page-description-container">
        <h1>Townsville Jazz Club Photo Albums</h1>
        <p>Every event has a handy
        camera man ready to capture every jazz moment.
        Have a browse through the club's photo albums. </p>
    </div>


<div class="post-generator_pages_container" >

    <?php include('gallery-generator.php') ?>

</div>


  </div>

</body>
</html>
