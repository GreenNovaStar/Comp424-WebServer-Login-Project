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
$name = mysqli_real_escape_string($connection, $_POST['uname']);
$password = mysqli_real_escape_string($connection, $_POST['password']);
$user =mysqli_query($connection,"SELECT email FROM app_user WHERE email='$name'");
$pwd=mysqli_query($connection,"SELECT password FROM app_user WHERE email='$name'");
$fname =mysqli_query($connection,"SELECT fname FROM app_user WHERE email='$name'");
$lname =mysqli_query($connection,"SELECT lname FROM app_user WHERE email='$name'");
$email =mysqli_query($connection,"SELECT email FROM app_user WHERE email='$name'");
$dob =mysqli_query($connection,"SELECT dob FROM app_user WHERE email='$name'");
$login =mysqli_query($connection,"SELECT login FROM app_user WHERE email='$name'");
$update=mysqli_query($connection,"UPDATE app_user set login=now()");
$row1 = mysqli_fetch_row($user);
$row2 = mysqli_fetch_row($pwd);
$f = mysqli_fetch_row($fname);
$l = mysqli_fetch_row($lname);
$e = mysqli_fetch_row($email);
$d = mysqli_fetch_row($dob);
$ll = mysqli_fetch_row($login);

if($password==$row2[0] && !empty($row1[0]))
{
$_SESSION['fname'] = $f[0];
$_SESSION['lname'] = $l[0];
$_SESSION['email'] = $e[0];
$_SESSION['login'] = $ll[0];
$_SESSION['dob'] = $d[0];
header("Location: success.php");
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