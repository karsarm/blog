<html>
<head>
</head>
<body>
  <?php
    session_start();
    session_destroy();
    header("Location: admin-login.php");
  ?>
</body>
</html>
