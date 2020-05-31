<?php
/**
 * Template
 */


$title = get_the_title();
$members = get_field("members");
$image = get_field("main_image");
$description = get_field("description");
get_header();
?>
    <div >
        <img src="<?php echo $image ?>">
        <h1><?php echo $title ?></h1>

    </div>
<?php
get_footer();

