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
//grab information from register page
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];
$psw1  = $_SESSION['psw'];
$psw2  = $_SESSION['psw-repeat'];
$dob   = $_SESSION['dob'];

$querych=mysqli_query($connection,"SELECT email from comp_class where email='$email'");
$flag=mysqli_num_rows($querych);
if($flag>=1) {
  echo "User Exists";
  header("Location: login.html");
} else{
  $sql="INSERT INTO comp_class (fname,lname,email,password,gender,contact) values ('$fname','$lname','$email','$pwd1')";
  $result=mysqli_query($connection,$sql);
  if(empty($result))
  {
    $create="CREATE TABLE comp_class (
      fname varchar(255),
      lname varchar(255),
      email varchar(255) Primary Key,
      password varchar(50),
      dob date,
      login timestamp
    )";
    mysqli_query($connection,$create);
    mysqli_query($connection,$sql);
  }
  header("Location: successful.html");
}

// if($fname === NULL || $lname === NULL || $email === NULL || $psw1 === NULL || $psw2 === NULL || $dob === NULL){
//   header("Location: register.html");
// }else{
//   if($psw1 === $psw2){
//     // passwords is the same
//     $dbemail =mysqli_query($connection,"SELECT email FROM app_user WHERE email='$name'");
//     if($email === $dbemail){
//       //email is already in database
//       header("Location: login.html");
//     }else{
//       //proceed with account registration
//       header("Location: success.html");
//     }
//   }else{
//     //error passwords do not match
//     header("Location: register.html");
//   }
// }

mysqli_close($connection);
?>
