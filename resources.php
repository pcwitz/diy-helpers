<?php
  session_start();
?><!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
    <title>About Do-It-Yourself Helpers</title>    
  </head>
  <body>
  <div class="page-wrap">

      <div class="row">   
        <div class="col-1">
          <nav>
          <?php
            if(isset($_SESSION['homeownerid']))
            {
              echo
               "<a id='left' href='about.php'>about</a>
              <a id='center' href='home.php'><span class='icon-home'></span><span class='alt-text'>home</span></a>
              <a id='right' href='terms.php'>terms and conditions</a>";
            }
            else
            {
              echo
               "<a id='left' href='about.php'>about</a>
              <a id='center' href='registration.php'>REGISTER</a>
              <a id='right' href='terms.php'>terms and conditions</a>";
            }
          ?>
          </nav> 
        </div>
      </div>

    <?php include('_/header.php'); ?>
    
    <h2>Resources:</h2>
    
      <p><a href='http://www.constructionjunction.org/'>Construction
      Junction</a>'s mission is to support and promote conservation
      through the reuse of building materials. They strive to keep usable
      building materials out of the landfills and provide them to the
      community at very low cost. In this way, their mission has an
      environmental and social focus. Construction Junction specializes in
      used and surplus building materials and is supported by Pennsylvania
      Resources Council, the oldest grass roots environmental organization in the state. 
      
      <p><a href='http://www.houzz.com/discussions'>Houzz</a> is the
      leading online platform for home remodeling and design, providing
      people with everything they need to improve their homes from start
      to finish - online or from a mobile device. From decorating a room
      to building a custom home, Houzz connects millions of homeowners,
      home design enthusiasts and home improvement professionals across
      the country and around the world. With the largest residential
      design database in the world and a vibrant community powered by
      social tools, Houzz is the easiest way for people to get the design
      inspiration, project advice, product information and professional
      reviews they need to help turn ideas into reality.</p>
      
      <p><a href='http://www.diynetwork.com/'>DIYnetwork.com</a> features
      step-by-step instructions for thousands of home improvement projects
      and videos, an interactive program guide, episode finder, message
      boards, blogs and more.</p>
    
      <p>The <a href='http://www.pittsburghhabitat.org/shop.html'>Habitat
      for Humanity ReStore</a> sells reusable house building and home
      improvement materials to the public. The store accepts donated goods
      which are sold at  50%-70% off the retail value. All proceeds from
      the sale of donations help place families in affordable shelter in
      the Greater Pittsburgh area. The ReStore provides an environmentally
      and socially responsible way to keep good, reusable materials out of
      the waste stream while providing funding for Habitat's community
      improvement work.</p>
      
      <p>The mission of <a href='http://timebanks.org/'>TimeBanks</a> is
      to nurture and expand a movement that promotes equality and builds
      caring community economies through inclusive exchange of time and
      talent. TimeBanks USA was founded in 1995 and its central office is
      located in Washington D.C. We are working with TimeBanks leaders
      across the US and internationally to strengthen and rebuild
      community, and use TimeBanks to achieve wide-ranging goals such as
      social justice, bridges between diverse communities, and local
      ecological sustainability.</p>
      
      <p>With <a href='http://www.greenamerica.org/livinggreen/index.cfm'>
      Green America</a>'s Neighborhood Home Repair Teams you can
      build community with your neighbors and trade home improvement
      expertise with others while saving money and resources.</p>
      
      <p>The <a href='http://www.freecycle.org/'>Freecycle Network</a> is
      made up of 5,079 groups with 9,225,139 members around the world.
      It's a grassroots and entirely nonprofit movement of people who are
      giving (and getting) stuff for free in their own towns. It's all
      about reuse and keeping good stuff out of landfills. Each local
      group is moderated by local volunteers (them's good people).
      Membership is free.</p>

</div><!--end page-wrap-->
 
    <footer>
      <div class="row"> 
        <small>A Perry Abramowitz Production | &phone; 800-diy-help | All rights reserved | &copy;2014</small>
      </div>
              
      <div class="row">
        <nav>
        <?php
          if(isset($_SESSION['homeownerid']))
          {
            echo
             "<a id='left' href='about.php'>about</a>
            <a id='center' href='home.php'><span class='icon-home'></span><span class='alt-text'>home</span></a>
            <a id='right' href='terms.php'>terms and conditions</a>";
          }
          else
          {
            echo
             "<a id='left' href='about.php'>about</a>
            <a id='center' href='registration.php'>REGISTER</a>
            <a id='right' href='terms.php'>terms and conditions</a>";
          }
        ?>
        </nav> 
      </div>
    </footer>
  </body>
</html>