<?php
    session_start(); 
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
            
            $query =
            "INSERT INTO labors (homeownerid, projectid)
            VALUES ({$_SESSION['homeownerid']}, $projectid)";
            $result = mysqli_query($DBConnect, $query);
            
          //this gets the email of the New DIY Helper:
            $query1 =
            "SELECT email FROM homeowner
            WHERE homeownerid = {$_SESSION['homeownerid']}";
            $result1 = mysqli_query($DBConnect, $query1);
            
            while ($row = mysqli_fetch_assoc($result1))
            {
                $email = $row['email'];
            }
            
          /*this sends an email to the project owner that someone is available
            as a DIY Helper for a particular project.                         */
            $query2 =
            "SELECT fname, lname, email FROM homeowner, project
            WHERE project.homeownerid = homeowner.homeownerid
            AND projectid = $projectid";
            $result2 = mysqli_query($DBConnect, $query2);
                
            while ($row = mysqli_fetch_assoc($result2))
            {
                $subject = "New DIY Helper for $project Project";
                $message = "New DIY Helper\n\nProject: $project\nName: $fname $lname.\nEmail: $email\nLogin at www.sis.pitt.edu/~ug2/1059/DIYHelpers/index.php and view your projects\n";
                $header = "Cc: diy.schleppers@gmail.com";
                mail ($row['email'], $subject, $message, $header);
            }
            
            mysqli_close($DBConnect);
            header("Location: project.php?projectid=$projectid&project=$project");
             
        }//ends successful DBConnect else statement
    }
?>
