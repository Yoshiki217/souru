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
  $time  = time();
  $sql = "INSERT INTO anpi (id,time,status,text) value ('22s2211',$time,'1','大丈夫') ";
  //SQLを実行
  if (!$res = $instance->query($sql)) {
    echo "SQL実行時エラー" ;
    echo $sql;
    $instance->rollback();
    //データベースから切断
    $instance->close() ;
    exit;
  }
  $instance->commit();
  /* 接続を閉じます */
  $instance->close();
?>
