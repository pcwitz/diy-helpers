<?php
  session_start(); 
?><!DOCTYPE html>
<html lang=en>
  <head>       
    <meta charset=utf-8>
    <title>DIY Helpers | Home</title>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
  </head>
  <body>
  <div class="page-wrap">

    <div class="row">
      <div class="icon-homeowner">
        <ul id="submenu">
          <li><a href="profile.php">profile</a></li>
          <li><a href="logout.php">logout</a></li>
        </ul> <!-- end submenu -->
      </div> <!-- end homeowner icon -->
    </div> <!-- end row -->
  
    <div class="row"> 
      <header>
        <div class="col-1">
          <div id="headleft">
            <h1 id="main">Do-It-Yourself Helpers</h1>
            <input type=search name=s placeholder="search projects">
          </div>

          <span id="sub">The semi-exotic oxymoronic blending of DIY and helping out will not only thrive in your community, it will thrive in your damn heart.</span>
        </div>        
      </header>
    </div>
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

      if (isset($_POST['end']) && $_POST['end'] == 'move to completed')
      {
        $completed = $_POST['completed'];
        if (empty($completed))
        {
          echo "<p class='error'>If you would like to change a project's
          status to completed, check the box and submit using the 'project
          completed' button.</p>";
        }
        else
        {
          $end = date("Y-m-d H:i:s");
          foreach ($completed as $complete)
          {
            $query =
            "UPDATE project
            SET end='$end'
            WHERE end='0000-00-00 00:00:00'
            AND projectid=$complete";
            $result = mysqli_query($DBConnect, $query);
          }
        }
      }
    //beautiful spanning img
    echo 
    "<div class='imgrow'>   
      <div class='col-1'>
        <nav>
          <a id='left' href='about.php'>about</a>
          <a id='center' href='resources.php'>resources</a>
          <a id='right' href='terms.php'>terms and conditions</a>
          
          <a id='board' href='projectboard.php'><span class='icon-arrowleft'></span>project board</a>
          <a id='toolshed' href='toolshed.php'>toolshed<span class='icon-arrowright'></span></a>
          
          <img src='images/level.gif' width='900' height='88'>
        </nav> 
      </div>
    </div>";
    
    /*echo "<p><b>Welcome HOME!</b></p>";
    $query = "SELECT lname, address, city, state, zip FROM homeowner WHERE homeownerid={$_SESSION['homeownerid']}";
    $result = mysqli_query($DBConnect, $query);

      while ($row = mysqli_fetch_assoc($result))
      {
        echo "The {$row['lname']} Residence\n<br>";
        echo "{$row['address']}<br>\n";
        echo "{$row['city']}, \n";
        echo "{$row['state']}  \n";
        echo "<tr><td>{$row['zip']}\n";
      }                                                                 */
  echo
  "<div class='row'>
    <div class='col-1-3'>
    <h3>Your Home Projects</h3>

    <section>
    <ul>";
  
    $query1 =
    "SELECT projectid, project FROM project
    WHERE homeownerid={$_SESSION['homeownerid']}
    AND end = '0000-00-00 00:00:00'";
    $result1 = mysqli_query($DBConnect, $query1);
    
    echo "<form action='home.php' method='post'>";
      while ($row = mysqli_fetch_assoc($result1))
      {
        echo "<li class='home'><input type='checkbox' name='completed[]'value='{$row['projectid']}'/><a href='project.php?projectid={$row['projectid']}&project={$row['project']}'>&nbsp;&nbsp;{$row['project']}</a></td></tr></li>";
      }
    echo "</ul>";
    echo "&check;<input class='button completed' type='submit' name='end' value='move to completed'/>";
    echo "<a id='new' href='newproject.php'>New Project<span class='icon-newproject min'></span></a>";
    echo "</section>";
    echo "</form>";
    echo "</div>";//end Your Home Projects column
    
    echo "<div class='col-1-3'>
        <h3>DIY Helper Projects</h3>
        <section id='helper'>
        <ul>";
    
    $query2 =
    "SELECT project.projectid, project FROM labors, project
    WHERE labors.projectid = project.projectid
    AND labors.homeownerid={$_SESSION['homeownerid']}
    AND project.homeownerid<>{$_SESSION['homeownerid']}";
    $result2 = mysqli_query($DBConnect, $query2);
    
      while ($row = mysqli_fetch_assoc($result2))
      {
        echo "<li class='home'><a href='project.php?projectid={$row['projectid']}&project={$row['project']}'>{$row['project']}</a></li>";
      }
    echo "</ul><a id='join' href='projectboard.php'>Project Board<span class='icon-projectboard min'></span></a>";
    echo "</section>";
    echo "</div>";//end DIY Helper Projects column
    
    echo "<div class='col-1-3'>
        <h3>In Your Toolbox</h3>
        
        <section>
        <ul>";
    
    $query3 =
    "SELECT tool, fname, lname, address, email, project.projectid, project FROM tool, project, homeowner
    WHERE homeowner.homeownerid = tool.homeownerid
    AND tool.projectid = project.projectid
    AND project.homeownerid = {$_SESSION['homeownerid']}";
    $result3 = mysqli_query($DBConnect, $query3);

      while ($row = mysqli_fetch_assoc($result3))
      {
        echo "<li class='home'>&nbsp;&nbsp;{$row['tool']}</li>";
      }
    echo "</ul><a id='swap' href='toolshed.php'>Tool Swap<span class='icon-toolshed min'></span></a>";
    echo "</section>";
    echo "</div>";//end DIY Helper Projects column
    
    echo "</div>";//end 3 column row
    mysqli_close($DBConnect);
    }//ends successful DBConnect else statement
  }
?>
  </div><!--end page-wrap--> 

    <footer>
      <div class="row"> 
        <small>A Perry Abramowitz Production | &phone; 800-diy-help | All rights reserved | &copy;2014</small>
      </div>
    </footer>

  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="js/dropdown.js"></script>
  
  </body>
</html>
