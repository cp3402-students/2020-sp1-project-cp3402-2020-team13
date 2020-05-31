<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Townsville_Jazz_club
 */


$title=get_the_title();
get_header();
$content=the_content();
?>
<html>
<div class="single">
    <h1><?php echo $title?></h1>
    <P><?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content();
endwhile; else: ?></P>
</div>

</html>
<?php
get_footer();
endif;
