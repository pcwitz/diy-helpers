<?php
  session_start(); 
  if(!isset($_SESSION['homeownerid']))
  {
    die("<h3>Sorry, but you are not logged in. Try <a href='index.php'>logging
    in</a> again.</h3>");
  }
?><!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
    <title>New Project</title>
  </head>
  <body>
  <div class="page-wrap">
    <form action="newproject.php" method="post">
      <h1>New Project |<a href='home.php'><span class="icon-home"></span><span class="alt-text">home</span></a>|</h1>
      <br />
      <p class='head'>Project Name:</p>
      <input type = "text" name = "project" maxlength = "30" size = "30" />
      <br /><br />
      <p class='head'>Description:</p>
      <textarea rows=10 cols=80 name="description" wrap="soft"></textarea><br />
      <br />
      <br />
      
      <p class='head'>Project Trades:</p>
      <input type="checkbox" name="trades[]" value="1"/>
      carpentry<br />
    
      <input type="checkbox" name="trades[]" value="2"/>
      electrical<br />
    
      <input type="checkbox" name="trades[]" value="3"/>
      plumbing<br />
    
      <input type="checkbox" name="trades[]" value="4"/>
      flooring<br />
    
      <input type="checkbox" name="trades[]" value="5"/>
      drywalling<br />
    
      <input type="checkbox" name="trades[]" value="6"/>
      painting<br />
    
      <input type="checkbox" name="trades[]" value="7"/>
      remodeling<br />

      <input type="checkbox" name="trades[]" value="8"/>
      window replacement<br />
    
      <input type="checkbox" name="trades[]" value="9"/>
      door hanging<br />

      <input type="checkbox" name="trades[]" value="10"/>
      masonry<br />
    
      <input type="checkbox" name="trades[]" value="11"/>
      demolition<br />
    
      <input type="checkbox" name="trades[]" value="12"/>
      roofing<br />
    
      <input type="checkbox" name="trades[]" value="13"/>
      landscaping
      <br />
      <br />
       
      <p class='head'>Request a Tool from the Shed for this Project: </p>
  <?php
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
  
      //this is all tools of all homeowners not currently being used:
      $query =
      "SELECT toolid, tool FROM tool, homeowner
      WHERE homeowner.homeownerid = tool.homeownerid
      AND projectid = 0";
      $result = mysqli_query($DBConnect, $query);

        while ($row = mysqli_fetch_assoc($result))
        {
          echo "<input type='checkbox' name='tools[]' value='{$row['toolid']}' /> {$row['tool']}<br />";
        }
    
    if (isset($_POST['submit']) && $_POST['submit'] == "create project")
    {
    $project = mysqli_real_escape_string($DBConnect, $_POST["project"]);
    $description = mysqli_real_escape_string($DBConnect, $_POST["description"]);
    $trades = $_POST["trades"];
    $tools = $_POST["tools"];
    $start = date("Y-m-d H:i:s");
    
      if (empty($project) || empty($description))
      {
        echo "<p class='error'>A project name and description are
        required.</p>";
      }  
      else
      {
        $query1 =
        "INSERT INTO project
        (project, description, start, end, homeownerid)
        VALUES ('$project', '$description', '$start', '0000-00-00 00:00:00', {$_SESSION['homeownerid']})";
        $result1 = mysqli_query($DBConnect, $query1);
    
        $query2 =
        "SELECT projectid FROM project";
        $result2 = mysqli_query($DBConnect, $query2);
        $count = mysqli_num_rows($result2);
    
        $query3 =
        "INSERT INTO labors (homeownerid, projectid)
        VALUES ({$_SESSION['homeownerid']}, $count)";
        $result3 = mysqli_query($DBConnect, $query3);
      
    
        if ($trades)
        {   
          foreach ($trades as $trade)
          {
            $query4 =
            "INSERT INTO crafts (projectid, tradeid)
            VALUES ($count, $trade)";
            $result4 = mysqli_query($DBConnect, $query4);

            $query5 =
            "SELECT email FROM homeowner, learns
            WHERE learns.homeownerid = homeowner.homeownerid
            AND tradeid = $trade";
            $result5 = mysqli_query($DBConnect, $query5);
        
            while ($row = mysqli_fetch_assoc($result5))
            {
              $subject = "New DIY Helpers Project: $project";
              $message = "Description: $description\nLogin at www.sis.pitt.edu/~ug2/1059/DIYHelpers/index.php and view new projects on the Project Board.";
              $header = "Cc: diy.schleppers@gmail.com";
              mail ($row['email'], $subject, $message, $header);
            }
          }
        }
        
        if ($tools)
        {   
          foreach ($tools as $tool)
          {
          $query6 =
          "INSERT INTO request (projectid, toolid)
          VALUES ($count, $tool)";
          $result6 = mysqli_query($DBConnect, $query6);
          }
        }

      mysqli_close($DBConnect);
      header('Location: home.php');
      }
    } //ends POST submit 
  } //ends successful DBConnect else statement
  ?>

    <input class="button" type="submit" name = "submit" value = "create project" />
    </form>

    <form action='logout.php' method='post'><input class='logout' type='submit' value='log out' /></form>
  </div><!--end page-wrap-->
 
    <footer>
      <div class="row"> 
        <small>A Perry Abramowitz Production | &phone; 800-diy-help | All rights reserved | &copy;2014</small>
      </div>

      <div class="row">   
        <nav>
          <a id="left" href="projectboard.php"><span class="icon-projectboard"></span><span class="alt-text">project board</span></a>
          <a id="center" href="home.php"><span class="icon-home"></span><span class="alt-text">home</span></a>
          <a id="right" href="toolshed.php"><span class="icon-toolshed"></span><span class="alt-text">tool shed</span></a>
        </nav> 
      </div>
    </footer>
  
  </body>
</html>