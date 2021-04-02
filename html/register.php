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
$fname = mysqli_real_escape_string($connection, $_POST['fname']);
$lname = mysqli_real_escape_string($connection, $_POST['lname']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$pwd1 = mysqli_real_escape_string($connection, $_POST['password1']);
$pwd2 = mysqli_real_escape_string($connection, $_POST['password2']);

$querych=mysqli_query($connection,"SELECT email from comp_users where email='$email'");
$flag=mysqli_num_rows($querych);
if($flag>=1)
{
    echo "User Exists";
    header("Location: login.html");
}
else{
        $sql="INSERT INTO comp_users (fname,lname,email,password) values ('$fname','$lname','$email','$pwd1')";
        $result=mysqli_query($connection,$sql);
        if(empty($result))
        {
            $create="CREATE TABLE comp_users (
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

mysqli_close($connection);
?>
