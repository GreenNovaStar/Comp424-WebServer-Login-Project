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

$ans1 = mysqli_real_escape_string($connection,$_POST['ans1']);
$ans2 = mysqli_real_escape_string($connection,$_POST['ans2']);
$ans3 = mysqli_real_escape_string($connection,$_POST['ans3']);

// echo $ans1;
// echo $ans2;
// echo $ans3;

// $sender = 'dasquad424@gmail.com';
// $senderName = 'Da Squad';
// $recipient = 'dasquad424@gmail.com';
// $usernameSmtp = 'AKIAZVTSETEUXWMLOWLL';
// $passwordSmtp = 'BN/daElGi8eiqhWoYsVTs6cWAgIoQ9xO9yKtsYM5Kya9';
// $configurationSet = 'dasquad';
// $host = 'email-smtp.us-west-1.amazonaws.com';
// $port = 587;
// $subject = 'Forgot Password Reset';
// $bodyText =  "Forgot Password Reset\r\nThis email was sent from Da Squad website! Click --> Da Squad to reset your password!";
// $bodyHtml = '<h1>Forgot Password Reset</h1><p>This email was sent from Da Squad website! Click --><a href="http://ec2-54-151-88-187.us-west-1.compute.amazonaws.com/reset.html">Da Squad</a> to reset your password!</p>';
// $mail = new PHPMailer(true);
//
// try {
//   $mail->isSMTP();
//   $mail->setFrom($sender, $senderName);
//   $mail->Username   = $usernameSmtp;
//   $mail->Password   = $passwordSmtp;
//   $mail->Host       = $host;
//   $mail->Port       = $port;
//   $mail->SMTPAuth   = true;
//   $mail->SMTPSecure = 'tls';
//   $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
//
//   $mail->addAddress($recipient);
//
//   $mail->isHTML(true);
//   $mail->Subject    = $subject;
//   $mail->Body       = $bodyHtml;
//   $mail->AltBody    = $bodyText;
//   $mail->Send();
//   echo "Email sent!" , PHP_EOL;
//   header("Location: login.html");
// } catch (phpmailerException $e) {
//   echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
//   header("Location: forgot.html");
// } catch (Exception $e) {
//   echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
//   header("Location: forgot.html");
// }


// }
 ?>
