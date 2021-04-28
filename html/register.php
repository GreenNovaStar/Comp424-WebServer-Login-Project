<?php
  // session_start();
  // $_SESSION['status']="Active";
  $host="localhost";
  $user="ubuntu";
  $password="CompClass!424";
  $db="comp_class";
  $connection= mysqli_connect($host, $user, $password, $db);
  //echo "$connection<br>";
  //echo "0<br>";
  if($connection -> false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  $firstName = mysqli_real_escape_string($connection,$_POST['fname']);
  $lastName = mysqli_real_escape_string($connection,$_POST['lname']);
  $username = mysqli_real_escape_string($connection,$_POST['usrname']);
  $email = mysqli_real_escape_string($connection,$_POST['email']);
  $psw1 = mysqli_real_escape_string($connection,$_POST['psw']);
  //$sec1 = mysqli_real_escape_string($connection,$_POST['$securityQuestion1']);
  //$ans1 = mysqli_real_escape_string($connection,$_POST['$question1']);
  //$sec2 = mysqli_real_escape_string($connection,$_POST['$securityQuestion2']);
  //$ans2 = mysqli_real_escape_string($connection,$_POST['$question2']);
  //$sec3 = mysqli_real_escape_string($connection,$_POST['$securityQuestion3']);
  //$ans3 = mysqli_real_escape_string($connection,$_POST['$question3']);
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
      dob
    )VALUES(
      '$firstName',
      '$lastName',
      '$username',
      '$email',
      '$psw1',
      '$birthday'
    )";
	echo "$sql<br>";
	echo "1<br>";
	//echo "$connection<br>";
	//echo "2<br>";
    $result=mysqli_query($connection,$sql);
	echo "$result<br>";
	echo "3<br>";
    if(empty($result)) {
      $create="CREATE TABLE comp_users (
        fname varchar(255),
        lname varchar(255),
        uname varchar(50) UNIQUE,
        email varchar(255) Primary Key,
        password varchar(50),
        dob date,
        login timestamp,
        numlogin int NOT NULL DEFAULT 0,
      )";
		echo "$create";
		echo "4<br>";
        $result = mysqli_query($connection,$create);
		echo "$result";
		echo "5<br>";
        $result2 = mysqli_query($connection,$sql);
		echo "$result2";
		echo "6<br>";
    }
      //header("Location: confirmation.html");
  }

  mysqli_close($connection);
?>
