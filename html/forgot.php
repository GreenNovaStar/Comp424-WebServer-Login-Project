<!DOCTYPE html>
<html lang="en" dir="ltr">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=email], [type=text] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
  font-size: 14px;
}

label[for=email], [for=question1], [for=question2], [for=question3] {
  font-size: 16px;
}

/* Add a background color when the inputs get focus */
input[type=email]:focus {
  background-color: #ddd;
  outline: none;
}

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
.forgotPassBtn {
  padding: 14px 20px;
  background-color: #4E7500;
  color: white;
  float: right;
}

.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
  color: white;
  float: left;
}

/* Float cancel and signup buttons and add an equal width */
.forgotPassBtn, .cancelbtn {
  width: auto;
  padding: 10px 18px;
  font-size: 14px;
  display: block;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
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
  .forgotPassBtn {
     width: 100%;
  }
}

.forgotusrnameform, .forgotpasswrdform {
  margin: 15px 0 0;
  font-size: 12px;
  display: none;
}


</style>
  <head>
    <meta charset="utf-8">
    <title>Forgot Username and Password</title>
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- <h1>Forgot Password</h1> -->
  </head>
  <body>
    <div class="container">
      <h1>Forgot Username and Password</h1>
      <input type = "radio" id = "forgotusr" name = "forgot" value = "username" class = "forgotusrname">
      <label for="username">Forgot Username</label>

      <input type = "radio" id = "forgotpsw" name = "forgot" value = "password" class = "forgotpasswrd">
      <label for="password">Forgot Password</label>
      <hr>
      <div class = "forgotpasswrdform">
        <form action="forgotPassword.php" method="post">
          <h1>Forgot Password</h1>
          <h5>Please enter your email and username to retrieve your password.</h5>
          <hr>
          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter Email" id="emailInput" name="email" required>
          <label for="usrname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" id="usrname" name="usrname" required>
          <div class="h-captcha" data-sitekey="ebc443a9-6d76-4817-93a6-a8c725a54020"></div>
          <hr>
          <a style="text-decoration:none;" href="login.html">
            <button type="button" class="cancelbtn" >Cancel</button>
          </a>
          <button type="submit" class="forgotPassBtn">Send Email</button>
        </form>
        <!-- <br> -->
      </div>

      <?php

        session_start();

        $host="localhost";
        $user="ubuntu";
        $password="CompClass!424";
        $db="comp_class";

        $connection= mysqli_connect($host, $user, $password, $db);

        if($connection -> false){
          die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        echo '<div class = "forgotusrnameform">';
        echo '<form action="forgotUsername.php" method="post">';
        echo '<h1>Forgot Username</h1>';
        echo '<h5>Please answer your security questions and enter your email to retrieve your username.</h5>';
        echo '<hr>';

        echo '<label for="email"><b>Email</b></label>';
        echo'<input type="email" placeholder="Enter Email" name="email" required>';

        echo '<label for="question1"><b>Security Question #1</b></label>';
        echo '<input type="text" placeholder="Enter Security Question #1 Answer" name="question1" required>';

        echo '<label for="question2"><b>Security Question #2</b></label>';
        echo '<input type="text" placeholder="Enter Security Question #2 Answer" name="question2" required>';

        echo '<label for="question3"><b>Security Question #3</b></label>';
        echo '<input type="text" placeholder="Enter Security Question #3 Answer" name="question3" required>';
        echo '<div class="h-captcha" data-sitekey="ebc443a9-6d76-4817-93a6-a8c725a54020"></div>';
        echo '<button type="submit" class="forgotPassBtn">Send Email</button>';
        echo '<a style="text-decoration:none;" href="login.html">';
        echo '<button type="button" class="cancelbtn" >Cancel</button>';

        echo '</form>';
        echo '<hr>';
        echo '</a>';
        echo '</div>';
       ?>


    </div>
  </body>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
  <script type="text/javascript">
  $(".forgotusrname").click(() => {
    $(".forgotusrnameform").show();
    $(".forgotpasswrdform").hide();
   });
  $(".forgotpasswrd").click(() => {
    $(".forgotpasswrdform").show();
    $(".forgotusrnameform").hide();
  });
  </script>
</html>
