<?php
  session_start();
?><!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
    <title>Trade Registration</title>
  </head>
  <body>
<?php
  if(!isset($_SESSION['homeownerid']))
  {
    die("<h3>Sorry, but you are not logged in. Try <a href='index.php'>logging
    in</a> again.</h3>");
  }
  else
  {
    echo "<h2>Congratulations on your decision to become a DIY Helper, {$_SESSION['user']}.
    Please remember your username and password for the future. </h2><br />";
  }
?>
  <h2>Registration (Step Two)</h2>
    <h3>Please make a selection from the buttons below regarding each of the
    trades so we may assess your skill level.  
    </h3>
    
    <?php
    
    if (isset($_POST['submit']) && $_POST['submit'] == "submit")
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
      else
      {
        //code for making radio button for each question sticky e.g., $carpet_no = 'checked'; and value="would never"<?=$carpet_no?, was removed because html5 'required' attribute does not allow incomplete submission.
        //so none are missed.
        $count = 0;

        if ($_POST['carpentry'] == 'would never')
        {
          //$carpet_no = 'checked';
          ++$count;
        }
        else if($_POST['carpentry'] == 'have never')
        {
          //$carpet_maybe = 'checked';
          ++$count;
        }
        else if($_POST['carpentry'] == 'once')
        {
          //$carpet_once = 'checked';
          ++$count;
        }
        else if($_POST['carpentry'] == 'few')
        {
          //$carpet_few = 'checked';
          ++$count;
        }    
        else if($_POST['carpentry'] == 'confident')
        {
          //$carpet_yes = 'checked';
          ++$count;
          $trades[] = 1;
        }
        
        if ($_POST['electrical'] == 'would never')
        {
          //$elect_no = 'checked';
          ++$count;
        }
        else if($_POST['electrical'] == 'have never')
        {
          //$elect_maybe = 'checked';
          ++$count;
        }
        else if($_POST['electrical'] == 'once')
        {
          //$elect_once = 'checked';
          ++$count;
        }
        else if($_POST['electrical'] == 'few')
        {
          //$elect_few = 'checked';
          ++$count;
        }
        else if($_POST['electrical'] == 'confident')
        {
          //$elect_yes = 'checked';
          ++$count;
          $trades[] .= 2;
        }
        
        if ($_POST['plumbing'] == 'would never')
        {
          //$plumb_no = 'checked';
          ++$count;
        }
        else if($_POST['plumbing'] == 'have never')
        {
          //$plumb_maybe = 'checked';
          ++$count;
        }
        else if($_POST['plumbing'] == 'once')
        {
          //$plumb_once = 'checked';
          ++$count;
        }
        else if($_POST['plumbing'] == 'few')
        {
          //$plumb_few = 'checked';
          ++$count;
        }
        else if($_POST['plumbing'] == 'confident')
        {
          //$plumb_yes = 'checked';
          ++$count;
          $trades[] .= 3;
        }
        
        if ($_POST['flooring'] == 'would never')
        {
          //$floor_no = 'checked';
          ++$count;
        }
        else if($_POST['flooring'] == 'have never')
        {
          //$floor_maybe = 'checked';
          ++$count;
        }
        else if($_POST['flooring'] == 'once')
        {
          //$floor_once = 'checked';
          ++$count;
        }
        else if($_POST['flooring'] == 'few')
        {
          //$floor_few = 'checked';
          ++$count;
        }
        else if($_POST['flooring'] == 'confident')
        {
          //$floor_yes = 'checked';
          ++$count;
          $trades[] .= 4;
        }
        
        if ($_POST['drywalling'] == 'would never')
        {
          //$dry_no = 'checked';
          ++$count;
        }
        else if($_POST['drywalling'] == 'have never')
        {
          //$dry_maybe = 'checked';
          ++$count;
        }
        else if($_POST['drywalling'] == 'once')
        {
          //$dry_once = 'checked';
          ++$count;
        }
        else if($_POST['drywalling'] == 'few')
        {
          //$dry_few = 'checked';
          ++$count;
        }
        else if($_POST['drywalling'] == 'confident')
        {
          //$dry_yes = 'checked';
          ++$count;
          $trades[] .= 5;
        }
        
        if ($_POST['painting'] == 'would never')
        {
          //$paint_no = 'checked';
          ++$count;
        }
        else if($_POST['painting'] == 'have never')
        {
          //$paint_maybe = 'checked';
          ++$count;
        }
        else if($_POST['painting'] == 'once')
        {
          //$paint_once = 'checked';
          ++$count;
        }
        else if($_POST['painting'] == 'few')
        {
          //$paint_few = 'checked';
          ++$count;
        }
        else if($_POST['painting'] == 'confident')
        {
          //$paint_yes = 'checked';
          ++$count;
          $trades[] .= 6;
        }
        
        if ($_POST['remodeling'] == 'would never')
        {
          //$mod_no = 'checked';
          ++$count;
        }
        else if($_POST['remodeling'] == 'have never')
        {
          //$mod_maybe = 'checked';
          ++$count;
        }
        else if($_POST['remodeling'] == 'once')
        {
          //$mod_once = 'checked';
          ++$count;
        }
        else if($_POST['remodeling'] == 'few')
        {
          //$mod_few = 'checked';
          ++$count;
        }
        else if($_POST['remodeling'] == 'confident')
        {
          //$mod_yes = 'checked';
          ++$count;
          $trades[] .= 7;
        }
        
        if ($_POST['window'] == 'would never')
        {
          //$win_no = 'checked';
          ++$count;
        }
        else if($_POST['window'] == 'have never')
        {
          //$win_maybe = 'checked';
          ++$count;
        }
        else if($_POST['window'] == 'once')
        {
          //$win_once = 'checked';
          ++$count;
        }
        else if($_POST['window'] == 'few')
        {
          //$win_few = 'checked';
          ++$count;
        }
        else if($_POST['window'] == 'confident')
        {
          //$win_yes = 'checked';
          ++$count;
          $trades[] .= 8;
        }
        
        if ($_POST['door'] == 'would never')
        {
          //$door_no = 'checked';
          ++$count;
        }
        else if($_POST['door'] == 'have never')
        {
          //$door_maybe = 'checked';
          ++$count;
        }
        else if($_POST['door'] == 'once')
        {
          //$door_once = 'checked';
          ++$count;
        }
        else if($_POST['door'] == 'few')
        {
          //$door_few = 'checked';
          ++$count;
        }
        else if($_POST['door'] == 'confident')
        {
          //$door_yes = 'checked';
          ++$count;
          $trades[] .= 9;
        }
        
        if ($_POST['masonry'] == 'would never')
        {
          //$mason_no = 'checked';
          ++$count;
        }
        else if($_POST['masonry'] == 'have never')
        {
          //$mason_maybe = 'checked';
          ++$count;
        }
        else if($_POST['masonry'] == 'once')
        {
          //$mason_once = 'checked';
          ++$count;
        }
        else if($_POST['masonry'] == 'few')
        {
          //$mason_few = 'checked';
          ++$count;
        }
        else if($_POST['masonry'] == 'confident')
        {
          //$mason_yes = 'checked';
          ++$count;
          $trades[] .= 10;
        }
        
        if ($_POST['demolition'] == 'would never')
        {
          //$demo_no = 'checked';
          ++$count;
        }
        else if($_POST['demolition'] == 'have never')
        {
          //$demo_maybe = 'checked';
          ++$count;
        }
        else if($_POST['demolition'] == 'once')
        {
          //$demo_once = 'checked';
          ++$count;
        }
        else if($_POST['demolition'] == 'few')
        {
          //$demo_few = 'checked';
          ++$count;
        }
        else if($_POST['demolition'] == 'confident')
        {
          //$demo_yes = 'checked';
          ++$count;
          $trades[] .= 11;
        }
        
        if ($_POST['landscaping'] == 'would never')
        {
          //$land_no = 'checked';
          ++$count;
        }
        else if($_POST['landscaping'] == 'have never')
        {
          //$land_maybe = 'checked';
          ++$count;
        }
        else if($_POST['landscaping'] == 'once')
        {
          //$land_once = 'checked';
          ++$count;
        }
        else if($_POST['landscaping'] == 'few')
        {
          //$land_few = 'checked';
          ++$count;
        }
        else if($_POST['landscaping'] == 'confident')
        {
          //$land_yes = 'checked';
          ++$count;
          $trades[] .= 12;
        }
        
        if ($_POST['roofing'] == 'would never')
        {
          //$roof_no = 'checked';
          ++$count;
        }
        else if($_POST['roofing'] == 'have never')
        {
          //$roof_maybe = 'checked';
          ++$count;
        }
        else if($_POST['roofing'] == 'once')
        {
          //$roof_once = 'checked';
          ++$count;
        }
        else if($_POST['roofing'] == 'few')
        {
          //$roof_few = 'checked';
          ++$count;
        }
        else if($_POST['roofing'] == 'confident')
        {
          //$roof_yes = 'checked';
          ++$count;
          $trades[] .= 13;
        }
        if ($count == 13)
        {   
          foreach ($trades as $trade)
          {
            $query =
            "INSERT INTO learns (homeownerid, tradeid) VALUES ({$_SESSION['homeownerid']}, $trade)";
            $result = mysqli_query($DBConnect, $query);
          }
          header('Location: tool_registration.php');
        }
        else
        {
          echo "<p class='error'>An answer for each is required.</p>";
        }

        
      }//ends error checking registration else statement
       
    mysqli_close($DBConnect);
    }//ends successful DBConnect else statement
  }//ends POST submit
    
    ?>
    <form action="trade_registration.php" method="post">
      <table> 
      <tr>
      <th>Carpentry</th>
      <td>
      <!-- old way to make things sticky (before html5 'required' attribute) removed: <input required type="radio" name="carpentry" value="would never"<?=$carpet_no?>/> -->
      <input required type="radio" name="carpentry" value="would never">
      would never attempt<br />
      <input type="radio" name="carpentry" value="have never">
      have never tried<br />
      <input type="radio" name="carpentry" value="once">
      done once<br />
      <input type="radio" name="carpentry" value="few">
      done a few times<br />
      <input type="radio" name="carpentry" value="confident">
      confident<br /><br />
      </td>
      <td>
      This is the art of shaping and assembling structural woodwork. From<br />
      knowing the use of a miter saw to framing walls...think wood, wood,<br />
      wood. Have you worked on stairways, door frames, rafters, possibly<br />
      installed some kitchen cabinets?<br /><br />
      </td>
      </tr>

      <tr>
      <th>Electrical</th>
      <td>
      <input required type="radio" name="electrical" value="would never">
      would never attempt<br />
      <input type="radio" name="electrical" value="have never">
      have never tried<br />
      <input type="radio" name="electrical" value="once">
      done once<br />
      <input type="radio" name="electrical" value="few">
      done a few times<br />
      <input type="radio" name="electrical" value="confident">
      confident<br /><br />
      </td>
      <td>
      Electrical work includes replacing outlets, circuit breakers, and<br />
      fixtures.  Changing a light bulb does not quite qualify.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Plumbing</th>
      <td>
      <input required type="radio" name="plumbing" value="would never">
      would never attempt<br />
      <input type="radio" name="plumbing" value="have never">
      have never tried<br />
      <input type="radio" name="plumbing" value="once">
      done once<br />
      <input type="radio" name="plumbing" value="few">
      done a few times<br />
      <input type="radio" name="plumbing" value="confident">
      confident<br /><br />
      </td>
      <td>
      If you can find the main water supply to your house, that's a start.<br />
      It's also good to know how to clear out a clogged pipe with an auger<br />
      or replace a leaky faucet. Perhaps you've even soldered a copper pipe.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Flooring</th>
      <td>
      <input required type="radio" name="flooring" value="would never">
      would never attempt<br />
      <input type="radio" name="flooring" value="have never">
      have never tried<br />
      <input type="radio" name="flooring" value="once">
      done once<br />
      <input type="radio" name="flooring" value="few">
      done a few times<br />
      <input type="radio" name="flooring" value="confident">
      confident<br /><br />
      </td>
      <td>
      Carpet, tile, or hardwood floor coverings serve an important<br />
      function in any home. This could include cutting and measuring other<br />
      floor materials as well, such as rubber, linoleum, and cork.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Drywalling</th>
      <td>
      <input required type="radio" name="drywalling" value="would never">
      would never attempt<br />
      <input type="radio" name="drywalling" value="have never">
      have never tried<br />
      <input type="radio" name="drywalling" value="once">
      done once<br />
      <input type="radio" name="drywalling" value="few">
      done a few times<br />
      <input type="radio" name="drywalling" value="confident">
      confident<br /><br />
      </td>
      <td>
      Drywall and ceiling tile installers hang wallboards to walls and<br />
      ceilings, then prepare the wallboards for painting, using tape and<br />
      other materials.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Painting</th>
      <td>
      <input required type="radio" name="painting" value="would never">
      would never attempt<br />
      <input type="radio" name="painting" value="have never">
      have never tried<br />
      <input type="radio" name="painting" value="once">
      done once<br />
      <input type="radio" name="painting" value="few">
      done a few times<br />
      <input type="radio" name="painting" value="confident">
      confident<br /><br />
      </td>
      <td>
      Really not too many surprises here, but I've personally come across<br />
      a few people that find this task abhorrent. Others find in therapeutic.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Remodeling</th>
      <td>
      <input required type="radio" name="remodeling" value="would never">
      would never attempt<br />
      <input type="radio" name="remodeling" value="have never">
      have never tried<br />
      <input type="radio" name="remodeling" value="once">
      done once<br />
      <input type="radio" name="remodeling" value="few">
      done a few times<br />
      <input type="radio" name="remodeling" value="confident">
      confident<br /><br />
      </td>
      <td>
      If you've done this you may have more than a few talents. The crucial<br />
      part here is having a knack for planning and and an eye for design.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Window Replacement</th>
      <td>
      <input required type="radio" name="window" value="would never">
      would never attempt<br />
      <input type="radio" name="window" value="have never">
      have never tried<br />
      <input type="radio" name="window" value="once">
      done once<br />
      <input type="radio" name="window" value="few">
      done a few times<br />
      <input type="radio" name="window" value="confident">
      confident<br /><br />
      </td>
      <td>
      If you've done this you probably understand the need for agonizing<br />
      over measurements. Still, jamb, stool, sash, stile, it seems that<br />
      windows speak another language.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Door Hanging</th>
      <td>
      <input required type="radio" name="door" value="would never">
      would never attempt<br />
      <input type="radio" name="door" value="have never">
      have never tried<br />
      <input type="radio" name="door" value="once">
      done once<br />
      <input type="radio" name="door" value="few">
      done a few times<br />
      <input type="radio" name="door" value="confident">
      confident<br /><br />
      </td>
      <td>
      Plumbing and shimming the jam may sound like I'm talking about a local<br />
      ska band, but this is also what's involved in hanging a door.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Masonry</th>
      <td>
      <input required type="radio" name="masonry" value="would never">
      would never attempt<br />
      <input type="radio" name="masonry" value="have never">
      have never tried<br />
      <input type="radio" name="masonry" value="once">
      done once<br />
      <input type="radio" name="masonry" value="few">
      done a few times<br />
      <input type="radio" name="masonry" value="confident">
      confident<br /><br />
      </td>
      <td>
      Here we're talking about bricks, blocks, stones, for  fences,<br />
      walkways, walls, etc., and, of course, mixing some mean mortar.<br /><br />
      </td>
      </tr>

      <tr>
      <th>Demolition</th>
      <td>
      <input required type="radio" name="demolition" value="would never">
      would never attempt<br />
      <input type="radio" name="demolition" value="have never">
      have never tried<br />
      <input type="radio" name="demolition" value="once">
      done once<br />
      <input type="radio" name="demolition" value="few">
      done a few times<br />
      <input type="radio" name="demolition" value="confident">
      confident<br /><br />
      </td>
      <td>
      You don't need to be an expert with explosives to be confident with<br />
      demolition...using a jackhammer or leveling a garage is good enough.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Landscaping</th>
      <td>
      <input required type="radio" name="landscaping" value="would never">
      would never attempt<br />
      <input type="radio" name="landscaping" value="have never">
      have never tried<br />
      <input type="radio" name="landscaping" value="once">
      done once<br />
      <input type="radio" name="landscaping" value="few">
      done a few times<br />
      <input type="radio" name="landscaping" value="confident">
      confident<br /><br />
      </td>
      <td>
      Landscaping typically involves a variety of tasks, which may include<br />
      any combination of the following: sod laying, mowing, trimming,<br />
      planting, watering, fertilizing, digging, raking, sprinkler<br />
      installation, and installation of mortarless segmental concrete<br />
      masonry wall units.<br /><br />
      </td>
      </tr>
      
      <tr>
      <th>Roofing</th>
      <td>
      <input required type="radio" name="roofing" value="would never">
      would never attempt<br />
      <input type="radio" name="roofing" value="have never">
      have never tried<br />
      <input type="radio" name="roofing" value="once">
      done once<br />
      <input type="radio" name="roofing" value="few">
      done a few times<br />
      <input type="radio" name="roofing" value="confident">
      confident<br /><br />
      </td>
      <td>
      Heights, <i>shmeits</i>. Roofers repair and install the roofs using a<br />
      variety of materials, including shingles, asphalt, and metal.<br /><br />
      </td>
      </tr>
      </table> 
    <input class="button" type="submit" name = "submit" value = "submit" />
    </form>
  </body>
</html>
