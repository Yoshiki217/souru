<?php

session_start();

define( "DB_HOST", "localhost" );
define( "DB_USER", "admin03" );
define( "DB_PASS", "Admin!_03" );
define( "DB_NAME", "check_anpi" );  


//データベースに接続
$instance = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
 
//ログイン状態の場合ログイン後のページにリダイレクト
if (isset($_SESSION["login"])) {
  session_regenerate_id(TRUE);
  header("Location: joho.php");
  exit();
}

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
if(isset($_POST['LOGIN'])) {
  $id = $_POST['id'];
  $password = $_POST['password'];

  // クエリの実行
  $query = "SELECT * FROM employee WHERE id='$id'";
  $result = $instance->query($query);
  if (!$result) {
    $instance->close();
    exit();
  }

  // パスワード(暗号化済み）とユーザーIDの取り出し
  while ($row = $result->fetch_assoc()) {
    $db_hashed_pwd = $row['password'];
    $id1 = $row['id'];
    $name = $row['name'];
  }
  // ハッシュ化されたパスワードがマッチするかどうかを確認
  if (password_verify($password, $db_hashed_pwd)) {
   //　一致したとき 
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION["login"] = $_POST['id']; //セッションにログイン情報を登録
    header("Location:joho.php");
    exit;
  } else {
    $message="パスワードが一致しません。";
  }
  // データベースの切断
  $result->close();
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
  <h1>安否確認</h1>
  <?php if( !empty( $message ) ): ?>
    <p><?php echo $message; ?></p>
    <?php endif; ?>
  <form action="#" method="post">
    <div class="form-item">
      <label for="ids"></label>
      <input type="text" name="id" required="required" placeholder="ID"></input>
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="password" required="required" placeholder="Password"></input>
    </div>
    <div class="button-panel">
     <input type="submit" class="button" value="LOGIN" name="LOGIN"></input>
     <!--  <button type='subnit' class="button">LOGIN</button>-->
    </div>
  </form>
  <div class="form-footer">
    <p><a href="createUser.php">アカウントを作る</a></p>
    <p><a href="newpass.php">パスワードをお忘れですか？</a></p>
  </div>
</div>



</body>
</html>