<?php
  session_start();
  $_SESSION['status']="Active";
  // $data = parse_ini_file("../config.ini");
  // $host=$data[host];
  $host="localhost";
  // $user=$data[username];
  $user="ubuntu";
  // $password=$data[password];
  $password="CompClass!424";
  // $db=$data[dbname];
  $db=comp_class;
  $connection= mysqli_connect($host, $user, $password, $db);
  // $connection= mysqli_connect($host, $user, $db);

  if($connection === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  $firstName = $_POST['fname'];
  $lastName = $_POST['lname'];
  $username = $_POST['usrname'];
  $email = $_POST['email'];
  $psw1 = $_POST['psw'];
  $sec1 = $_POST['$securityQuestion1'];
  $ans1 = $_POST['$question1'];
  $sec2 = $_POST['$securityQuestion2'];
  $ans2 = $_POST['$question2'];
  $sec3 = $_POST['$securityQuestion3'];
  $ans3 = $_POST['$question3'];
  $birthday = $_POST['birthday'];

  $querych=mysqli_query($connection,"SELECT email from comp_users where email='$email'");
  $flag=mysqli_num_rows($querych);
  if($flag>=1) {
    echo "User Exists";
    header("Location: login.html");
  } else{
    // $sql="INSERT INTO comp_users (fname,lname,email,password) values ('$fname','$lname','$email','$pwd1')";
    $sql = "INSERT INTO comp_users(
      fname,
      lname,
      uname,
      email,
      password,
      dob,
      sec1, ans1,
      sec2, ans2,
      sec3, ans3
    )VALUES(
      '$firstName',
      '$lastName',
      '$username',
      '$email',
      '$psw1',
      '$birthday',
      '$sec1', '$ans1',
      '$sec2', '$ans2',
      '$sec3', '$ans3'
    )";
    $result=mysqli_query($connection,$sql);
    if(empty($result)) {
      $create="CREATE TABLE comp_users (
        fname varchar(255),
        lname varchar(255),
        uname varchar(50) UNIQUE,
        email varchar(255) Primary Key,
        password varchar(50),
        sec1 tinyint NOT NULL DEFAULT 0,
        ans1 varchar(255),
        sec2 tinyint NOT NULL DEFAULT 0,
        ans2 varchar(255),
        sec3 tinyint NOT NULL DEFAULT 0,
        ans3 varchar(255),
        dob date,
        login timestamp,
        numlogin int NOT NULL DEFAULT 0,
      )";
        mysqli_query($connection,$create);
        mysqli_query($connection,$sql);
        header("Location: login.html");
    }else{

      header("Location: confirmation.html");
    }
  }




  // $update=mysqli_query($connection,"INSERT INTO comp_users(
  //   fname,
  //   lname,
  //   uname,
  //   email,
  //   password,
  //   dob,
  //   sec1, ans1,
  //   sec2, ans2,
  //   sec3, ans3
  // )VALUES(
  //   $firstName,
  //   $lastName,
  //   $username,
  //   $email,
  //   $password,
  //   $birthday,
  //   $sec1, $ans1,
  //   $sec2, $ans2,
  //   $sec3, $ans3,
  // )");

  mysqli_close($connection);
?>
