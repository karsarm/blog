<!DOCTYPE html5>
<html>
<head>
<title>At-Rec</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Kosugi+Maru&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
var windowWidth = $(window).width();
var windowSm = 767;
if (windowWidth <= windowSm) {
    //横幅767px以下のとき（つまりスマホ時）に行う処理を書く

} else {
    //横幅768px超のとき（タブレット、PC）に行う処理を書く
    $(function() {
      var $win = $(window),
        $main = $('main'),
        $nav = $('nav'),
        navHeight = $nav.outerHeight(),
        navPos = $nav.offset().top,
        fixedClass = 'is-fixed';

        $win.on('load scroll', function() {
          var value = $(this).scrollTop();
          if ( value > navPos ) {
            $nav.addClass(fixedClass);
            $main.css('margin-top', navHeight);
          } else {
            $nav.removeClass(fixedClass);
            $main.css('margin-top', '0');
          }
        });
      });
}

</script>

<script type="text/javascript">
  $(function(){
      $('#nav_toggle').click(function(){
           $("header").toggleClass('open');
           $("nav").slideToggle(500);
      });
    });
</script>

  <?php
    //echo $_SESSION['count'];
        if(isset($_SESSION['login']) && $_SESSION['login'] != ''){
    } else {
        $_SESSION['login'] = 0;
        //現在のページ数がパラメータとして渡されてきた場合代入。
    }

  ?>
</head>
<body class="body-green">
    <h1 style="font-size:40px;background-color:#FFFFFFF;display:flex;align-items:center;justify-content: space-between;padding-top:5px;"><div style="width:20%;margin-left:30px;"><img src="img/logo.png" width="100%"></div><div style="font-size:16px;"></div><div><div class="spnone" style="font-size:14px;text-align:center;">↓Me</div><div class="spnone" style="width:100px;"><img src="img/icon.png" width="100%"><div/></div></h1>
    <!--<div class="back-green head-font" style="font-family: 'Bungee', cursive;">
      <div class="back-green child" style="width:29%;float:left;">
        <div style="font-size:2.1vw;margin-bottom:-6vw;">Sorry to makoto.<br>I can't spaek English.</div>
        <div class="dailyFont" style="transform:rotate(90deg)scale(0.7,1);">Dairy<br>Record</div>
      </div>
      <img class="back-green" src="top-image/dodai.png" style="width:71%;">
      <img src="top-image/top-record.png" class="rotate-anime record">
      <img src="top-image/hari.png" class="hari">
    </div>-->
  <?php
    if($_SESSION['login'] == 0 ||$_SESSION['login'] == null){
      echo '<div style="display:none;">';
    }
  ?>
  <div style ="height:100px;">
    <ul class="header">

      <li style="position:relative;">
        <a class="center" onClick="logout();" href=
        <?php
        if($_SESSION['login'] == 1){
          echo "logout.php";
        } else{
          echo "admin-login.php";
        }
        ?>
         style="font-size:20px;padding:12px;border-radius:12px;margin-right:50px;">
          <?php
            if($_SESSION['login'] == 1){
              echo '<div class="head1 center">ログアウト</div>';
              echo '<a class="line1" style="color:black;font-size:20px;margin-left:20px;position:absolute;left:80%;width:146px;" href="write.php">書き込みページ</a>';
            }
           ?>
          </a>
       
      </li>
    </ul>
  </div>
    <?php
      if($_SESSION['login']==0){
        echo '</div>';

      }
    ?>

    <header>
        <div id="nav_toggle">
          <div>
            <span></span>
            <span></span>
            <span></span>
            <div class="circle"></div>
          </div>
        </div>
      <nav>

    <?php
        echo '<ul class="gnavi">
          <li>
            <a class="tooltip" href="index.php?tags=0">
              <i class="fas fa-home"></i>
              <span class="tooltiptext">HOME</span>
            </a>
          </li>
          <li>
          <a class="tooltip" href="index.php?tags=1">
            <i class="fas fa-utensils"></i>
            <span class="tooltiptext">FOOD</span>
          </a>
        </li>
        <li>
          <a class="tooltip" href="index.php?tags=2">
            <i class="fas fa-laptop"></i>
            <span class="tooltiptext">GADGET</span>
          </a>
        </li>
        <li>
          <a class="tooltip" href="index.php?tags=3">
            <i class="fas fa-gamepad"></i>
            <span class="tooltiptext">HOBBY</span>
          </a>
        </li>
        <li>
          <a class="tooltip" href="index.php?tags=4">
            <i class="fas fa-pen-nib"></i>
            <span class="tooltiptext">DESIGN</span>
          </a>
        </li>
        <li>
          <a class="tooltip" href="index.php?tags=5">
            <i class="fas fa-code"></i>
            <span class="tooltiptext">CODE</span>
          </a>
        </li>
        <li>
          <a class="tooltip" href="index.php?tags=6">
            <i class="fas fa-boxes"></i>
            <span class="tooltiptext">etc.</span>
          </a>
        </li>
      </ul>
    </div>';
    ?>
  </nav>
  </header>

  <script type="text/javascript">
  function logout(){
     // 「OK」時の処理開始 ＋ 確認ダイアログの表示
     if(window.confirm('ログアウトしますがよろしいですか？')){
       window.alert('ログアウトしました');
       location.href="index.php";
     } else{
       window.alert('キャンセルされました'); // 警告ダイアログを表示
     }
     // 「OK」時の処理終了
  }
  </script>
</body>
</html>
