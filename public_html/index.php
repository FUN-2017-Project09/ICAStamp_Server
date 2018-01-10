<?php

// ユーザーの一覧

require_once(__DIR__ . '/../config/config.php');

// var_dump($_SESSION['me']);

$app = new MyApp\Controller\Index();

$app->run();

// $app->me()
// $app->getValues()->users

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <!--
  <link rel="stylesheet" href="styles.css">
-->
  <link rel="stylesheet" href="body.css">
</head>

<body>
<!-- コンテナ開始 -->
<div id="container">

<!-- ヘッダ開始 -->
<div id="header">
    【外部公開向けページ】(スタンプラリー用)
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
</div>
<!-- ヘッダ終了 -->

<!-- サイドバーナビゲーション開始 -->
<div id="nav">
  <div id="container">
    Login_usersリスト <span class="fs12">(<?= count($app->getValues()->login_users); ?>)</span>
    <ul>
      <?php foreach ($app->getValues()->login_users as $user) : ?>
        <li><?= h($user->email); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<!-- サイドバーナビゲーション終了 -->

<!-- メインカラム開始 -->
<div id="content">
<p class="fs14">&ensp;<a href="icas_discount/example.php"> example.php </a>へ</p>
<p class="fs14">&ensp;スタンプラリー利用</p>
    <form action ="icas_discount/master.php" method="get">
    親機<br>
      <INPUT TYPE = "text" NAME="IDm">
      <INPUT TYPE = "SUBMIT" VALUE="登録">      
    </form><br>
    
    子機<br/>
    <form action ="icas_discount/search.php" method="get">
    検索：
    node:
    <input type="radio" name="node" value=1 checked="checked" />1
	<input type="radio" name="node" value=2 />2
	<input type="radio" name="node" value=3 />3
	<br>    
    <INPUT TYPE = "text" NAME="IDm">
    <INPUT TYPE = "SUBMIT" VALUE="登録">
    </form><br/>
    <form action ="icas_discount/register.php" method="get">
    
    正解送信：<br/>
    node:
    <input type="radio" name="node" value=1 checked="checked" />1
	<input type="radio" name="node" value=2 />2
	<input type="radio" name="node" value=3 />3
	<br>
    point:
    <input type="radio" name="point" value=0 checked="checked" />0
	<input type="radio" name="point" value=1 />1
    <br>
    <INPUT TYPE = "text" NAME="IDm">
    <INPUT TYPE = "SUBMIT" VALUE="登録">      
    </form><br>
    <p class="fs14">&ensp;<a href="icas_discount/showusers.php"> スタンプラリー利用者一覧 </a></p>
    <p class="fs14">&ensp;<a href="icas_discount/shownode.php"> スタンプラリーnode一覧 </a></p>      
  <!--  <p class="fs14">&ensp;<a href="icas_discount/delete.php">icas割レコード全消去 </a></p> -->
</div>
<!-- メインカラム終了 -->

</div>
<!-- コンテナ終了 -->

</body>
</html>