<?php
  session_start(); 
?><!DOCTYPE html>
<html lang=en>
  <head>       
    <meta charset=utf-8>
    <title>DIY Helpers Login</title>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
  </head>
  <body>
  <div class="page-wrap">
    
  <?php
    if (isset($_POST['submit']) && $_POST['submit'] == 'Login')
    {
    include("_/connect.php");
    
    if ($DBConnect === FALSE)
    {
      die("<p>Connection error: " . mysqli_error() . "</p>\n");
    }
    else
    {
      if ($DBSelect === FALSE)
      {
      die("<p>Could not select the \"$DBName\" " . "database: " . 
      mysqli_error($DBConnect) . "</p>\n"); 
      }
      $user = mysqli_real_escape_string($DBConnect, $_POST["user"]);
      $sword = sha1($_POST["sword"]);

      $query = "SELECT * FROM sword WHERE username='$user' AND sword='$sword'";
      $result = mysqli_query($DBConnect, $query);
      $count = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result))
      {
        $ownerid = $row['homeownerid'];
        $_SESSION['homeownerid'] = $ownerid;
      }
      if ($count===1) 
      {   
        header('Location: home.php');
      }
      else
      {
        echo "<p class='error'>Your username and password are not on record. Perhaps you
        would like to try again or <a href='registration.php'>Register</a>.</p>";
      }
    mysqli_close($DBConnect);
    }//ends successful DBConnect else statement
  }//ends POST submit   
  ?>
    <div class="row"> 
      <header class="nologout">
        <div class="col-1">
          <div id="headleft">
            <h1 id="main">Do-It-Yourself Helpers</h1>
          </div>

          <span id="sub">The semi-exotic oxymoronic blending of DIY and helping out will not only thrive in your community, it will thrive in your damn heart.</span>
        </div>        
      </header>
    </div>
    
<div class="row">
  <div class="col-1">
    <form id="login" action="index.php" method="post">
      <table class="login">
        <tr>
          <td>Username:</td>
          <td><input type="text" name="user" maxlength="10" size="10"/>
          <small>(between 4 and 10 characters)</small></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input type="password" name="sword" maxlength="10" size="10"/>
          <small>(between 4 and 10 characters)</small>
          </td>
        </tr>
      </table>
  <div id="submit">
    <input class="button" type="submit" name = "submit" value = "Login" />

    </form>

    <h4>If you are new to the DIY Helpers community, please join us:
    <a href='registration.php'>Register</a>.</h4>
  </div>
    
  </div>
</div>
    <section>
    <p>DO-IT-YOURSELF is defined as the activity of doing home repair without
    professional training or assistance; broadly: an activity in which one
    does something oneself or on one's own initiative.</p>
    <p>But we at DIY Helpers would like to transform this definition by insisting
    that this activity does not necessarily have to be done by one's self, for
    one's self, as a selfish, self-serving celebration of self...at least we
    intend to make it that way.</p>
    <p>At Do-It-Yourself Helpers, DIYers are in it together, as a community,
    learning and helping each other.  It is a location based community home
    improvement program.  You have a project and you post it to the Project
    Board and others can offer to assist you with one of your projects, if
    they feel they can contribute. You may
    also choose to help in another's project (because you always wanted to
    build a brick wall, for example). Yet preexisting skills are not a
    requirement, but wanting to learn for yourself is mandatory. The first
    step is registration. This will allow your local DIY community to
    understand your skill level as well as align you with DIY Helpers in
    your neighborhood. Then you can add your own project to the Project Board
    and see what home improvement projects others have posted as well.</p>
    </section>

  </div><!--end page-wrap-->
    
    <footer>
      <div class="row">
        <small>A Perry Abramowitz Production | &phone; 800-diy-help | All rights reserved | &copy;2014</small>
      </div>

      <div class="row">   
        <nav>
          <a id="left" href="about.php">about</a>
          <a id="center" href="resources.php">resources</a>
          <a id="right" href="terms.php">terms and conditions</a>
        </nav> 
      </div>

      <div class="row">   
        <nav class="socialmedia"></nav> 
      </div>
    </footer>

  <script src="js/socialmedia.js"></script>
  
  </body>
</html>

