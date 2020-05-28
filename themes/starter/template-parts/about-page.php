<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Townsville_Jazz_club
 * @Template name: About_Pagee
 */
get_header();
?>
<htm>
    <head>

    </head>
    <body>



<div class="page_container">


<div class="about_page_text_container">


<h1>Townsville Jazz Club</h1>
<p>The Townsville Jazz Club has a long history of bringing together
  talented musicians from the area to provide entertainment for the
  Jazz loving people of Townsville. The club was founded in the early
  90’s under the name of North Queensland Jazz Club before being changed
  to its current name. However, what hasn’t changed is the clubs love for
  Jazz, shown through the many performances the bands put on. </p>
</div>

<div class="about_page_text_container">
  <h1>Our Bands</h1>
  <p>The Club features the following Bands with their own unique style
    of play. The bands consist of Townsville's finest Jazz musicians who
    have years of performance experience. Check out the various bands below </p>

</div>

<div class="post-generator_pages_container" >
    <?php

      include 'band-sub-page-generator.php';

     ?>


</div>



  <div class="about_page_text_container">


    <h1>Our History</h1>
    <p>Townsville Jazz Club has a very long history. The club is proud of how far
      they have come and how they are trying to spread the love of Jazz to the
       next generation to continue the club's legacy. The following articles
        provide an insight to the club's history. </p>

      </div>

      <div class="post-generator_pages_container" >
          <?php

            include 'history-sub-page-generator.php';

           ?>


      </div>


</div>
    </body>
</htm>
