<?php
//セッションを使うことを宣言
session_start();

//ログインされていない場合は強制的にログインページにリダイレクト
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit();
}

//ログインされている場合は表示用メッセージを編集
$message = $_SESSION['name']."さんようこそ";
$message = htmlspecialchars($message);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
<h1>ログイン成功ページ</h1>
<div class="message"><?php echo $message;?></div>
<a href="logout.php">ログアウト</a>
</body>
</html>