<?php

// ユーザーの一覧

require_once(__DIR__ . '/../../config/config.php');

try{
          //connect
          $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
          $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $stmt= $db->query("select * from sr_users"); //MySQLへの命令文
        
          //レコード件数取得
          $row_count = $stmt->rowcount();

          foreach ($stmt as $row) {
	    $rows[] = $row;
	  }

/*
          //foreach文の別の書き方
          while($row = $stmt->fetch()){
            $rows[] = $row;
          }
*/
// var_dump($_SESSION['me']);

$app = new MyApp\Controller\Index();

$app->run();

// $app->me()
// $app->getValues()->users

       } catch (PDOException $e){
         echo $e->getMessage();
         exit;
       }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <!-- <link rel="stylesheet" href="../styles.css"> -->
  <link rel="stylesheet" href="../body.css">
</head>

<body>
<!-- コンテナ開始 -->
<div id="container">

<!-- ヘッダ開始 -->
<div id="header">
    【外部公開向けページ】(ICAS割り引き用)
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
</div>
<!-- ヘッダ終了 -->

<!-- サイドバーナビゲーション開始 -->
<div id="nav">
  <div id="container">
    エリアリスト <span class="fs12"></span>
    <ul>
     1 五稜郭<br>
     2 美原<br>
     3 エリア3<br>
    </ul>
  </div>
</div>
<!-- サイドバーナビゲーション終了 -->

<!-- メインカラム開始 -->
<div id="content">
    <h1>テーブル表示</h1>

      レコード件数：<?php echo $row_count; ?><br><br>
      <table border="1">
      <tr><td>IDm</td><td>Start</td><td>Goal</td><td>Delete</td></tr>
 <!-- 表示 -->
      <?php 
      foreach($rows as $row){
      ?>
    <tr>
      <td><?php echo htmlspecialchars($row['IDm'],ENT_QUOTES,'UTF-8'); ?></td>
      <td><?php echo $row['StDate']; ?></td>
      <td><?php echo $row['ChDate']; ?></td>
      <td>
	  <form action="userdelete2.php" method="get">
	  <input type="submit" value="削除する">
	  <input type="hidden" name="IDm" value="<?=$row['IDm']?>">
	  </form>
      </td>
    </tr> 
      <?php 
        } 
      ?>
          
<script>
    function submitChk () {
        var flag = confirm ( "削除してもよろしいですか？\n\n削除したくない場合は[キャンセル]ボタンを押して下さい");
        return flag;
    }
</script>
<form method="post" action="delete1.php" onsubmit="return submitChk()">
    <input type="submit" name="submit" value="Userレコード全消去">
</form><br><br>
          
      <a href="../index.php">戻る</a></p>
</div>
<!-- メインカラム終了 -->

</div>
<!-- コンテナ終了 -->

</body>
</html>