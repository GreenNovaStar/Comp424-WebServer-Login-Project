<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../../home/ubuntu/vendor/autoload.php';


session_start();

$host="localhost";
$user="ubuntu";
$password="CompClass!424";
$db="comp_class";

$connection= mysqli_connect($host, $user, $password, $db);

if($connection -> false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = mysqli_real_escape_string($connection,$_POST['email']);

echo "Email is $email<br>";
echo $_POST['email'];
echo "<br>";

$emailHash =mysqli_query($connection, "SELECT email FROM comp_users WHERE email=MD5('$email')");
$emailHashFlag=mysqli_num_rows($emailHash);

echo "email from db is $emailHashFlag <br>";

  if($emailHashFlag >= 1){
    echo "in if<br>";
    $secQnA =mysqli_query($connection, "SELECT sec1, sec2, sec3 FROM comp_users WHERE email=MD5('$email')");
    $secQnA = mysqli_fetch_row($secQnA);
    $sec1 = $secQnA[0];
    $sec2 = $secQnA[1];
    $sec3 = $secQnA[2];
    // echo "$sec1[0]<br>";
    echo "$secQnA[0]<br>";
    echo "$secQnA[1]<br>";
    echo "$secQnA[2]<br>";

    $secQuestions = array(
      0 => "What was your childhood nickname?",
      1 => "What was your childhood nickname?",
      2 => "What school did you attend for sixth grade?",
      3 => "What was the last name of your third grade teacher?",
      4 => "How do you smell farts?"
    );


    $sec1 = $secQuestions[$sec1];
    echo $sec1;
    $sec2 = $secQuestions[$sec2];
    echo $sec2;
    $sec3 = $secQuestions[$sec3];
    echo $sec3;



    echo '<script src="https://hcaptcha.com/1/api.js" async defer></script>';
    echo '<link rel="stylesheet" href="css/bootstrap.min.css">';
    echo '<style>';
    echo 'body {font-family: Arial, Helvetica, sans-serif;}';
    echo ' * {box-sizing: border-box;}';

    /* Full-width input fields */
    echo 'input[type=email], [type=text] {width: 100%;padding: 15px;margin: 5px 0 22px 0;display: inline-block;border: none;background: #f1f1f1;font-size: 14px;}';

    echo 'label[for=question1], [for=question2], [for=question3] {font-size: 16px;}';

    /* Add a background color when the inputs get focus */


    /* Set a style for all buttons */
    echo 'button {background-color: #4E7500;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;opacity: 0.9;}';

    echo 'button:hover {opacity:1;}';

    /* Extra styles for the cancel button */
    echo'.forgotPassBtn {padding: 14px 20px;background-color: #4E7500;color: white;float: left;}';

    echo '.cancelbtn {padding: 14px 20px;background-color: #f44336;color: white;float: left;}';

    /* Float cancel and signup buttons and add an equal width */
    echo '.cancelbtn, .forgotPassBtn {width: auto;padding: 10px 18px;font-size: 14px;display: block;}';

    /* Add padding to container elements */
    echo '.container {padding: 16px;}';

    echo '.clearfix::after {content: "";clear: both;display: table;}';
    /* The Modal (background) */
    echo '.modal {display: none; /* Hidden by default */position: fixed; /* Stay in place */z-index: 1; left: 0;top: 0;width: 100%; height: 100%; overflow: auto; background-color: #474e5d;padding-top: 50px;}';

    /* Modal Content/Box */
    echo '.modal-content {background-color: #fefefe;margin: 5% auto 15% auto;border: 1px solid #888;width: 80%; }';

    /* Style the horizontal ruler */
    echo 'hr {border: 1px solid #f1f1f1;margin-bottom: 25px;}';

    /* The Close Button (x) */
    echo '.close {position: absolute;right: 35px;top: 15px;font-size: 40px;font-weight: bold;color: #f1f1f1;}';

    echo '.close:hover,.close:focus {color: #f44336;cursor: pointer;}';

    /* Clear floats */
    echo '.clearfix::after {content: "";clear: both;display: table;}';
    // echo '.forgotusrnameform {margin: 15px 0 0;font-size: 12px;display: none;}';
    /* Change styles for cancel button and signup button on extra small screens */
    echo '@media screen and (max-width: 300px) {.forgotPassBtn {width: 100%;}}';

    echo '</style>';
    echo '<div class = "forgotusrnameform">';
    echo '<form action="forgotUsernamept2.php" method="post">';
    echo '<h1>Forgot Username</h1>';
    echo '<h5>Please answer your security questions and enter your email to retrieve your username.</h5>';
    echo '<hr>';

    echo "<label for='question1'><b>Security Question #1: $sec1<br></b></label>";
    echo '<input type="text" placeholder="Enter Security Question #1 Answer" name="ans1" required>';

    echo "<label for='question1'><b>Security Question #2: $sec2<br></b></label>";
    echo '<input type="text" placeholder="Enter Security Question #2 Answer" name="ans2" required>';

    echo "<label for='question1'><b>Security Question #3: $sec3<br></b></label>";
    echo '<input type="text" placeholder="Enter Security Question #3 Answer" name="ans3" required>';
    echo '<div class="h-captcha" data-sitekey="ebc443a9-6d76-4817-93a6-a8c725a54020"></div>';
    echo '<button type="submit" class="forgotPassBtn">Send Email</button>';
    echo '<a style="text-decoration:none;" href="login.html">';
    echo '<button type="button" class="cancelbtn" >Cancel</button>';

    echo '</form>';
    echo '<hr>';
    echo '</a>';
    echo '</div>';

  }else{
    header("Location: error.html");
  }
?>
