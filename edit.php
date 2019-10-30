<?php
session_start();
?>

<!DOCTYPE html5>
<html>
<head>
  <script>
    /**
     * 確認ダイアログの返り値によりフォーム送信
    */
    function edit () {
        /* 確認ダイアログ表示 */
        var flag = confirm ( "編集を確定してもよろしいですか？\n\n編集を確定したくない場合は[キャンセル]ボタンを押して下さい");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        if(flag == true){
          window.alert('編集しました。');
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

    if($_SESSION['login'] == 0){
      header("Location: admin-login.php");
    }

    $pageno = $_GET["articleno"];
    $_SESSION['ano'] = $_GET["articleno"];

    $ss = $dbh -> prepare("SELECT * FROM article WHERE article_no = :page");
    $ss -> bindParam(':page', $pageno);
    $ss -> execute();
    $result = $ss -> fetch(PDO::FETCH_ASSOC);

    $tag = $result['entry_id'];
    $tag1 = explode(',',$tag);
    $check1 = null;
    $check2 = null;
    $check3 = null;
    $check4 = null;
    $check5 = null;
    $check6 = null;
    
    foreach( $tag1 as $value ){
      ${"check" . $value} = $value;
    }
    echo '<div style="padding:10%;">';
    echo '<form action="update.php" method="post" class="center" onsubmit="return submitChk()">';
    echo '<div class="length">';
      echo '<div style="width:90%;">タイトル編集<input style="width:100%" type="text" name="titleupdate" size="40" value="'.$result['title'].'"></div>
            <div style="width:90%;">中記事編集<textarea name="msentenceupdate" style="width:100%;" rows="3">'.$result['m_sentence'].'</textarea>
            <div style="width:90%;">記事編集<textarea name="sentenceupdate" style="width:100%;" rows="30">'.$result['sentence'].'</textarea></div>
            </div>
            <p>タグ（複数可）:
              <input type="checkbox" name="tag[]" value="1"';if($check1 == 1){echo 'checked="checked"';}echo '>food
              <input type="checkbox" name="tag[]" value="2"';if($check2 == 2){echo 'checked="checked"';}echo '>gadget
              <input type="checkbox" name="tag[]" value="3"';if($check3 == 3){echo 'checked="checked"';}echo '>hobby
              <input type="checkbox" name="tag[]" value="4"';if($check4 == 4){echo 'checked="checked"';}echo '>design
              <input type="checkbox" name="tag[]" value="5"';if($check5 == 5){echo 'checked="checked"';}echo '>program
              <input type="checkbox" name="tag[]" value="6"';if($check6 == 6){echo 'checked="checked"';}echo '>etc
            </p>
          <div ><input type="submit" value="編集を更新します。" onClick="return edit()"; size="40" name="submit"></div>
        </div>
      </form>
      </div>';
  ?>
</body>
</html>
