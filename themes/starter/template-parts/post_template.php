<?php
/** Template Name: Band * Template Post Type: post*/
/*The template for displaying full width single posts. */
$title = get_the_title();
$members = explode(",",get_field("members"));
$image = get_field("main_image");
$description = get_field("description_of_the_band");
get_header();
?>
    <div class="band">
        <img src="<?php echo $image ?>">
        <h1><?php echo $title ?></h1>
        <p><?php echo $description?></p>
        <h3>Members: </h3>
        <div class="members">
        <?php foreach ($members as $member){
            echo $member;
            echo ", ";
        }?>
    </div>
    </div>
<?php

