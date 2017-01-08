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
            $toolid = $_GET['toolid'];
            
            $query =
            "INSERT INTO request (projectid, toolid)
            VALUES ($projectid, $toolid)";
            $result = mysqli_query($DBConnect, $query);
            
            mysqli_close($DBConnect);
            header("Location: project.php?projectid=$projectid&project=$project");
             
        }//ends successful DBConnect else statement
    }
?>