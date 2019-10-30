<?php
session_start();
?>

<!DOCTYPE html5>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <script type="text/javascript">
  function del() {
      /* 確認ダイアログ表示 */
      var flag = confirm ( "削除してもよろしいですか？\n\n削除しない場合は[キャンセル]ボタンを押して下さい");
      /* send_flg が TRUEなら送信、FALSEなら送信しない */
      if(flag == true){
        window.alert('削除しました。');
      } else{
        window.alert('キャンセルしました。');
      }
      return flag;
  }

  </script>

</head>
<body>

  <?php
    include('dbconnect.php');
    include('header.php');
    
    
    if(isset($_GET['page']) && $_GET['page'] != ''){
    } else {
        $_GET['page'] = 0;
        //現在のページ数がパラメータとして渡されてきた場合代入。
    }
    if(isset($_GET['tags']) && $_GET['tags'] != ''){
    } else {
        $_GET['tags'] = 0;
        //現在のページ数がパラメータとして渡されてきた場合代入。
    }
    if(isset($_SESSION['tags']) && $_SESSION['tags'] != ''){
    } else {
        $_SESSION['tags'] = 0;
        //現在のページ数がパラメータとして渡されてきた場合代入。
    }
    $nowpage = $_GET['page'];
    //もし現在のページのパラメータがNULLの場合１ページ目を表示
    if(empty($nowpage)){
      $nowpage = 1;
    }

    //tagsが設定されている場合tagsごとの値をセッションに格納し、タグごとのカウントを行う。
    $_SESSION['tags'] = $_GET['tags'];//ヘッダーから飛んできた際のタグを表示する。
    $tags = $_SESSION['tags'];
    if($tags==0){
      //全件取得
      $sqlcount = "SELECT COUNT(*) FROM article";
    }else{
      //タグごとの値取得
      $sqlcount = "SELECT COUNT(*) FROM article WHERE FIND_IN_SET ($tags,entry_id)";
    }
    $cnt = $dbh -> query($sqlcount);
    $cnt = $cnt -> fetchColumn();

    //総ページ数
    $allpage = floor($cnt / 10+0.9);
    //ページに表示する件数（余りの件数も含む）
    $article = $nowpage * 10 - 10;

    //tagsが0の場合全件取得し、tagsが0以上の場合、そのtagsごとの値を取得する
    if($tags == 0){
      $sqlpager = "SELECT * FROM article ORDER BY article_no DESC LIMIT $article,10";//記事全体取得
    } else{
      $sqlpager = "SELECT * FROM article WHERE FIND_IN_SET ($tags,entry_id) ORDER BY article_no DESC LIMIT $article,10";//ジャンルごとの記事取得
    }
    $output= $dbh -> query($sqlpager);
    
    $i = 0;//処理２回ごとに段落を設定する変数
    echo '<div class="spma">';
    echo '<main style="width:100%;">';
    echo '<div style="display:flex;flex-direction:column;background-color:#e28301;">';
    echo '<article>';
      echo '<table class="tableflex">';
    //記事の出力（10件分出力）
    foreach($output as $row){
        


              echo '<tr style="border-top:1px solid #000000;border-bottom:1px solid #000000;">';

                    $filename = 'img/'.$row['article_no'].'/thmbnail.png';
              if(file_exists($filename)){
                  
              echo '<td class="tabletd"><a href="article.php?articleno='.$row['article_no'].'"><figure class="hover-parent"><img src="img/'.$row['article_no'].'/thmbnail.png" class="thmbnail"><figcaption class="hover-mask"><span class="spnone" style="margin: 0 auto;">Click</span></figcaption></figure></a></td>
              <td class="tabletd2"><div class="titletd">- '.$row['title'].' -</div><div style="text-align:center;padding:10px;"><span style="font-size:16px;margin:15% auto 0;">'.$row['m_sentence'].'</span></div></td></a>';
            } else {
              echo '<td class="tabletd"><a href="article.php?articleno='.$row['article_no'].'"><figure class="hover-parent"><img src="img/thmbnail.png" class="thmbnail"><figcaption class="hover-mask"><span class="spnone" style="margin:0 auto;">Click</span></figcaption></figure></a></td>
              <td class="tabletd2"><div class="titletd">- '.$row['title'].' -</div><div style="text-align:center;padding:10px;"><span style="font-size:16px;margin:15% auto 0;">'.$row['m_sentence'].'</span></div></td></a>';
            }
              echo '<td class="category"><span class="spnone">カテゴリー</span><br>';
        
              $check1 = null;
              $check2 = null;
              $check3 = null;
              $check4 = null;
              $check5 = null;
              $check6 = null;


              $cate = $row['entry_id'];
              $cate1 = explode(',',$cate);
              foreach( $cate1 as $value ){
                  ${"check" . $value} = $value;
              }
              echo '<div class="category2">';
              if($check1 == 1){echo '・FOOD<br>';} else {$check1 = null;}
              if($check2 == 2){echo '・GADGET<br>';} else {$check2 = null;}
              if($check3 == 3){echo '・HOBBY<br>';} else {$check3 = null;}
              if($check4 == 4){echo '・DESIGN<br>';} else {$check4 = null;}
              if($check5 == 5){echo '・CODE<br>';} else {$check5 = null;}
              if($check6 == 6){echo '・etc.';} else {$check6 = null;}
              echo '</div>';
              if($_SESSION['login'] == 1){
                    echo '<a class="edit" href="edit.php?articleno='.$row['article_no'].'"><div class="shadow-min" style="color:#000000;">編集</div></a>';
                    echo '<a class="delete" onClick="return del()"; href="delete.php?articleno='.$row['article_no'].'"><div class="shadow-min" style="color:#000000;">削除</div></a>';
              } else {
                  
              }
            echo '<div class="sentence">投稿日　:　'.$row['sentence_date'].'<br>記事ID　:　'.$row['article_no'].'</div>';
            echo '</td>';
            echo '</tr>';
  }
  echo '</table>';
  echo '</article>';
    //ページャー機能(5ページ分表示)
  echo '<div class="center" style="background-color:#ffffff;padding:4% 0;">';

    //ページ数やある特定の数字の全ページを取得した場合ページャーの表示を変えるための分岐
    if($nowpage >=4){
      $pager1 = $pager1+1;
    }
    if($nowpage >=5){
      $pager1 = $pager1+1;
    }
    if($allpage ==4){
      $pager1 = $pager1-1;
    }
    
    $x =0;
    $pager1 = 0;
    //ページャーの計算処理
    for($pager=$x;$pager<5;$pager++){
      $pager1++;

      if($pager1 >=1){
        if($nowpage!=$pager1){

          //現在のページがページャーと一致しなかった場合リンク化
          echo '<div><a style="margin:0px 10px;font-size:28px;color:#555555;" class="otherpage" href="index.php?page='.$pager1.'&tags='.$tags.'">'.$pager1.'</a></div>';
        } else {
          //現在のページがページャーと一致した場合はリンク化しない
          echo '<div class="nowpage" style="margin:0px 10px;font-size:28px;color:0000000;">'.$nowpage.'</div>';
        }

        //総ページが５ページ未満の終了処理
        if($pager1>=$allpage){
          break;
        }
      }
    }

    echo '</div>';
    include('footer.php');
    echo '</main>';
    $dbh = null;
  ?>
    </div>
</body>
</html>
