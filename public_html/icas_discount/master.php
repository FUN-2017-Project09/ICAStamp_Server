<HTML>
 <BODY>
  <?php
  require_once(__DIR__ . '/../../config/config.php');
   try{
    //connect
    $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //値を取得して変数に代入   
    $points=0;   
    $DAte = date('Y-m-d H:i:s');
    $id=$_GET['IDm'];
    //ゲーム情報の有無を検索   
    $search= $db->prepare("select* from ic_stamp where IDm ='$id'");
    $search->execute();
    $user=$search->fetchAll(PDO::FETCH_ASSOC);
    //スタートの有無を検索   
    $Stsearch=$db->prepare("select StDate from sr_users where IDm ='$id'");
    $Stsearch->execute();
    $start=$Stsearch->fetchAll(PDO::FETCH_ASSOC);
    //MySQLへの命令文
    $stmt1= $db->prepare("insert into sr_users (IDm,StDate) values(?,?)");
    $stmt2= $db->prepare("update sr_users set StDate=cast(now() as datetime) where IDm='$id'");

    if($user){
        //ゲーム情報があれば結果を表示
        echo "結果照会<br/>";
        echo "IDm:".$id."<br/>";
        echo "Area:";
        foreach($user as $row){
        echo $row['node']." ";
        $points+=$row['point'];    
        }
        echo"<br/>";
        echo "Point:".$points."<br/>";
     }else{
        if($start){
        //ゲーム情報がなければ再登録
        $stmt2->execute();
        echo "IDm:".$id."を登録しました。<br/><br/>";
        echo "スタート日時： ".$DAte."";   
    }else{
        //初回登録    
        $stmt1->execute([$id,$DAte]);
        echo "IDm:".$id."を登録しました。<br/><br/>";
        echo "スタート日時： ".$DAte."";   
        }
    }
    } catch (PDOException $e){
     echo $e->getMessage()."<br/>";
     echo "登録済みです";
     exit;
    }
  ?>


   <br><br>
    <form action="exchange.php" method="get">
    <input type="hidden" name="IDm" value="<?=$id?>">
    <input type="hidden" name="point" value="<?=$points?>">  
	<input type="submit" value="景品交換">
    </form>    
  <FORM>
    <INPUT type="button" value="戻る" onClick="history.back()">
  </FORM>
 </body>
</html>