<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php

    $adminid = $_POST["ID"];
    $adminpass = $_POST["password"];

    include('dbconnect.php');

    $ss = $dbh -> prepare("SELECT * FROM user WHERE id = :uid");
    $ss -> bindParam(':uid', $adminid);
    $ss -> execute();
    $result = $ss -> fetch(PDO::FETCH_ASSOC);
    $resultid = $result["id"];
    $resultpass = $result["pass"];

    echo $resultid;
    echo $resultpass;
    
    if($adminid == $resultid){
      if($adminpass == $resultpass){
        echo $_SESSION['login'];
        $_SESSION['login'] = 1;
        header("Location: write.php");
      } else {
        echo $_SESSION['login'];
        $_SESSION['login'] = 0;
        //header("Location: admin-login.php");
      }
    } else {
      //header("Location: admin-login.php");
    }

  ?>


</head>
<body>
</body>
</html>
