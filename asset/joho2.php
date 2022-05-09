<?php
define( "DB_HOST", "localhost" );
define( "DB_USER", "admin03" );
define( "DB_PASS", "Admin!_03" );
define( "DB_NAME", "check_anpi" );
define( "DB_CHARSET", "utf8mb4" );

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:joho.php');
    exit();
  }

  $postdata = filter_input_array(INPUT_POST,$filter_array);
  var_dump($postdata);
  if(in_array(NULL,$postdata,true)){
    exit("不正データが検出されました。");
  }

  session_start();
  $_SESSION["joho"] = $postdata;

  if(in_array(false,$postdata,true)){
    if(!$postdata["text"]){
    $_SESSION["errmessage"] = "入力してください";
    }
    header('Location: joho.php');
    exit();
    }
    $instance = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

  if( ! $instance -> connect_error ) {

    $instance -> set_charset (DB_CHARSET);

    $sql = "INSERT INTO anpi(text,time)VALUES ( ? )";

        if( $stmt = $instance -> prepare( $sql )){

            
            $stmt -> bind_param( "s", $postdata["text"]);
            $stmt -> execute();
            if($stmt -> affected_rows==1){
               $instance ->commit();
                // header("Location: kadai07_1.php?product_no={$postdata["product_no"]}");
                echo("せいこう");

            }else{
                $instance ->rollback();
                $_SESSION["errmessage"] = "登録ができませんでした。";
                header('Location:joho.php');

            }
            $stmt -> close();
        }
        $instance -> close();
    }






?>
