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

  echo "username from loginpage = $_POST['usrname'] <br>";
  echo "password from loginpage = $_POST['psw'] <br>";

  $user =mysqli_real_escape_string($connection,      "SELECT uname     FROM comp_users   WHERE uname='$uname'");
  $pwd=mysqli_real_escape_string($connection,        "SELECT password  FROM comp_users   WHERE uname='$uname'");
  $fname =mysqli_real_escape_string($connection,     "SELECT fname     FROM comp_users   WHERE uname='$uname'");
  $lname =mysqli_real_escape_string($connection,     "SELECT lname     FROM comp_users   WHERE uname='$uname'");
  $email =mysqli_real_escape_string($connection,     "SELECT email     FROM comp_users   WHERE uname='$uname'");
  $dob =mysqli_real_escape_string($connection,       "SELECT dob       FROM comp_users   WHERE uname='$uname'");
  $login =mysqli_real_escape_string($connection,     "SELECT login     FROM comp_users   WHERE uname='$uname'");
  $numlogin =mysqli_real_escape_string($connection,  "SELECT numlogin  FROM comp_users   WHERE uname='$uname'");

  $update=mysqli_query($connection,     "UPDATE comp_users   SET numlogin = numlogin + 1 WHERE uname='$uname'");
  $update=mysqli_query($connection,     "UPDATE comp_users   SET login=now() WHERE uname='$uname'");

  $row1 = mysqli_fetch_row($user);
  $row2 = mysqli_fetch_row($pwd);
  $f = mysqli_fetch_row($fname);
  $l = mysqli_fetch_row($lname);
  $e = mysqli_fetch_row($email);
  $d = mysqli_fetch_row($dob);
  $ll = mysqli_fetch_row($login); //last login
  $nl = mysqli_fetch_row($numlogin);

  echo "row1 = $row1 <br>";
  echo "row2 = $row2 <br>";
  echo "f = $f <br>";
  echo "l = $l <br>";
  echo "e = $e <br>";
  echo "d = $d <br>";
  echo "ll = $ll <br>";
  echo "nl = $nl <br>";

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
    //header("Location: register.html");
    echo "elseif(empty($row1[0]))<br>";
    echo "header(Location: register.html);"
  }
  else
  {
    //header("Location: error.html");
    echo "else<br>";
    echo "header(Location: error.html)";
  }

  mysqli_close($connection);
?>
