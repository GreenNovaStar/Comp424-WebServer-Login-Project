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

if($connection === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = mysqli_real_escape_string($connection, $_POST['email']);
$uname = mysqli_real_escape_string($connection, $_POST['uname']);

$user  =mysqli_query($connection,      "SELECT uname     FROM comp_users   WHERE uname='$uname'");
$emailHash =mysqli_query($connection,     "SELECT email     FROM comp_users   WHERE uname='$uname'");

// $result = mysqli_query($connection,"SELECT * FROM comp_users where email=MD5('$email')");
// $row = mysqli_fetch_assoc($result);
// $dbUsername=$row['uname'];
// $dbEmail=$row['email'];
// $password=$row['password'];

// $dbUsername = $user;
$dbUsername = mysqli_fetch_row($user);
$dbEmail = mysqli_fetch_row($emailHash);

if(MD5('$uname')==$dbUsername && MD5('$email') == $dbEmail) {
  $sender = 'dasquad424@gmail.com';
  $senderName = 'Da Squad';
  $recipient = 'dasquad424@gmail.com';
  $usernameSmtp = 'AKIAZVTSETEUXWMLOWLL';
  $passwordSmtp = 'BN/daElGi8eiqhWoYsVTs6cWAgIoQ9xO9yKtsYM5Kya9';
  $configurationSet = 'dasquad';
  $host = 'email-smtp.us-west-1.amazonaws.com';
  $port = 587;
  $subject = 'Forgot Password';
  $bodyText =  "Your password is : $password.";
  $bodyHtml = '<h1>Email Test</h1>
      <p>This email was sent through the
      <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP
      interface using the <a href="https://github.com/PHPMailer/PHPMailer">
      PHPMailer</a> class.</p>';

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username   = $usernameSmtp;
    $mail->Password   = $passwordSmtp;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';
    $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject    = $subject;
    $mail->Body       = $bodyHtml;
    $mail->AltBody    = $bodyText;
    $mail->Send();
    echo "Email sent!" , PHP_EOL;
    header("Location: login.html");
  } catch (phpmailerException $e) {
      echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
      header("Location: forgot.html");
  } catch (Exception $e) {
      echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
      header("Location: forgot.html");
  }
}
?>
