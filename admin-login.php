<!DOCTYPE html5>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
</head>
<body>
  <?php
    
    include('dbconnect.php');
    include('header.php');
    

    echo '<h1>管理者ログインページです</h1>
          <form action="login.php" method="post" style="display:flex;justify-content:center;align-items:center;flex-direction:column;margin-bottom:40px;">
            <div style="display:flex;">
              <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;">
                <span>id</span>
                <span>password</span>
              </div>
              <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;">
                <span><input type="text" name="ID" size="40"></span>
                <span><input type="text" name="password" size="40"></span>
              </div>
            </div>
            <div>
              <span><input type="submit" value="ログイン">
            </div>
          </form>';

    $dbh = null;
    ?>

</body>
</html>
