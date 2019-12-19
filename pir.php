<?php
/*
 * pir.php
 *
 * Zachary Schur
 * Fall 2019
 * CUE FINAL PROJECT
 *
 * Using mysqli, this file pulls the most recent entry from the pirData
 * table on the AWS RDS MYSQL server and compares it to the current
 * dateTime. If they are within 1 minute of each other, the spot is
 * marked as taken (red). If motion is not detected for one minute or
 * more, the spot becomes available (green)
 *
 */
?>


<?php //This block of PHP is used for debugging. Shows errors if code is incorrect.
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>

<!-- The below html is to set up the page and give the webpage title bar something to display -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Berg Circle Parking</title>
  </head>
  <body>


    <?php //Prints the page header.
      echo "<center><h1>Berg Circle Parking</h1></center>";
    ?>

    <?php // Connects to the pirData database on the AWS RDS MYSQL server through mysqli using port 3306.
      $database = mysqli_connect('database-2.cxbmzlvswtfo.us-east-2.rds.amazonaws.com', 'root', 'rootpassword', 'pirData', 3306);

      if (mysqli_connect_errno()) //Checks for valid connection. If connection fails, error message will be printed.
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      date_default_timezone_set('UTC'); //set timezone. all time is in UTC because dateTime in python script automatically uses UTC.

      $dateTime = date("r"); //variable for current date

      $dateTimeminus = date("Y-m-d H:i:s", strtotime($dateTime) - 30); //variable for current date minus 30 seconds

      $dateTimeplus = date("Y-m-d H:i:s", strtotime($dateTime) + 30); //variable for current date plus 30 seconds

      $lastRow = "SELECT * FROM pirData ORDER BY id DESC LIMIT 1"; //variable for SQL statement to be executed against pirData MYSQL database.

      $res = mysqli_query($database,$lastRow); //result variable to hold most recent timeStamp of motion detected from MYSQL database.

      if (!$res) die("Cannot execute query."); //makes sure $res variable has data

      while ($row = mysqli_fetch_assoc($res)) //while there is a result
      {
        $image1 = "taken.jpg"; //initalize variable for image with spot colored red
        $image2 = "notTaken.jpg"; //initalize variable for image with spot colored green

        if (($row['timeStamp'] >= $dateTimeminus) and ($row['timeStamp'] <= $dateTimeplus)) // if the result is greater than or equal to the variable for the current date minus 30 seconds and if the result is less than or equal to the variable for the current date plus 30 seconds...
        {
          echo "<center><img src=\"$image1\" width=290 height=580 /></center>"; //show the image with the spot taken (red)
          //echo "The spot is taken";
	      }
        else
        {
          echo "<center><img src=\"$image2\" width=290 height=580 /></center>"; //show the image with the spot not taken (green)
          //echo "The spot is not taken";
	      }
      }

mysqli_close($database); //close database connection
?>

<?php //Causes page to automatically refresh every 5 seconds so that if motion is detected, image changes without user having to reload the page
  header("refresh: 5");
  exit;
?>

  </body>
</html>
