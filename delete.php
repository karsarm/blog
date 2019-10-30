<html>
<head>
</head>
<body>
  <?php
    session_start();
    include('dbconnect.php');

    $pageno = $_GET["articleno"];
    echo $_GET["articleno"];

    $ss = $dbh -> prepare("DELETE FROM article WHERE article_no = :page");
    $ss -> bindParam(':page', $pageno);
    $ss -> execute();

    header("Location: index.php");
  ?>
</body>
</html>
