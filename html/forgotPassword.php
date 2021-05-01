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

$username = mysqli_real_escape_string($connection,$_POST['usrname']);
$email = mysqli_real_escape_string($connection,$_POST['email']);

echo "Username is $username<br>";
echo $_POST['usrname'];
echo "<br>";
echo "Email is $email<br>";
echo $_POST['email'];
echo "<br>";

$uname     =mysqli_query($connection, "SELECT uname FROM comp_users WHERE uname='$username'");
$unameflag=mysqli_num_rows($uname);
$emailHash =mysqli_query($connection, "SELECT email FROM comp_users WHERE email=MD5('$email')");
$emailHashFlag=mysqli_num_rows($emailHash);

echo "uname from db is $unameflag <br>";
echo "email from db is $emailHashFlag <br>";

  if($unameflag >= 1 && $emailHashFlag >= 1){
    echo "in here";
    $sender = 'dasquad424@gmail.com';
    $senderName = 'Da Squad';
    $recipient = 'dasquad424@gmail.com';
    $usernameSmtp = 'AKIAZVTSETEUXWMLOWLL';
    $passwordSmtp = 'BN/daElGi8eiqhWoYsVTs6cWAgIoQ9xO9yKtsYM5Kya9';
    $configurationSet = 'dasquad';
    $host = 'email-smtp.us-west-1.amazonaws.com';
    $port = 587;
    $subject = 'Forgot Password Reset';
    $bodyText =  "Forgot Password Reset\r\nThis email was sent from Da Squad website! Click --> Da Squad to reset your password!";
    $bodyHtml = '<h1>Forgot Password Reset</h1><p>This email was sent from Da Squad website! Click --><a href="https://www.424dasquad.com/reset.html">Da Squad</a> to reset your password!</p>';
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

      $mail->addAddress($recipient);

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
