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
  $uname = mysqli_real_escape_string($connection, $_POST['uname']);
  $psw1 = mysqli_real_escape_string($connection, $_POST['psw']);

  // $user =mysqli_query($connection,      "SELECT uname     FROM comp_users   WHERE uname='$uname'");
  $user =mysqli_query($connection, "SELECT uname FROM comp_users WHERE uname='$uname'");
  $userFlag=mysqli_num_rows($user);
  // $checkusr = mysqli_query($connection, "SELECT COUNT(*) FROM comp_users WHERE uname = '$uname'");
  // $checkusr = mysqli_fetch_row($user);
  echo $userFlag;
  if($userFlag >= 1){
    $update =mysqli_query($connection,    "UPDATE comp_users   SET password=MD5('$psw1') WHERE uname='$uname'");
    header("Location: login.html");
  }else{
    header("Location: error.html");
    // echo $psw1;
  }

  mysqli_close($connection);
?>
