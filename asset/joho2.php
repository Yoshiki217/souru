<?php

session_start();

define( "DB_HOST", "localhost" );
define( "DB_USER", "admin03" );
define( "DB_PASS", "Admin!_03" );
define( "DB_NAME", "check_anpi" );
define( "DB_CHARSET", "utf8mb4" );

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:joho.php');
    exit();
  }
  $instance = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

  if( ! $instance -> connect_error ) {
    $instance -> set_charset (DB_CHARSET);
  }
  

  $postdata = filter_input_array(INPUT_POST);
  var_dump($postdata);
  if(in_array(NULL,$postdata,true)){
    exit("不正データが検出されました。");
  }

  
  $_SESSION["joho"] = $postdata;
  $id = $_SESSION["id"];
  var_dump($id);


  if(in_array(false,$postdata,true)){
    if($postdata["text"] == ""){
      $_SESSION["errmessage"] = "コメントが入力されていません。";
      header('Location: joho.php');
      exit();
      }
    }



  if( ! $instance -> connect_error ) {


    $instance -> set_charset (DB_CHARSET);

    $sql = "UPDATE anpi SET time = now(), status = ?,text = ? WHERE id = $id";

        if( $stmt = $instance -> prepare( $sql )){
            $stmt -> bind_param( "ss",$postdata["status"], $postdata["text"]);
            $stmt -> execute();

            if($stmt -> affected_rows==1){
               $instance ->commit();
               $_SESSION["errmessage"] = "";
               header("Location:joho.php");

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