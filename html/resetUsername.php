<?php
  $userName = mysqli_real_escape_string($connection,$_POST['uname']);
  $password = mysqli_real_escape_string($connection,$_POST['psw']);

  if(isset($_SESSION['POST'])){
    $host="localhost";
    $user="ubuntu";
    $password="CompClass!424";
    $db="comp_class";

    $connection= mysqli_connect($host, $user, $password, $db);
    if($connection -> false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $sql = "SELECT COUNT(*) FROM comp_users WHERE uname='$userName'";
    $sqlQuery = mysqli_query($connection, $sql);
    $flag = mysqli_num_rows($sqlQuery);

    if($flag >= 1){
      echo "Username already exists";
      header("resetUsername.html");
    } else {
      
    }

  }
 ?>
