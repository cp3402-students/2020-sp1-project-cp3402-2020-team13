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
$args = array(
    'category' => '2',
);
$posts = get_posts($args);
?>
<html>
<div id="slideshow">
    <div class="slide-wrapper">
        <?php foreach ($posts as $post) {
            $title = get_the_title($post);
            $image = get_the_post_thumbnail_url($post);
            $link = get_permalink($post);
            echo "<a href=$link><div class=\"slide\" style='background-image: url($image);background-repeat: no-repeat;background-size: cover;'><h1 class=\"slide-number\">$title</h1></div></a>";
        }
        ?>

    </div>
</div>
<div class="bands-header">
    <h1>Our Performers</h1>
    <p>We at Townsville Jazz Club pride ourselves on having world class performers. We feature a range of very talented
        local bands playing great jazz music in a relaxed yet vibrant environment.<br><br>
        Our performers are all longtime members of the local jazz community, with some going back to as far as 1974!
        Band members are common place a Jazz Club events, performing our not.
    </p>
</div>
<div class="history-header">
    <h1>Jazz Club History</h1>
    <div class="background-container">
    <h3>Harbour End Jazz Club</h3>
    <p>Whilst jazz music had been played in Townsville long before the Harbour End Jazz Club was formed in 1980,
        there had not been a recognised venue where jazz was performed for about twenty years.
        This club effectively started the revival of the jazz scene in Townsville which was then carried on with
        the formation of the North Queensland Jazz Club (NQ Jazz Club Inc. from 1995) and its subsequent change of name to Townsville Jazz Club Inc. in 2012.
        The Harbour End Jazz Club was started in 1980 by Mo Murakami, Ted Redknap, Bob Hebden and Les Nicholson.
        Ted and Mo were members of the widely acclaimed North Qld Area Army Band.  The Army band had a close association
        with the local musicians and having Ted and Mo as Directors cemented that close relationship.
        Mo also had an input into starting the NQ Jazz Club which still exists today and is a significant institution in the promotion of jazz in Townsville.  </p>
    <h3>NQ Jazz Club INC.</h3>
    <p>The formation of the North Queensland Jazz Club began with discussions led by Brian Linforth, Mo Murakami and Andrew Dajski around 1993.
        By 1994 these guys were playing once a month for ‘beer money’ just to get the club started however the club Newsletter from 1999 states that on Sunday
        11th April the club celebrated its fourth birthday and indicates the official start of North Queensland Jazz Club being 7th April 1995.</p>
    <h3>Townsville Jazz Club INC.</h3>
    <p>The Townsville Jazz Club was originally established as the NQ Jazz Club and operated under this name for approximately 18 years when the management committee began to
        question whether the regional name of ‘North Queensland’ that did not clearly inform people where the jazz club was actually based was not assisting new people to locate the club. <br><br>

        In this age of electronic searches to find recreational activities, it was felt that most new residents and people travelling through Townsville who were searching for jazz venues would
        include jazz and Townsville in their search regardless of any other keywords that they may use in their search.  </p>
    <h3>2012 - A year of growth and change</h3>
    <p>
        On Sunday 24th June 2012 more than half the club’s members were present for the launch of the new Townsville Jazz Club Inc. logo featuring Neville Minon.
        This was a memorable night when we paid tribute to Nev for his 62 years of service to both jazz and brass band music.  With such a distinguished musical career
        I don’t think anyone would begrudge Nev the honour of gracing the Townsville Jazz Club logo.  It was clear that Nev was very touched by the occasion and he and
        his wife Christine were delighted with the image that was created through Bob Spillane’s photography and the artistry of Katrina Cataldo at Townprint.
    </p>
    </div>
</div>
</html>