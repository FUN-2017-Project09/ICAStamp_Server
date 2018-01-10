<HTML>
 <BODY>
  <?php
    require_once(__DIR__ . '/../../config/config.php');

    try{
      //connect
      $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      //取得した値を変数に代入 
      $id=$_GET['IDm'];       
      $DAte = date('Y-m-d H:i:s');
      $point=$_GET['point'];
      //各地点の情報を検索    
      $search= $db->prepare("select node from ic_stamp where IDm ='$id'");
      $search->execute();
      //ゴール時刻を検索    
      $Chsearch=$db->prepare("select ChDate from sr_users where IDm ='$id'");
      $Chsearch->execute();
      $change=$Chsearch->fetchAll(PDO::FETCH_ASSOC); 

      if($search->rowCount()==3&&$point>=3){
          if(date('Y/m/d',strtotime($DAte)) === date('Y/m/d',strtotime($change[0]['ChDate']))){
          //ゴール時刻が当日の時の処理
          echo "本日は交換済みです";
          }else{
          //条件達成時の処理
          echo "景品交換条件を満たしています";
          }
      }else{
          //条件未達成時の処理
          echo "景品交換条件を満たしていません";
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
<script>
    function submitChk () {
        var flag = confirm ( "終了してもよろしいですか？\n\n");
        return flag;
       }
</script>  
    <form action="userdelete.php" method="get" onsubmit="return submitChk()">
    <input type="hidden" name="IDm" value="<?=$id?>"> 
	<input type="submit" value="スタンプラリーを終了する"> 
    </form>    
 </body>
</html>
