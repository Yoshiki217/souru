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

$sql = "SELECT * FROM employee";

if($kekka = $instance -> query($sql)){
  $result["status"] = true;
  while( $row = $kekka -> fetch_array( MYSQLI_ASSOC ) ) {
    $result[ "result" ][]= $row;
  }
  $kekka -> close();
}

$instance -> close();


?>


<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <title>anpjoho</title>
 <link href="./asset/css/joho.css" rel="stylesheet">
</head>


<body>

<div class="ue">

  <h1>安否情報</h1>

  <div class="oyakudachi"><a href="https://www.fdma.go.jp/relocation/bousai_manual/index.html">お役立ち情報</a></div>


  <div id="kensaku">
    <form action="anpijoho.html" method="get">
    <input type="search" name="search" placeholder="キーワードを入力">
    <input type="submit" name="submit" value="検索">
    </form>
  </div>

 
                        <div class="tab">
                            <nav>
                              <ul class="busho">
                                <li class="sentaku">
                                  <a href="#">ALL</a>
                                </li>
                                <li class="sentaku">
                                  <a href="#">営業</a>
                                </li>
                                <li class="sentaku">
                                  <a href="#">経理</a> 
                                </li>
                                <li class="sentaku">
                                  <a href="#">人事</a> 
                                </li>
                        
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>

</div>
        <div class="split-item split-center">

              <?php foreach ($result["result"] as $employee): ?>
            
            <div class="split-center__inner">
              <div class="card card-skin">
                    <div class="card__imgframe"></div>
                        <div class="card__textbox">
                          <div class="card__titletext">
                            タイトルがはいります。タイトルがはいります。
                          </div>
                          <div class="card__overviewtext">
                          <tr class="tracking-wider border-b border-gray-200 hover:bg-gray-100 ">
                            <td class="h-10 px-6 py-5"><?= $employee["EMP_NO"] ?></td>
                            <td class="h-10 px-6 py-5"><?= $employee["ENAME"] ?></td>
                            <td class="h-10 px-6 py-5"><?= $employee["BIRTHDAY"] ?></td>
                            <td class="h-10 text-center px-6 py-5"></td>
                          </tr>
                          </div>
                        </div>
                      </div>
              </div>
  

              <?php endforeach ?>
                    
        </div>
        <div class="form-wrapper">
          <h1>情報登録</h1>
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
              <input type="submit" class="button" value="LOGIN"></input>
            </div>
          </form>
          <div class="form-footer">
            <p><a href="sinki.html">アカウントを作る</a></p>
            <!--<p><a href="#">パスワードをお忘れですか？</a></p>-->
          </div>
        </div> 


     
   

        <div class="split-item split-right">
          <div class="split-right__inner">
            <div class="button-panel">
              <a href="https://www.jma.go.jp/jma/index.html">気象庁</a>
            </div>
          </div>
        </div>
</div>



</body>
</html>
