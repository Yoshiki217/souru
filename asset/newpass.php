<?php
define( "DB_HOST", "localhost" );
define( "DB_USER", "admin03" );
define( "DB_PASS", "Admin!_03" );
define( "DB_NAME", "check_anpi" );  


//データベースに接続
$instance = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
 
if($instance->connect_error){
  echo "Failed to connect to MySQL: ";
  exit;
}

//データベースを選択
if (!$instance->select_db("check_anpi")) {
  echo "データベース選択エラー" ;
  exit ;
}

$instance->begin_transaction();

// ログインボタンがクリックされたときに下記を実行

if(isset($_POST['CHANGE'])) {
  $id = $_POST['id'];
  $Newpassword = $_POST['Newpassword'];
  $Newpassword = password_hash($Newpassword, PASSWORD_DEFAULT);

  $sql = "SELECT * FROM anpi WHERE id = '$id'";
  $res = mysqli_query($instance, $sql);
  while($row = mysqli_fetch_assoc($res)){
    $name=$row['name'];
  }
  if(!empty($name)){
    $sql1 = "UPDATE employee SET password = '$Newpassword' WHERE id = '$id'";
    //SQLを実行
    if (!$res = $instance->query($sql1)) {
      $instance->rollback();
      //データベースから切断
      $instance->close();
      exit;
      header("Location:index.php");
    }
  }else{
    $message="アカウントが存在しません";
  }

$instance->commit();
/* 接続を閉じます */
$instance->close();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <title>login</title>
 <link href="./asset/css/logsinki.css" rel="stylesheet">
</head>
<body>

<div class="form-wrapper">
  <h1>パスワード再設定</h1>
  <?php if( !empty( $message ) ): ?>
    <p><?php echo $message; ?></p>
    <?php endif; ?>
  <form action="#" method="post">
    <div class="form-item">
      <label for="ids"></label>
      <input type="text" name="id" required="required" placeholder="ID"></input>
    </div>
    <div class="form-item">
      <label for="Newpassword"></label>
      <input type="password" name="Newpassword" required="required" placeholder="NewPasswordCreate"></input>
    </div>
    <div class="button-panel">
     <input type="submit" class="button" value="CHANGE" name="CHANGE"></input>
     <!--  <button type='subnit' class="button">LOGIN</button>-->
    </div>
  </form>
  <div class="form-footer">
    <p><a href="createUser.php">アカウントを作る</a></p>
  </div>
</div>



</body>
</html>