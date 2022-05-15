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
  echo "aaaa";

  $sql = "UPDATE employee SET password = '$Newpassword' WHERE id = '$id'";

  //SQLを実行
  if (!$res = $instance->query($sql)) {
    echo $sql;
    $instance->rollback();
    //データベースから切断
    $instance->close();
    exit;
  }
  header("Location:index.php");

$instance->commit();
/* 接続を閉じます */
$instance->close();
}



//   // クエリの実行
//   $query = "SELECT * FROM employee WHERE id='$id'";
//   $result = $instance->query($query);
//   if (!$result) {
//     print('クエリーが失敗しました。' . $instance->error);
//     $instance->close();
//     exit();
//   }

//   // パスワード(暗号化済み）とユーザーIDの取り出し
//   while ($row = $result->fetch_assoc()) {
//     $db_hashed_pwd = $row['password'];
//     $id = $row['id'];
//   }

  // データベースの切断


  // ハッシュ化されたパスワードがマッチするかどうかを確認
//   if (password_verify($password, $db_hashed_pwd)) {
//     $_SESSION['id'] = $id;
//     header("Location:joho.php");
//     exit;
//   } else { 


?>


<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <title>login</title>
 <link href="./asset/css/logsinki.css" rel="stylesheet">
</head>
<body>

<!-- <div class="login">
    <div class="login-triangle"></div>
    
    <h2 class="login-header">Log in</h2>
  
    <form action="#" class="login-container" method="post">
      <p><input type="id" placeholder="ID"></p>
      <p><input type="name" placeholder="Name"></p>
      <p><input type="password" placeholder="Password"></p>
      <p><input type="submit" value="Log in"></p>
    </form>
  </div>


</body>
</html>  -->


<div class="form-wrapper">
  <h1>パスワード再設定</h1>
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