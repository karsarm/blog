<?php
session_start();
?>

<!DOCTYPE html5>
<html>
<head>
</head>
<body>
  <?php
    session_start();
    include('dbconnect.php');

    $updatetitle = $_POST["titleupdate"];
    $updatesentence = $_POST["sentenceupdate"];
    $mupdatesentence = $_POST["msentenceupdate"];
    $articleno = $_SESSION['ano'];

    if($_SESSION['login'] == 0){
      header("Location: admin-login.php");
    }

    foreach( $_POST["tag"] as $value ){
      $updateid .=$value.",";
    }
    echo $updateid;

    $ss = $dbh -> prepare("UPDATE article SET title = :updatetitle, sentence = :updatesentence ,entry_id = :updategenre,
                           m_sentence = :mupdatesentence WHERE article_no = :a_no");
    $ss -> bindParam(':updatetitle', $updatetitle);
    $ss -> bindParam(':updatesentence', $updatesentence);
    $ss -> bindParam(':a_no', $articleno);
    $ss -> bindParam(':mupdatesentence', $mupdatesentence);
    $ss -> bindParam(':updategenre',$updateid);
    
    $ss -> execute();

    unset($_SESSION['ano']);
    header("Location: index.php");


  ?>
</body>
</html>
