<?php
  session_start();
  $_SESSION['status']="Active";
  $data = parse_ini_file("../config.ini");
  $host=$data[host];
  $user=$data[username];
  $password=$data[password];
  $db=$data[dbname];
  $connection= mysqli_connect($host, $user, $password, $db);

  if($connection === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  $username = $_POST['usrname'];
  $password = $_POST['psw'];
  $firstName = $_POST['fname'];
  $lastName = $_POST['lname'];
  $birthday = $_POST['birthday'];
  $sec1 = $_POST['$securityQuestion1'];
  $ans1 = $_POST['$question1'];
  $sec2 = $_POST['$securityQuestion2'];
  $ans2 = $_POST['$question2'];
  $sec3 = $_POST['$securityQuestion3'];
  $ans3 = $_POST['$question3'];


  $update=mysqli_query($connection,"INSERT INTO comp_users(
    fname,
    lname,
    uname,
    email,
    password,
    dob,
    numlogin,
    sec1, ans1,
    sec2, ans2,
    sec3, ans3
  )VALUES(
    $firstName,
    $lastName,
    $username,
    $email,
    $password,
    $birthday,
    0,
    $sec1, $ans1,
    $sec2, $ans2,
    $sec3, $ans3,
  )");

  mysqli_close($connection);
?>