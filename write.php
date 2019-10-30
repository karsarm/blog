<?php
session_start();
if($_SESSION['login']==1){
}else{
header('Location: admin-login.php');
}
?>
<!DOCTYPE html5>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <script>
    /**
     * 確認ダイアログの返り値によりフォーム送信
    */
    function writer() {
        /* 確認ダイアログ表示 */
        var flag = confirm ( "書き込んでもよろしいですか？\n\n編集を確定したくない場合は[キャンセル]ボタンを押して下さい");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        if(flag == true){
          window.alert('書き込みました。');
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
    
    if(isset($_POST['sentencetitle'])){
      if(isset($_POST['sentencewrite'])){

        $entryid = null;

        foreach( $_POST[entry] as $value ){
          $entryid .= "{$value},";
        }


        $stitle = $_POST['sentencetitle'];
        $swrite = $_POST['sentencewrite'];
        $mwrite = $_POST['sentencemwrite'];
        $mw1 = $dbh -> prepare("INSERT INTO article (title,sentence,sentence_date,entry_id,m_sentence) VALUES (:stitle,:write,now(),:entryid,:msentence)");
        $mw1 -> bindParam(':stitle', $stitle);
        $mw1 -> bindParam(':write', $swrite);
        $mw1 -> bindParam(':entryid',$entryid);
        $mw1 -> bindParam(':msentence',$mwrite);
        $mw1 -> execute();

        $sqls = $dbh -> prepare("SELECT article_no FROM article ORDER BY article_no DESC LIMIT 1");
        $sqls -> execute();
        $sqls = $sqls -> fetch(PDO::FETCH_ASSOC);
        //$sqls= $dbh -> query($sqls);

        echo $sqls['article_no'];

        //作成したいディレクトリ（のパス）
        $directory_path = "img/".$sqls['article_no'];    //この場合、一つ上の階層に「hoge」というディレクトリを作成する

        //「$directory_path」で指定されたディレクトリが存在するか確認
        if(file_exists($directory_path)){
              //存在したときの処理
              echo "作成しようとしたディレクトリは既に存在します";
          }else{
              //存在しないときの処理（「$directory_path」で指定されたディレクトリを作成する）
              if(mkdir($directory_path, 0777)){
                  //作成したディレクトリのパーミッションを確実に変更
                  chmod($directory_path, 0777);
                  //作成に成功した時の処理
                  echo "作成に成功しました";
              }else{
                  //作成に失敗した時の処理
                  echo "作成に失敗しました";
              }
            }


          }
        }
    echo '<form action="write.php" onsubmit="return writer()" method="post" style="display:flex;justify-content:center;align-items:center;flex-direction:column;margin-bottom:40px;">';
    echo '<div style="display:flex;">';
    echo    '<div style="text-align:center;">';
    echo      '<span>タイトル<br><input type="text" name="sentencetitle" size="100"></span>';
    echo      '<span><br>記事概要<textarea name="sentencemwrite" style="width:100%" rows="10"></textarea></span>';
    echo      '<span><br>記事内容<textarea name="sentencewrite" style="width:100%" rows="30"></textarea></span>';
    echo      '<p>タグ（複数回答可）:
                <input type="checkbox" name="entry[]" value="1">food
                <input type="checkbox" name="entry[]" value="2">gadget
                <input type="checkbox" name="entry[]" value="3">hobby
                <input type="checkbox" name="entry[]" value="4">design
                <input type="checkbox" name="entry[]" value="5">program
                <input type="checkbox" name="entry[]" value="6">etc
              </p>';
    echo      '<span><input type="submit" value="書き込み実行" size="40"></span>';
    echo    '</div>';
    echo '</div>';


?>

</body>
</html>
