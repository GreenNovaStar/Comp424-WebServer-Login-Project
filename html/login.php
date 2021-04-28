<?php
  // $data = parse_ini_file("../config.ini");
  // $host=$data[host];
  // $user=$data[username];
  // $password=$data[password];
  // $db=$data[dbname];
  $host="localhost";
  $user="ubuntu";
  $password="CompClass!424";
  $db="comp_class";

  $connection= mysqli_connect($host, $user, $password, $db);

  if($connection -> false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  // session_start();
  // $_SESSION['status']="Active";

  //grab information from login form
  $uname = mysqli_real_escape_string($connection, $_POST['usrname']);
  $psw1 = mysqli_real_escape_string($connection, $_POST['psw']);

  $user =mysqli_real_escape_string($connection,      "SELECT uname     FROM comp_users   WHERE usrname='$uname'");
  $pwd=mysqli_real_escape_string($connection,        "SELECT password  FROM comp_users   WHERE usrname='$uname'");
  $fname =mysqli_real_escape_string($connection,     "SELECT fname     FROM comp_users   WHERE usrname='$uname'");
  $lname =mysqli_real_escape_string($connection,     "SELECT lname     FROM comp_users   WHERE usrname='$uname'");
  $email =mysqli_real_escape_string($connection,     "SELECT email     FROM comp_users   WHERE usrname='$uname'");
  $dob =mysqli_real_escape_string($connection,       "SELECT dob       FROM comp_users   WHERE usrname='$uname'");
  $login =mysqli_real_escape_string($connection,     "SELECT login     FROM comp_users   WHERE usrname='$uname'");
  $numlogin =mysqli_real_escape_string($connection,  "SELECT numlogin  FROM comp_users   WHERE usrname='$uname'");

  $update=mysqli_query($connection,     "UPDATE comp_users   SET numlogin = numlogin + 1 WHERE usrname='$uname'");
  $update=mysqli_query($connection,     "UPDATE comp_users   SET login=now() WHERE usrname='$uname'");

  $row1 = mysqli_fetch_row($user);
  $row2 = mysqli_fetch_row($pwd);
  $f = mysqli_fetch_row($fname);
  $l = mysqli_fetch_row($lname);
  $e = mysqli_fetch_row($email);
  $d = mysqli_fetch_row($dob);
  $ll = mysqli_fetch_row($login); //last login
  $nl = mysqli_fetch_row($numlogin);

  if($psw1==$row2[0] && !empty($row1[0]))
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
