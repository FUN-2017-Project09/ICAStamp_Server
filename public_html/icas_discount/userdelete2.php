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
      $stmt= $db->prepare("DELETE from sr_users where IDm ='$id'");
      $stmt2= $db->prepare("DELETE from ic_stamp where IDm ='$id'");   
      //実行
      $stmt->execute();
      $stmt2->execute();

      if(!$stmt->rowCount()){
        echo "IDmは存在しません";
      }else{
        echo "row updated:". $stmt->rowCount()."<br/><br/>";
        echo "削除しました。";
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
