<?php
session_start();
?>

<!DOCTYPE html5>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
</head>
<body style="padding-bottom:20px;">
  <?php

    $pageno = $_GET["articleno"];

    include('dbconnect.php');
    include('header.php');

    $ss = $dbh -> prepare("SELECT * FROM article WHERE article_no = :page");
    $ss -> bindParam(':page', $pageno);
    $ss -> execute();
    $result = $ss -> fetch(PDO::FETCH_ASSOC);
    $no = $result["article_no"];
    $title = $result["title"];
    $sentence = $result["sentence"];
    $date = $result["sentence_date"];
    $filename = 'img/'.$no.'/thmbnail.png';



    echo '<main class="article-font artMain">';
      echo '<div class="artWrap">';
        echo '<div style="font-size:20px;border-bottom:1px solid gray;padding-bottom:20px;margin:20px 0;line-height:1.0;font-weight:700;">'.$title.'</div>';
        echo '<div style="padding-top:20px;font-size:13px;">'.$sentence.'</div>';
      echo '</div>';
      echo '<div style="margin-left:1%;width:39%;">';
      echo '<div class="artSub">';
        echo '<div style="display:flex;justify-content:center;align-items:center;margin:8px;">';
        if(file_exists($filename)){
          echo '<img src="img/'.$result["article_no"].'/thmbnail.png" style="width:80%;"></div>';
        } else {
          echo '<img src="img/thmbnail.png" style="width:80%;"></div>';
        }
        echo '<div style="font-size:13px;">記事ID:No-'.$no.'</div>';
        echo '<div style="font-size:15px;">'.$date.'に投稿</div>';
        echo '</div>';
        echo '<div style="text-align:center;margin-top:50px;background-color:#FFFFFF;width:100%;font-weight:bold;font-size:15px;">この記事のカテゴリー<br>
        <div style="font-weight:700;padding-bottom:12px;font-size:20px;">';
    
        
        $check1 = null;
        $check2 = null;
        $check3 = null;
        $check4 = null;
        $check5 = null;
        $check6 = null;
    
        $tag = $result['entry_id'];
        $tag1 = explode(',',$tag);
        foreach( $tag1 as $value ){
          ${"check" . $value} = $value;
        }

    
        if($check1 == 1){echo '・food<br>';}
        if($check2 == 2){echo '・gadget<br>';}
        if($check3 == 3){echo '・hobby<br>';}
        if($check4 == 4){echo '・design<br>';}
        if($check5 == 5){echo '・program<br>';}
        if($check6 == 6){echo '・etc';}

        echo '</div>';
        echo '</div><br>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '</div>';
      echo '</div>';
    echo '</main>';

include('footer.php');
  ?>

</body>
</html>
