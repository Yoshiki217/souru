<?php
// session_start();
// if( isset($_SESSION['user']) != "") {
//   // ログイン済みの場合はリダイレクト
//   header("Location: home.php");
// }
// // DBとの接続
// include_once 'dbconnect.php';

// // CreateがPOSTされたときに下記を実行
//   $id = $_POST['id'];
//   $name = $_POST['name'];
//   $password = $_POST['password'];
//   $password = password_hash($password, PASSWORD_DEFAULT);

//   // POSTされた情報をDBに格納する
//   $query = "INSERT INTO user(id,name,password) VALUES('$id','$name','$password')";

//   if($mysqli->query($query)) {  
//     $mysqli ->commit();
//     } else { 
//     $mysqli->rollback();
//   }
// //上をコメントアウトしてselect文でチェック
// //testが出たら、db接続できてる
// //エラーが出たら、上の分が間違えている


// ここからコピー
// DBとの接続
include_once '../../dbconnect.php';
// TODO:問題切り分けのため、一旦コメントアウト（POSTデータを使わない）
// CreateがPOSTされたときに下記を実行
// $id = $_POST['id'];
// $name = $_POST['name'];
// $password = $_POST['password'];
// $password = password_hash($password, PASSWORD_DEFAULT);
//TODO:値をダイレクトに入れて、このページから表示
$id = "1234";
$name = "さぶろー";
$password = "sabu";
$password = password_hash($password, PASSWORD_DEFAULT);
// POSTされた情報をDBに格納する
$query = "INSERT INTO user(id,name,password) VALUES('$id','$name','$password')";
//TODO:変更ifの条件
if($stmt =$mysqli->prepare($query)) {  
    //TODO:１行追加
  $stmt->execute();
  $mysqli ->commit(); 
} else {  
  $mysqli->rollback();
}
//TODO:SQL文確認用
var_dump($query);

?>