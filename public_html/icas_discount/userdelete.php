<HTML>
 <BODY>
  <?php
    require_once(__DIR__ . '/../../config/config.php');

    try{
      //connect
      $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $id=$_GET['IDm'];
      //MySQLへの命令文 
      $stmt1= $db->prepare("DELETE from ic_stamp where IDm ='$id'");
      $stmt2=$db->prepare("update sr_users set ChDate=cast(now() as datetime) where IDm='$id'");
      //実行
      $stmt1->execute();
      $stmt2->execute();
        
      if(!$stmt1->rowCount()){
        echo "IDmは存在しません";
      }else{
        echo "row updated:". $stmt1->rowCount()."<br/><br/>";
        echo "終了しました。";
      }

      } catch (PDOException $e){   
         echo $e->getMessage();
         exit;
      }
      ?>

      <br><br>
  <FORM>
    <INPUT type="button" value="HOME" onClick="location.href='../index.php'">
    <INPUT type="button" value="戻る" onClick="history.back()">
  </FORM>
 </body>
</html>
