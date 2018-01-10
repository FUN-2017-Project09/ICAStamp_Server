<HTML>
 <BODY>
  <?php
  require_once(__DIR__ . '/../../config/config.php');
   try{
    //connect
    $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //取得した値を変数に代入   
    $DAte = date('Y-m-d H:i:s');
    $id=$_GET['IDm'];
    $node=$_GET['node'];
    //スタート時間の有無を検索   
    $search1= $db->prepare("select StDate from sr_users where IDm ='$id'");
    $search1->execute();
    $user=$search1->fetchAll(PDO::FETCH_ASSOC);
    //ポイントの値を取得   
    $search2= $db->prepare("select point from ic_stamp where IDm ='$id' and node='$node'");
    $search2->execute();
    $area=$search2->fetchAll(PDO::FETCH_ASSOC);
    
    if(($user)&&!($area)||($user)&&($area[0]['point']==='0')){
        //初回または不正解後の回答の処理
        echo "問題！";
     }else if(!($user)){
        //未登録時の処理
        echo "このIDは存在しません";
    }else if($area[0]['point']==='1'){
        //正解済みの処理
        echo "このエリアはすでに回答済みです";
    }
    } catch (PDOException $e){
     echo $e->getMessage();
     exit;
    }
  ?>


   <br><br>
  <FORM>
    <INPUT type="button" value="戻る" onClick="history.back()">
  </FORM>
 </body>
</html>