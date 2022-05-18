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

// ボタンが押されたとき
if(isset($_POST['create'])) {
  $id = $_POST['id'];
  $password = $_POST['password'];
  $password = password_hash($password, PASSWORD_DEFAULT);
//name取り出すための処理
$sql = "SELECT * FROM employee WHERE id='$id'";//
  if (!$result = $instance->query($sql)) {
    print('クエリーが失敗しました。' . $instance->error);
    $instance->close();
    exit();
  }
  // name取り出し
  while ($row = $result->fetch_assoc()) {
    $name = $row['name'];
  }
   //パスワードがすでに格納されているかのチェック
   $sql1 = "SELECT * FROM employee where id='$id'";
   $res = mysqli_query($instance, $sql1);
   while($row = mysqli_fetch_assoc($res)) {
     $pass=$row['password'];
   }
   //NULLの時
   if(!$pass){
      // パスワード挿入
      $sql2 = "UPDATE employee SET password = '$password' WHERE id = '$id'";
      if (!$result = $instance->query($sql2)) {
        print('クエリーが失敗しました。' . $instance->error);
        $instance->rollback();
        $instance->close();
        exit();
      }
      //anpiテーブルにIDとname挿入
      $sql3 = "INSERT INTO anpi(id,name,status)VALUE($id,'$name','無回答')";
      if (!$result = $instance->query($sql3)) {
        print('クエリーが失敗しました。' . $instance->error);
        $instance->rollback();
        $instance->close();
        exit();
      }
      header("Location:index.php");
   }else{
     print('アカウントが存在します。');
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
 <title>create</title>
 <link href="./asset/css/logsinki.css" rel="stylesheet">
</head>
<body>

<div class="form-wrapper">
  <h1>新規作成</h1>
  <form action="#" method="post">
    <div class="form-item">
      <label for="id"></label>
      <input type="text" name="id" required="required" placeholder="ID"></input>
    </div>
    <div class="form-item">
      <label for="name"></label>
      <input type="text" name="name" required="required" placeholder="Name"></input>
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="password" required="required" placeholder="Password"></input>
    </div>
    <div class="form-item">
    <div class="cp_ipselect">
      <label for="place"></label>
      <select class="cp_sl06" required>
        <option value="" hidden disabled selected></option>
        <optgroup label="営業">
        <option value="1">営業一課</option>
        <option value="2">営業二課</option>
      </optgroup>
      <optgroup label="総務">
        <option value="3">経理課</option>
        <option value="4">厚生課</option>
      </optgroup>
      <optgroup label="人事">
        <option value="5">人事課</option>
        <option value="6">教育課</option>
      </optgroup>
      </select> 
      <span class="cp_sl06_highlight"></span>
      <span class="cp_sl06_selectbar"></span>
      <label class="cp_sl06_selectlabel">Belong</label>
    </div>
  </div>
    <div class="button-panel">
      <input type="submit" class="button" value="create" name="create"></input>
    </div>
 
  </form>
  <div class="form-footer">
    <p><a href="index.php">ログインする</a></p>
    <!--<p><a href="#">パスワードをお忘れですか？</a></p>-->
  </div>
</div>
</body>

</html>

