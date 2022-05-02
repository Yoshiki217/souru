<?php
// DBとの接続
include_once '../../dbconnect.php';
// TODO:問題切り分けのため、一旦コメントアウト（POSTデータを使わない）
// CreateがPOSTされたときに下記を実行
// $id = $_POST['id'];
// $name = $_POST['name'];
// $password = $_POST['password'];
// $password = password_hash($password, PASSWORD_DEFAULT);
// TODO:値をダイレクトに入れて、このページから表示
$id = "15011029";
$name = "さぶろー";
$password = "sabu";
$password = password_hash($password, PASSWORD_DEFAULT);
// POSTされた情報をDBに格納する
$query = "INSERT INTO user(id,password) VALUES('$id','$password')";
//TODO:変更ifの条件
if($stmt = $mysqli->prepare($query)) {  
    //TODO:１行追加
  $stmt -> execute();
  $mysqli -> commit(); 
  echo("konnnitiwasabikakkowarai");

} else {  
  $mysqli -> rollback();
}

//TODO:SQL文確認用
var_dump($query);

$stmt -> close();
?>
