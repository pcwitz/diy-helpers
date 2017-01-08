<?php
  session_start();
?><!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
    <title>Tool Registration</title>    
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
    echo "<h2>{$_SESSION['user']} Registration (Final Step)</h2>";
  }
?>
  <?php
    if (isset($_POST['submit']) && $_POST['submit'] == 'skip')
    {
      header('Location: home.php');
    }
    if (isset($_POST['submit']) && $_POST['submit'] == 'submit')
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
      $tools = $_POST["tools"];

      if ($tools)
      {   
        foreach ($tools as $tool)
        {
          $query =
          "INSERT INTO tool (tool, projectid, homeownerid)
          VALUES ('$tool', 0, {$_SESSION['homeownerid']})";
          $result = mysqli_query($DBConnect, $query);
        }
        header('Location: home.php');
      }
      else
      {
        echo "<p class='error'>It is perfectly OK to opt out of the tool
        swap program. Just click the 'skip' button and your
        registration will be complete.</p>";
      }
  
    mysqli_close($DBConnect);
    }//ends successful DBConnect else statement
  }//ends POST submit
    
  ?>
    <h2>DIY Helpers Toolshed</h2>
      <h3>If you would like to be involved in a tool swap, check the tools below
      that you own and would like to lend out on condition that other DIY Helpers
      reciprocate by lending you their tools.
      </h3>
    
    <form action="tool_registration.php" method="post">
      
    <!--Remember to list alphabetically! These are hard-coded and tools will
    be added regularly.-->
    <input type="checkbox" name="tools[]" value="air compressor" />
    air compressor<br />
    
    <input type="checkbox" name="tools[]" value="caulk gun" />
    caulk gun<br />
    
    <input type="checkbox" name="tools[]" value="cement mixer" />
    cement mixer<br />
    
    <input type="checkbox" name="tools[]" value="circular saw" />
    circular saw<br />
    
    <input type="checkbox" name="tools[]" value="floor sander" />
    floor sander<br />
    
    <input type="checkbox" name="tools[]" value="drain auger" />
    drain cleaner auger<br />
    
    <input type="checkbox" name="tools[]" value="grout float" />
    grout float<br />
    
    <input type="checkbox" name="tools[]" value="hammer drill" />
    hammer drill<br />
    
    <input type="checkbox" name="tools[]" value="jigsaw" />
    jigsaw<br />
    
    <input type="checkbox" name="tools[]" value="ladder (24 ft.)" />
    ladder (24 ft.)<br />
    
    <input type="checkbox" name="tools[]" value="log splitter" />
    log splitter<br />
    
    <input type="checkbox" name="tools[]" value="miter saw" />
    miter saw<br />
    
    <input type="checkbox" name="tools[]" value="nail gun" />
    nail gun<br />
    
    <input type="checkbox" name="tools[]" value="pressure washer" />
    pressure washer<br />
    
    <input type="checkbox" name="tools[]" value="pry bar" />
    pry bar<br />
    
    <input type="checkbox" name="tools[]" value="ratcheting wrench set" />
    ratcheting wrench set<br />
    
    <input type="checkbox" name="tools[]" value="right angle drill" />
    right angle drill<br />
    
    <input type="checkbox" name="tools[]" value="scaffolding (12 ft.)" />
    scaffolding (12 ft.)<br />
    
    <input type="checkbox" name="tools[]" value="staple gun" />
    staple gun<br />
    
    <input type="checkbox" name="tools[]" value="stud finder" />
    stud finder<br />
    
    <input type="checkbox" name="tools[]" value="tile saw" />
    tile saw<br />
    
    <input type="checkbox" name="tools[]" value="wire cutter" />
    wire cutter

    <p>If you own a tool that is not listed, please suggest a new tool for
    the DIY Helpers Toolshed:
    <a href="mailto:diy.schleppers@gmail.com?Subject=DIY%20Helpers%20Tool%20Suggestion&body=I%20own%20the%20following%20tools%20and%20would%20like%20to%20share%20them%20with%20others%20by%20adding%20them%20to%20the%20DIY%20Helpers%20Toolshed.%20Please%20include%20a%20description%20of%20each%20tool%20as%20well:">
    New Tool</a>.</p>
    <br />
    <br />
    <input class="button" type="submit" name="submit" value="submit"/>or
    <input class="button" type="submit" name="submit" value="skip"/>
    </form>
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