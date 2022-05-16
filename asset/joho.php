<?php

define( "DB_HOST", "localhost" );
define( "DB_USER", "admin03" );
define( "DB_PASS", "Admin!_03" );
define( "DB_NAME", "check_anpi" );
define( "DB_CHARSET", "utf8mb4" );

$result = [
  "status" => false,
  "message" => "現在システムを利用することができません",
  "result" => []
  ];


$instance = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

if( ! $instance -> connect_error ) {
  $instance -> set_charset (DB_CHARSET);
}


  $sql = "SELECT * FROM anpi";
  if($kekka = $instance -> query($sql)){
    $result["status"] = true;
    while( $row = $kekka -> fetch_array( MYSQLI_ASSOC ) ) {
      $result[ "result" ][]= $row;
    }
    $kekka -> close();
  }

$instance->commit();





session_start();
$errmessage = "";
$joho["text"] = "";

if(isset($_SESSION["joho"])){
  $old = $_SESSION["joho"];
  }
  if(isset($_SESSION["errmessage"])){
  $errmessage = $_SESSION["errmessage"];
  }





?>


<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <title>anpjoho</title>
 <link href="./asset/css/joho.css" rel="stylesheet">
</head>


<body>

<div class="header">

          <div  class="nakami"><h1>安否情報</h1></div>

                        <div class="nakami">
                            <nav>
                              <ul class="busho">
                                <li>
                                <form action="joho.php" method="post">
                                    <input type="submit" name="ALL" value="ALL" />
                                </form>
                                </li>
                                <li>
                                <form action="joho.php" method="post">
                                    <input type="submit" name="AGYO" value="営業" />
                                </form>
                                </li>
                                <li>
                                <form action="joho.php" method="post">
                                    <input type="submit" name="KRI" value="経理" />
                                </form>
                                </li>
                                <li>
                                <form action="joho.php" method="post">
                                    <input type="submit" name="JINJI" value="人事" />
                                </form>
                                </li>
                        
                              </ul>
                            </nav>
                        </div>
              
            <div class="nakami"><a class="link" href="https://www.fdma.go.jp/relocation/bousai_manual/index.html">お役立ち情報</a></div>
      <div class="nakami">
        <form action="anpijoho.html" method="get">
        <input type="search" name="search" placeholder="キーワードを入力">
        <input type="submit" name="submit" value="検索">
        </form>
      </div>



 
                        

</div>
        <div id="split-center">

              <?php foreach ($result["result"] as $anpi): ?>
            
            <div class="inner">
              <div class="card card-skin">
                        <div class="card__textbox">
                          <!-- <div class="card__titletext">
                            
                          </div> -->
                          <div class="card__overviewtext">
                          <tr class="tracking-wider border-b border-gray-200 hover:bg-gray-100 ">
                            <td><?= $anpi["name"]?></td>
                            <td><?= $anpi["status"] ?></td>
                            <td><?= $anpi["text"] ?></td>
                            <td class="time"><?= $anpi["time"] ?></td>
                          </tr>
                          </div>
                        </div>
                </div>
             </div>
                <?php endforeach ?>
              
        </div>


      <div id="split-right"> 
      <div class="form-wrapper">     
          <h1>情報登録</h1>
          <p class="text-red-600"><?= $errmessage ?></p>
          <form action="joho2.php" method="post">
          <div class="form-item">
          <label for="status">状況</label>
                <select name="status" id="status">
                  <option 
                    value="安全"
                  >安全</option>
                  <option 
                    value="怪我しました"
                  >怪我しました</option>
                <option 
                    value="助けてください"
                  >助けてください</option>
                </select>
              </div>
            <div class="form-item">
            <label for="description">コメント</label>
            <textarea name="text" id="text"value="<?= $joho["text"] ?>"></textarea>
            </div>
            <div class="button-panel">
              <input type="submit" class="button" value="登録"></input>
            </div>
          </form>
      </div>
      <div class="button-panel">
              <a class ="link" id="kishou" href="https://www.jma.go.jp/jma/index.html">気象庁</a>
            </div>

                     
      <form action="logout.php" method="post">
            <div class="button-panel">
              <input type="submit" class="logout" value="🙋"></input>
            </div>
          </form>

   


</body>
</html>