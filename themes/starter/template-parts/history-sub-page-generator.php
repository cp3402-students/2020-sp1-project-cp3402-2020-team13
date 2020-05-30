<?php
/*
by Shaun Gumbaketi 27/5/20

This code displays all posts catagorized as history as thumnails. I
tried to make it as portable as possible so it could be included
in other parts of the website.

To use, copy and paste the following code below:

<div class="post-generator_pages_container" >
    <?php
      include 'history-sub-page-generator.php';
     ?>
</div>

*/

//treat args as a query. If using modifying for a different catagory
//than change 'catagory_name'=>'xxcatagoryxx';
$args = array(
  'post_type'=>'post',
  'post_status'=>'publish',
  'category_name'=>'history',
  'posts_per_page'=> -1
 );


$the_query = new WP_Query( $args );


if ( $the_query->have_posts() ) {

    while ( $the_query->have_posts() ) {
        $the_query->the_post();

        //create thumbnails for every post
       echo '<a href="';echo the_permalink();echo '">';
       echo '<div class="bands_container">';
       echo the_post_thumbnail();
       echo '<h3>' . get_the_title() . '</h3>';
       echo '</div>';
       echo '</a>';

    }

} else {
    // no posts found. insert code for that here
}
// Restore original Post Data
wp_reset_postdata();

 ?>
