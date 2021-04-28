<?php
  $host="localhost";
  $user="ubuntu";
  $password="CompClass!424";
  $db="comp_class";

  $connection= mysqli_connect($host, $user, $password, $db);

  if($connection -> false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  $firstName = mysqli_real_escape_string($connection,$_POST['fname']);
  $lastName = mysqli_real_escape_string($connection,$_POST['lname']);
  $username = mysqli_real_escape_string($connection,$_POST['usrname']);
  $email = mysqli_real_escape_string($connection,$_POST['email']);
  $psw1 = mysqli_real_escape_string($connection,$_POST['psw']);
  $sec1 = mysqli_real_escape_string($connection,$_POST['securityQuestion1']);
  $ans1 = mysqli_real_escape_string($connection,$_POST['question1']);
  $sec2 = mysqli_real_escape_string($connection,$_POST['securityQuestion2']);
  $ans2 = mysqli_real_escape_string($connection,$_POST['question2']);
  $sec3 = mysqli_real_escape_string($connection,$_POST['securityQuestion3']);
  $ans3 = mysqli_real_escape_string($connection,$_POST['question3']);
  $birthday = mysqli_real_escape_string($connection,$_POST['birthday']);

  $querych=mysqli_query($connection,"SELECT email from comp_users where email='$email'");
  $flag=mysqli_num_rows($querych);
  if($flag>=1) {
    echo "User Exists";
    header("Location: login.html");
  } else{

    $sql = "INSERT INTO comp_users(
      fname,
      lname,
      uname,
      email,
      password,
      sec1,
      ans1,
      sec2,
      ans2,
      sec3,
      ans3,
      dob
    )VALUES(
      '$firstName',
      '$lastName',
      '$username',
      MD5('$email'),
      MD5('$psw1'),
      '$sec1',
      MD5('$ans1'),
      '$sec2',
      MD5('$ans2'),
      '$sec3',
      MD5('$ans3'),
      '$birthday'
    )";

    $result=mysqli_query($connection,$sql);

    if(empty($result)) {
      $create="CREATE TABLE comp_users (
        fname varchar(255),
        lname varchar(255),
        uname varchar(50) UNIQUE,
        email varchar(255) Primary Key,
        password varchar(50),
        dob date,
      	sec1 tinyint NOT NULL DEFAULT 0,
      	ans1 varchar(255),
      	sec2 tinyint NOT NULL DEFAULT 0,
      	ans2 varchar(255),
      	sec3 tinyint NOT NULL DEFAULT 0,
      	ans3 varchar(255),
        login timestamp,
        numlogin int NOT NULL DEFAULT 0
      )";
        $result = mysqli_query($connection,$create);
        $result2 = mysqli_query($connection,$sql);
    }
      header("Location: confirmation.html");
  }

  mysqli_close($connection);
?>
