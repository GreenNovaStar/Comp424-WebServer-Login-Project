<?php
  session_start();
  $_SESSION['status']="Active";
  $host="localhost";
  $user="ubuntu";
  $password="CompClass!424";
  $db="comp_class";

  $connection= mysqli_connect($host, $user, $password, $db);

  if($connection === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }


  //grab information from login form
  $uname = mysqli_real_escape_string($connection, $_POST['usrname']);
  $psw1 = mysqli_real_escape_string($connection, $_POST['psw']);



  $user =mysqli_query($connection,      "SELECT uname     FROM comp_users   WHERE uname='$uname'");
  $pwd=mysqli_query($connection,        "SELECT password  FROM comp_users   WHERE uname='$uname'");
  $fname =mysqli_query($connection,     "SELECT fname     FROM comp_users   WHERE uname='$uname'");
  $lname =mysqli_query($connection,     "SELECT lname     FROM comp_users   WHERE uname='$uname'");
  $email =mysqli_query($connection,     "SELECT email     FROM comp_users   WHERE uname='$uname'");
  $dob =mysqli_query($connection,       "SELECT dob       FROM comp_users   WHERE uname='$uname'");
  $update =mysqli_query($connection,    "UPDATE comp_users   SET login=now() WHERE uname='$uname'");
  $login =mysqli_query($connection,     "SELECT login     FROM comp_users   WHERE uname='$uname'");
  $update2 =mysqli_query($connection,   "UPDATE comp_users   SET numlogin = numlogin + 1 WHERE uname='$uname'");
  $numlogin =mysqli_query($connection,  "SELECT numlogin  FROM comp_users   WHERE uname='$uname'");

  $checkusr = mysqli_query($connection, "SELECT COUNT(*) FROM comp_users WHERE uname = '$uname' AND password = MD5('$psw1');");
  $checkusr = mysqli_fetch_row($checkusr);

  $row1 = mysqli_fetch_row($user);
  $row2 = mysqli_fetch_row($pwd);
  $f = mysqli_fetch_row($fname);
  $l = mysqli_fetch_row($lname);
  $e = mysqli_fetch_row($email);
  $d = mysqli_fetch_row($dob);
  $ll = mysqli_fetch_row($login); //last login
  $nl = mysqli_fetch_row($numlogin);

  if($psw1==$checkusr[0] && !empty($row1[0]))
  {
    $_SESSION['fname'] = $f[0];
    $_SESSION['lname'] = $l[0];
    $_SESSION['email'] = $e[0];
    $_SESSION['login'] = $ll[0];
    $_SESSION['dob']   = $d[0];
    $_SESSION['numlogin'] = $nl[0];
    header("Location: home.php");
  }
  elseif(empty($row1[0]))
  {
    header("Location: register.html");
  }
  else
  {
    header("Location: error.html");
  }


  mysqli_close($connection);
?>
