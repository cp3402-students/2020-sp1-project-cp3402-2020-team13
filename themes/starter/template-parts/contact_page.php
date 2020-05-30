<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Townsville_Jazz_club
 * Template Name: Contact Page
 */
get_header();
?>



  <body>

    <div class="contact_page_container">




    <div class="contact_page_text_container">




    <h1>Contact Us</h1>
      <p>The current Townsville Jaz Club committee members are:</p>
      <ul>
        <li>Bob Passmore (President)</li>
        <li>Jeremy Hawker (Vice President)</li>
        <li>Coralie Costigan (Secretary)</li>
        <li>Phil McIntyre (Treasurer)</li>
      </ul>

      <p>Please use the form below to contact us and a member will get back to you as soon as possible.</p>


        </div>


      <div class="contact_form_container">

  <?php echo do_shortcode( '[contact-form-7 id="47" title="Contact form 1"]' ); ?>

      </div>

        </div>

  </body>
</html>
