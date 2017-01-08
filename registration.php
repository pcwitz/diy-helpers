<?php
  session_start();
?><!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
    <title>DIY Helpers Registration</title>    
  </head>
  <body>   
  <div class="page-wrap">

      <div class="row">   
        <div class="col-1">
          <nav> <!-- does not need if-else because never a case when you will register if you're logged in. -->
            <a id='left' href='about.php'>about</a>
            <a id='center' href='resources.php'>resources</a>
            <a id='right' href='terms.php'>terms and conditions</a>
          </nav> 
        </div>
      </div>

    <div class="row"> 
      <header class="nologout">
        <div class="col-1">
          <div id="headleft">
            <h1><a href="index.php">Do-It-Yourself Helpers</a></h1>
          </div>

          <span id="sub">The semi-exotic oxymoronic blending of DIY and helping out will not only thrive in your community, it will thrive in your damn heart.</span>
        </div>        
      </header>
    </div>
    
    <h2>Join the Do-It-Yourself Helpers Community</h2>

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

    <p>If you are already a member, please <a href='index.php'>Login</a>.</p>
    <br />
    
    <h2>Registration (in 3 Simple Steps)</h2>
    <h4>Please complete the fields below.  All are required.</h4>
    
  <?php
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
      
      $fname = mysqli_real_escape_string($DBConnect, $_POST["fname"]);
      $lname = mysqli_real_escape_string($DBConnect, $_POST["lname"]);
      $user = mysqli_real_escape_string($DBConnect, $_POST["user"]);
      $sword = mysqli_real_escape_string($DBConnect,$_POST["sword"]);
      $address = mysqli_real_escape_string($DBConnect, $_POST["address"]);
    //making email address lowercase in all cases:
      $tempmail = mysqli_real_escape_string($DBConnect, $_POST["email"]);
      $email = strtolower($tempmail);
      $city = mysqli_real_escape_string($DBConnect, $_POST["city"]);
      $state = mysqli_real_escape_string($DBConnect, $_POST["state"]);
      $zip = mysqli_real_escape_string($DBConnect, $_POST["zip"]);
          
      if (empty($fname) || empty($lname)|| empty($address)|| empty($city)|| empty($state)|| empty($zip) || empty($email))
      {
        echo "<p class='error'>Please try again to register below. All fields are
        required.</p>";
      }  
      
      else if (empty($user) || empty($sword))
      {
        echo "<p class='error'>Please try again to register simply. Enter a username
        and password.</p>";
      }  
      
      else if (strlen($user) < 4 || strlen($sword) < 4)
      {
        echo "<p class='error'>We have a saying. It goes something like this: \"2 + 2
        = 4 and that's the same number of characters to make a valid
        username and password.\"</p>";
      }
      
      //must see if this person is already registered:
      else if (!empty($email))
      { 
        $query = "SELECT * FROM homeowner WHERE email='$email'";
        $result = mysqli_query($DBConnect, $query);
        $count = mysqli_num_rows($result);
        
        if ($count==1)
        {
          die( "<p class='error'>It seems you are already registered with Help
          Yourselfers.  Please visit the <a href='index.php'>Login</a> Page.</p>");
        }
      else
      { 
        $join = date("Y-m-d H:i:s");
        $query1 =
        "INSERT INTO homeowner
        (fname, lname, address, city, state, zip, email, joindate)
        VALUES ('$fname', '$lname', '$address', '$city', '$state', $zip, '$email', '$join')";
        $result1 = mysqli_query($DBConnect, $query1);
        
        $query2 =
        "SELECT * FROM homeowner;";
        $result2 = mysqli_query($DBConnect, $query2);
        $homeownerid = mysqli_num_rows($result2);
        $_SESSION['homeownerid'] = $homeownerid;
        $_SESSION['user'] = $user;

      /*NaCl (probably easiest to put joindate into sword table since joindate is not being used anywhere)
        date_default_timezone_set('US/Eastern');
        $nacl = dechex($join).$sword;
        $sword = hash('sha1', $nacl);*/
        
        $sword = sha1($_POST["sword"]);
        $query3 =
        "INSERT INTO sword
        (username, sword, homeownerid)
        VALUES ('$user', '$sword', $homeownerid)";
        $result3 = mysqli_query($DBConnect, $query3);
        
        header('Location: trade_registration.php');
      }//ends error checking registration else statement
      }//ends the final else if
    mysqli_close($DBConnect);
    }//ends successful DBConnect else statement
  }//ends POST submit
    
  ?>        
    <form action="registration.php" method="post">
    <table>
    <tr>
    <td>First Name:</td>
    <td>
    <input required type="text" name="fname" maxlength="25" size="20" value="<?php if (isset($fname)) { echo $fname; } ?>">
    </td>
    <td>Last Name:</td>
    <td>
    <input required type="text" name="lname" maxlength="25" size="20" value="<?php if (isset($lname)) { echo $lname; } ?>">
    </td>
    </tr>
    <tr>
    <td>Username:</td>
    <td><input pattern=".{4,10}" required type="text" name="user" maxlength="10" size="20" value="<?php if (isset($user)) { echo $user; } ?>">
    <small>(between 4 and 10 characters)</small></td>
    <td>Password:</td>
    <td><input pattern=".{4,10}" required type="password" name="sword" maxlength="10" size="20" value="<?php if (isset($sword)) { echo $sword; } ?>">
    <small>(between 4 and 10 characters)</small></td>
    </tr>
    <tr>
    <td>Street Address:</td>
    <td>
    <input type="text" name="address" maxlength="50" size="20" value="<?php if (isset($address)) { echo $address; } ?>">
    </td>
    <td>Email:</td>
    <td>
    <input type="email" name="email" maxlength="50" size="20" value="<?php if (isset($email)) { echo $email; } ?>">
    </td>
    </tr>
    <td>City:</td>
    <td>
    <input type="text" name="city" maxlength="25" size="20" value="<?php if (isset($city)) { echo $city; } ?>">
    </td>
    </tr>
    <td>State:</td>
    <td>
    <input type="text" name="state" maxlength="2" size="20" value="<?php if (isset($state)) { echo $state; } ?>">
    </td>
    </tr>
    <td>Zip:</td>
    <td>
    <input pattern="[0-9]{5}" type="text" name="zip" maxlength="5" size="20" value="<?php if (isset($zip)) { echo $zip; } ?>">
    </td>
    </tr>
    </table><br />
    <input class="button" type="submit" name = "submit" value = "submit">
    </form>

</div><!--end page-wrap-->

    <footer>
      <div class="row"> 
        <small>A Perry Abramowitz Production | &phone; 800-diy-help | All rights reserved | &copy;2014</small>
      </div>
      
      <div class="row">   
        <nav> <!-- does not need if-else because never a case when you will register if you're logged in. -->
          <a id='left' href='about.php'>about</a>
          <a id='center' href='resources.php'>resources</a>
          <a id='right' href='terms.php'>terms and conditions</a>
        </nav> 
      </div>
    </footer>
  </body>
</html>
