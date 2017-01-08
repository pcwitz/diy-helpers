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
    <title>Toolshed</title>
  </head>
  <body>
  <div class="page-wrap">
    <h1>Toolshed |<a href="home.php"><span class="icon-home"></span><span class="alt-text">home</span></a>|</h1>
    <br />
  
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
    //this will process the tool swap:
    if ($_GET['lend'])
    {
      $query =
      "UPDATE tool
      SET projectid={$_GET['projectid']}
      WHERE toolid={$_GET['lend']}";
      $result = mysqli_query($DBConnect, $query);
      
      $query1 =
      "DELETE FROM request
      WHERE projectid={$_GET['projectid']}
      AND toolid={$_GET['lend']}";
      $result1 = mysqli_query($DBConnect, $query1);
    }
    
    if ($_GET['deny'])
    {
      $query2 =
      "DELETE FROM request
      WHERE projectid={$_GET['projectid']}
      AND toolid={$_GET['deny']}";
      $result2 = mysqli_query($DBConnect, $query2);
    }
    
    if ($_GET['returned'])
    {
      $query3 =
      "UPDATE tool
      SET projectid=0
      WHERE toolid={$_GET['returned']}";
      $result3 = mysqli_query($DBConnect, $query3);
    }
    
      
    //this is everything the homeowner is using in projects, including his own.
    echo "<div class='clear'><p class='descript'>In Your Toolbox</p>";
    $query4 =
    "SELECT tool, fname, lname, address, email, project.projectid, project FROM tool, project, homeowner
    WHERE homeowner.homeownerid = tool.homeownerid
    AND tool.projectid = project.projectid
    AND project.homeownerid = {$_SESSION['homeownerid']}";
    $result4 = mysqli_query($DBConnect, $query4);

    echo "<table><tr><th>Tool</th><th>Project</th><th>Owner</th></tr>\n";
      while ($row = mysqli_fetch_assoc($result4))
      {
        echo "<tr><td>{$row['tool']}</td>\n";
        echo "<td><a href='project.php?projectid={$row['projectid']}&project={$row['project']}'>{$row['project']}</a></td>\n";
        echo "<td>{$row['fname']}\n";
        echo "{$row['lname']}<br />\n";
        echo "{$row['address']}<br />\n";
        echo "<a href='mailto:{$row['email']}?Subject=DIY Helpers Tool: {$row['tool']}'>{$row['email']}</a></td></tr>\n";
      }
    echo "</table></div>";
    
    //this is all tools for this homeowner currently in use, even by the homeowner herself:
    echo "<div class='clear'><p class='descript'>Your Tools on Loan</a></p>";
    $query5 =
    "SELECT toolid, tool, fname, lname, address, email, project.projectid, project FROM tool, homeowner, project
    WHERE homeowner.homeownerid = project.homeownerid
    AND tool.projectid = project.projectid
    AND tool.homeownerid = {$_SESSION['homeownerid']}
    AND tool.projectid <> 0";
    $result5 = mysqli_query($DBConnect, $query5);

    echo "<table><tr><th>On Loan</th><th>Tool</th><th>Borrower</th><th>Project</th></tr>\n";
      while ($row = mysqli_fetch_assoc($result5))
      {
        echo "<tr><td><a href='toolshed.php?returned={$row['toolid']}&projectid={$row['projectid']}'>|returned|</a></td>\n";
        echo "<td>{$row['tool']}</td>\n";
        echo "<td>{$row['fname']}\n";
        echo "{$row['lname']}<br/>\n";
        echo "{$row['address']}<br/>\n";
        echo "<a href='mailto:{$row['email']}?Subject=DIY Helpers Tool: {$row['tool']}'>{$row['email']}</a></td>\n";
        echo "<td><a href='project.php?projectid={$row['projectid']}&project={$row['project']}'>{$row['project']}</a></td></tr>\n";
      }
    echo "</table></div>";
    
    //this is all tools for this homeowner being requested by another homeowner
    echo "<div class='clear'><p class='descript'>Tool Requests</a></p>";
    $query6 =
    "SELECT tool.toolid, tool, fname, lname, address, email, project.projectid, project
    FROM request, homeowner, project, tool
    WHERE request.projectid = project.projectid
    AND homeowner.homeownerid = project.homeownerid
    AND request.toolid = tool.toolid
    AND tool.homeownerid = {$_SESSION['homeownerid']}";
    $result6 = mysqli_query($DBConnect, $query6);

    echo "<table><tr><th>Response</th><th>Tool</th><th>Borrower</th><th>Project</th></tr>\n";
      while ($row = mysqli_fetch_assoc($result6))
      {
        echo "<tr><td><a href='toolshed.php?lend={$row['toolid']}&projectid={$row['projectid']}'>|lend|</a>\n";
        echo "<a href='toolshed.php?deny={$row['toolid']}&projectid={$row['projectid']}'>|deny|</a></td>\n";
        echo "<td>{$row['tool']}</td>\n";
        echo "<td>{$row['fname']}\n";
        echo "{$row['lname']}<br/>\n";
        echo "{$row['address']}<br />\n";
        echo "<a href='mailto:{$row['email']}?Subject=DIY Helpers Tool: {$row['tool']}'>{$row['email']}</a></td>\n";
        echo "<td><a href='project.php?projectid={$row['projectid']}&project={$row['project']}'>{$row['project']}</a></td></tr>\n";
      }
    echo "</table></div>";
    
    //this is all tools of all homeowners not currently being used:
    echo "<div class='clear'><p class='descript'>Tools in the DIY Helpers' Shed </p>";
    $query7 =
    "SELECT tool FROM tool, homeowner
    WHERE homeowner.homeownerid = tool.homeownerid
    AND projectid = 0 ORDER BY tool";
    $result7 = mysqli_query($DBConnect, $query7);

    echo "<table>\n";
      while ($row = mysqli_fetch_assoc($result7))
      {
        echo "<tr><td>{$row['tool']}</td></tr>\n";
      }
        echo "<tr><td class='center'><a href='tool_registration.php'>[add a tool you own to the DIY Helpers shed]</a></td></tr>";
    echo "</table></div>";        
    mysqli_close($DBConnect);
    }//ends successful DBConnect else statement
?>
  </div><!--end page-wrap-->

  <div class="row">  
  <footer>
    <small>A Perry Abramowitz Production | &phone; 800-diy-help | All rights reserved | &copy;2014</small>
        
    <div class="row">   
      <div class="col-1">
      <nav>
        <a id="left" href="newproject.php"><span class="icon-newproject"></span><span class="alt-text">new project</span></a>
        <a id="center" href="home.php"><span class="icon-home"></span><span class="alt-text">home</span></a>
        <a id="right" href="projectboard.php"><span class="icon-projectboard"></span><span class="alt-text">project board</span></a>
      </nav> 
      </div>
    </div>
  </footer>
  </div>

  </body>
</html>