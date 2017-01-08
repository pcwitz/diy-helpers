<?php
  session_start(); 
?><!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
    <title>Project Board</title>
  </head>
  <body>
  <div class="page-wrap">

<?php
  if(!isset($_SESSION['homeownerid']))
  {
    die("<h3>Sorry, but you are not logged in. Try <a href='index.php'>logging
    in</a> again.</h3>");
  }
  else
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
      
      echo "<h1>Project Board |<a href='home.php'><span class='icon-home'></span><span class='alt-text'>home</span></a>|</h1>";
      echo "<h2>Active |<a href='completeproject.php'>Completed</a>|</h2>";
      
      $query =
      "SELECT projectid, project, description, fname, lname
      FROM project, homeowner
      WHERE project.homeownerid = homeowner.homeownerid
      AND end = '0000-00-00 00:00:00'
      ORDER BY projectid DESC";
      $result = mysqli_query($DBConnect, $query);
      
      echo "<table>\n";
      while ($row = mysqli_fetch_assoc($result))
      {
        echo "<tr><td><a href='project.php?projectid={$row['projectid']}&project={$row['project']}'>{$row['project']}</a>: \n";
        echo "{$row['description']}\n<br />";
        echo "-a {$row['fname']} ";
        echo "{$row['lname']} home production</td></tr>\n";
      }
      echo "</table>\n<br /><br /><br />";
    
    echo
    "<form action='logout.php' method='post'><input class='logout' type='submit' value='log out' /></form>";
    
    mysqli_close($DBConnect);
    }//ends successful DBConnect else statement
  }//ends session else statement
?>
 </div><!--end page-wrap-->
 
    <footer>
      <div class="row"> 
        <small>A Perry Abramowitz Production | &phone; 800-diy-help | All rights reserved | &copy;2014</small>
      </div>
      
      <div class="row">   
        <nav>
          <a id="left" href="newproject.php"><span class="icon-newproject"></span><span class="alt-text">new project</span></a>
          <a id="center" href="home.php"><span class="icon-home"></span><span class="alt-text">home</span></a>
          <a id="right" href="toolshed.php"><span class="icon-toolshed"></span><span class="alt-text">tool shed</span></a>
        </nav> 
      </div>
    </footer>
  </body>
</html>