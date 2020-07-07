<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
session_start();
$lid = $_SESSION['lid'];
$achievement = $_POST['achievement'];
$progress = $_POST['progress'];
// $study_hours = $_POST['study_hours'];
// $user = $_POST['user'];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成 // bined var (:dsakj) to recieved value from Post request to html

//----- summary_table -----
$stmt = $pdo->prepare("INSERT INTO summary_table(lid,achievement,indate )VALUES(:lid, :achievement, sysdate() )");
$stmt->bindValue(":lid", $lid, PDO::PARAM_STR); 
$stmt->bindValue(":achievement", $achievement, PDO::PARAM_INT);
// $stmt->bindValue(":study_hours", $study_hours, PDO::PARAM_INT);
$status = $stmt->execute(); // IT returns boolean (fail or success)

//４．データ登録処理後
if($status==false){
  //*** function化する！*****************
  sql_error($stmt);
}else{
  //*** function化する！*****************
//   redirect("index.php");
}


//----- summary2_table -----
$stmt_ = $pdo->prepare("INSERT INTO summary2_table(lid,progress )VALUES(:lid, :progress )");
$stmt_->bindValue(":lid", $lid, PDO::PARAM_STR); 
$stmt_->bindValue(":progress", $progress, PDO::PARAM_INT);
$status_ = $stmt_->execute(); // IT returns boolean (fail or success)

//４．データ登録処理後
if($status_==false){
  //*** function化する！*****************
  sql_error($stmt_);
}else{
  //*** function化する！*****************
  redirect("result_summary-1.php");
}


?>