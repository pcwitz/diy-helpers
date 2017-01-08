<?php
  session_start();
?><!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
    <title>Project Page</title>
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

    $projectid = $_GET['projectid'];
    $project = $_GET['project'];
    
    if (isset($_POST['submit']) && $_POST['submit'] == 'post')
    {
      $projectid = $_POST['projectid'];
      $project = $_POST['project'];
      
      $subject = mysqli_real_escape_string($DBConnect, $_POST["subject"]);
      $update = mysqli_real_escape_string($DBConnect, $_POST["update"]);
      
      if (empty($subject) || empty($update))
      {
        echo "<p class='error'>Oops! You must have mistakenly left the
        Subject or Update box blank.</p>";
      }
      else
      {
        $datetime = date("Y-m-d H:i:s");
        $query =
        "INSERT INTO post
        (subject, post, datetime, homeownerid, projectid)
        VALUES
        ('$subject', '$update', '$datetime', {$_SESSION['homeownerid']}, $projectid)";
        $result = mysqli_query($DBConnect, $query);
      }
    }//ends POST submit == post
    $query1 =
    "SELECT description FROM project
    WHERE projectid = $projectid";
    $result1 = mysqli_query($DBConnect, $query1);
       
    echo "<h1>Project: $project |<a href='home.php'><span class='icon-home'></span><span class='alt-text'>home</span></a>|</h1>";
    echo "<p class='descript'>Description:\n";
      while ($row = mysqli_fetch_assoc($result1))
      {
        echo "{$row['description']}</p>\n";
      }
    echo "<br /><br />";
    
    //show who labors on this project
    $query2 =
    "SELECT fname, lname FROM homeowner, labors
    WHERE homeowner.homeownerid = labors.homeownerid
    AND projectid = $projectid";
    $result2 = mysqli_query($DBConnect, $query2);
    
    //shows trades involved with this project
    $query3 =
    "SELECT trade FROM crafts, trade
    WHERE crafts.tradeid = trade.tradeid
    AND projectid = $projectid";
    $result3 = mysqli_query($DBConnect, $query3);
    
    //show tools involved with this project
    $query4 =
    "SELECT tool FROM tool
    WHERE tool.projectid = $projectid";
    $result4 = mysqli_query($DBConnect, $query4);
    
    //shows start date
    $query5 =
    "SELECT start FROM project
    WHERE projectid = $projectid";
    $result5 = mysqli_query($DBConnect, $query5);
    
    //show finish date, if finished
    $query6 =
    "SELECT end FROM project
    WHERE projectid = $projectid";
    $result6 = mysqli_query($DBConnect, $query6);

    echo "<div class='right'><h2>Project Summary</h2>";
    
    $query =
    "SELECT laborid FROM labors WHERE homeownerid={$_SESSION['homeownerid']}
    AND projectid=$projectid";
    $result = mysqli_query($DBConnect, $query);
    $count = mysqli_num_rows($result);
    
    /*this part (Join this Project) only gets revealed if the homeowner is has
    not already joined this project   */
    echo "<p class='head'>";
    if ($count != 1)
    {
      echo "<a href='joinproject.php?projectid=$projectid&project=$project'>|Join this Project|</a><br />";
    }
      echo "DIY Helpers</p>";
      while ($row = mysqli_fetch_assoc($result2))
      {
        echo "{$row['fname']} ";
        echo "{$row['lname']}<br />";
      }
    
    echo "<p class='head'>Trades</p>";
      while ($row = mysqli_fetch_assoc($result3))
      {
        echo "{$row['trade']}<br />";
      }

    echo "<p class='head'>Tools</p>";
      while ($row = mysqli_fetch_assoc($result4))
      {
        echo "{$row['tool']}\n<br />";
      }
      
      $query7 = "SELECT projectid FROM project WHERE projectid=$projectid
      AND homeownerid={$_SESSION['homeownerid']} AND end='0000-00-00 00:00:00'";
      $result7 = mysqli_query($DBConnect, $query7);
      $count = mysqli_num_rows($result7);
    
      /*this part (Request Tool) only gets revealed if the homeowner is viewing
      his own project                                                   */                                   
      if ($count==1) 
      {      
        echo "<a href='project.php?request=request&projectid=$projectid&project=$project'>|Request Tool|</a><br />";
      }
    
      if (isset($_GET['request']) && $_GET['request'] == 'request')
      {          
        $query8 =
        "SELECT toolid, tool FROM tool, homeowner
        WHERE homeowner.homeownerid = tool.homeownerid
        AND projectid = 0";
        $result8 = mysqli_query($DBConnect, $query8);

        while ($row = mysqli_fetch_assoc($result8))
        {
          echo "<div class='request'>";
          echo "<div class='reqleft'><a href='toolrequest.php?toolid={$row['toolid']}&projectid=$projectid&project=$project'>|request|</a>\n</div>";
          echo "<div class='reqright'>{$row['tool']}\n</div>";
          echo "</div><br />"; //ends .request div
          
        }
    
      }

    echo "<p class='head'>Started</p>";
      while ($row = mysqli_fetch_assoc($result5))
      {
        echo "{$row['start']}\n";
      }
      
    while ($row = mysqli_fetch_assoc($result6))
    {
      if ($row['end'] == '0000-00-00 00:00:00')
      {
        echo "<p class='head'>Status: Active</p>";
      }
      else
      {
        echo "<p class='head'>Finished</p>";
        echo "{$row['end']}\n";
      }    
    }

    echo "</div>"; //ends .right div

    $query9 =
    "SELECT fname, lname, subject, post, datetime FROM post, homeowner
    WHERE post.homeownerid = homeowner.homeownerid
    AND projectid = $projectid";
    $result9 = mysqli_query($DBConnect, $query9);
       
    echo "<h2>Project Tracking</h2>
    <table>\n";
    $update = 1;
      while ($row = mysqli_fetch_assoc($result9))
      {
        echo "<tr><th>Update $update:  {$row['subject']}<br />";
        echo "by {$row['fname']} {$row['lname']}<br />";
        echo "{$row['datetime']}</th></tr>\n";
        echo "<tr><td>{$row['post']}<br /><br /><br /></td></tr>\n";
        ++$update;
      }
    echo "</table>\n<br /><br /><br />";
    
    $query10 = 
    "SELECT laborid
    FROM labors
    WHERE homeownerid = {$_SESSION['homeownerid']}
    AND projectid = $projectid";
    $result10 = mysqli_query($DBConnect, $query10);
    $count = mysqli_num_rows($result10);

    if ($count==1) 
    { 
      echo
      "<h2>Project Update</h2>
        
      <form action='project.php' method='post'>
      Subject:
      <br />
      <input type = 'text' name = 'subject' maxlength = '50' size = '50' />
      <br /><br />
        
      Update:<br />
      <textarea rows=10 cols=80 name='update' wrap='soft'></textarea><br />
      <br />
      <input type='hidden' name='projectid' value='$projectid'>
      <input type='hidden' name='project' value='$project'>
      <input class='button' type='submit' name='submit' value='post' />
      </form>";
    }

    mysqli_close($DBConnect);
    }//end successful DBSelect else statement
  }//ends successful DBConnect else statement

?>
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
    </footer>
  </body>
</html>