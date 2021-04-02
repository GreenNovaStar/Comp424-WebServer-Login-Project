<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];
$address = $_SESSION['address'];
$dob = $_SESSION['dob'];
$login = $_SESSION['login'];
?>
  
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Full-width input fields */

/* Add a background color when the inputs get focus */

/* Set a style for all buttons */
button {
  background-color: #4E7500;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.downloadBtn {
  padding: 14px 20px;
  width: auto;
}

/* Float cancel and signup buttons and add an equal width */


/* Add padding to container elements */
.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .downloadBtn {
     width: 100%;
  }
}
</style>
  <head>
    <meta charset="utf-8">
    <title>Login Successful</title>
  </head>

  <body>
    <div class="clearfix">
      <!-- need to implement loginConfirmation.html file -->
      <h1>Login Successful</h1>
      <!-- TODO: -->
      <!-- $[variable name] need to change those to variable names to bring back the data -->
      <h2>Hello $FirstName $LastName,</h2>
      <we><strong>Welcome</strong> &nbsp<?php echo $fname; echo " " ; echo $lname;?></we>
      <p><we> Last logged in at : <?php echo $login; ?></we>
      </p> 
      <a style="text-decoration:none;" href="logout.php">
          <button type="button" class="logoutbtn">Logout</button>
      </a>
    </div>
  </body>
</html>