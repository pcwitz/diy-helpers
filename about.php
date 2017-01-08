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
            if(isset($_SESSION['homeownerid'])) {
              echo
               "<a id='left' href='resources.php'>resources</a>
              <a id='center' href='home.php'><span class='icon-home'></span><span class='alt-text'>home</span></a>
              <a id='right' href='terms.php'>terms and conditions</a>";
            }
            else {
              echo
               "<a id='left' href='resources.php'>resources</a>
              <a id='center' href='registration.php'>REGISTER</a>
              <a id='right' href='terms.php'>terms and conditions</a>";
            }
          ?>
          </nav> 
        </div>
      </div>

    <?php include('_/header.php'); ?>
    
    <h2>Neighborhood Home Improvement Projects.</h2>
    
    <p>We all know "two is better than one" and "the more the merrier." This is
    especially true when it comes to home improvement projects. How about
    an application (tool) that pairs neighborhood talent with neighborhood
    talent and brings encouragement and expertise to your own home
    improvement projects? A barter system for DIY-ers (Do It
    Yourselfers).</p>
    
    <p>The truth is that a fellow or gal may like to get out of the
    house and help another if he or she has a project that he or she needs an
    extra hand with...I believe the term is reciprocity. There are also
    plenty of folks out there that want to learn some home improvement
    techniques, i.e., dry walling, putting up ceiling fans, changing bathtub
    faucets, replacement windows, etc. and watching another do it with the
    intention of helping out (to the best of one's ability) is an excellent
    opportunity for learning. I've known a few plumbers-by-night or
    electricians-by-night that have a day job at the office, but
    nevertheless enjoy getting down to the nitty gritty when need be rather
    than calling a "professional" for help. Usually calling the "expert" is
    outrageously expensive, and, coupled with the knowledge that it ain't
    brain surgery, many look for an alternative. There is a lot to learn
    when it comes to keeping up the house, especially in my neighborhood
    where the median age of a home is 90 years old.</p>
    
    <h2>Features:</h2>
    
    <p>Feature #1: Registration (in 3 Parts). Firstly, we ask for basic contact
    information: name, email, etc., yet we also ask for home address; and you
    will see in Feature #3 why this is necessary. Secondly, we determine the
    homeowner's skill level with a short assessment of home projects based
    on previous exposure. Lastly, we give each homeowner the option of
    contributing tools to the DIY Helpers Toolshed to be shared among members.</p>
    
    <p>Feature #2: Project Board. This is an interface that facilitates the
    posting of neighborhood projects and various details that may interest
    someone in helping out. The homeowner posts a description of a project,
    any special skills or trades that would be beneficial to the project,
    and finally, requests any tools currently available in the DIY Helpers
    Toolshed that would be of use to the project.  In addition, when a new
    project is posted, DIY Helpers members that have skills well-suited to
    the new project are sent an email notification.</p>
    
    <p>Feature #3: Project Tracking.  Once a home improvement project is
    posted, the Project Page gives a summary of progress by allowing the
    project owner (as well as anyone from the DIY Helpers community who has
    joined the project) to post updates on the project. When a DIY Helper
    decides to join a neighbor's project, the owner of the project is sent
    an email notification. The Project Summary will list all DIY Helpers,
    trades, and tools involved with the project, as well as start and finish
    dates.
    
    <p>Feature #4: The Toolshed. This is a virtual storage shed where
    homeowners have the option to offer up their own tools to be shared by
    other members, if requested. The owner has the option to lend or deny,
    and indeed, whether to participate at all. The borrowing and lending
    workflow consists of a request by a potential borrower, the response
    of the tool owner; and, if the owner chooses to lend the tool, a final
    step where the owner confirms the tool has been returned. Only at the
    point where the tool is in the owner's possession should the return of
    the tool be confirmed. At that point the tool is returned to the virtual
    shed and once again made available for use by another project. It may
    take some folks a little getting used to borrowing one's <i>own</i> tool
    from the DIY Helpers Toolshed. Keep in mind that the tools in the
    toolshed are shared by all and if you need your tool for your own
    project, you will need to check it out to your own project so it is not
    available for others.
    </p>

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
             "<a id='left' href='resources.php'>resources</a>
            <a id='center' href='home.php'><span class='icon-home'></span><span class='alt-text'>home</span></a>
            <a id='right' href='terms.php'>terms and conditions</a>";
          }
          else
          {
            echo
             "<a id='left' href='resources.php'>resources</a>
            <a id='center' href='registration.php'>REGISTER</a>
            <a id='right' href='terms.php'>terms and conditions</a>";
          }
        ?>
        </nav> 
      </div>
    </footer>
  </body>
</html>