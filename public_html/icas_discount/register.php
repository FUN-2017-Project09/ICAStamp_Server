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
    $point=$_GET['point'];
    //スタート時間の有無を検索   
    $search1= $db->prepare("select StDate from sr_users where IDm ='$id'");
    $search1->execute();
    $user=$search1->fetchAll(PDO::FETCH_ASSOC);
    //ポイントの値を検索   
    $search2= $db->prepare("select point from ic_stamp where IDm ='$id' and node='$node'");
    $search2->execute();
    $try=$search2->fetchAll(PDO::FETCH_ASSOC);
    //MySQLへの実行文   
    $stmt1= $db->prepare("insert into ic_stamp (IDm,point,node,Date,Try) values(?,?,?,?,?)");
    $stmt2= $db->prepare("update ic_stamp set point='$point',Try=Try+1 where IDm='$id' and node='$node'"); 
       
    if($user){
        if($try){
            if($try[0]['point']=="1"){
            //正解済みの処理    
            echo "このエリアはすでに正解済みです";
            }else{
            //２回目以降の回答    
            $stmt2->execute();
            echo "IDm:".$id."を登録しました。<br/><br/>";
            echo "取得ポイント：".$point."<br/><br/>";  
            echo "node番号は ".$node."です。<br/><br/>";
            echo "日時： ".$DAte."<br/><br/>";   
        }
    }else{
        //初回回答    
        $stmt1->execute([$id,$point,$node,$DAte,1]);
        echo "IDm:".$id."を登録しました。<br/><br/>";
        echo "取得ポイント：".$point."<br/><br/>";  
        echo "node番号は ".$node."です。<br/><br/>";
        echo "日時： ".$DAte."<br/><br/>";
        }
     }else{  
        echo "このIDは存在しません";
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