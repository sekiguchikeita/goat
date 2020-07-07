<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
session_start();
$lid = $_SESSION['lid'];

$daily_taskid = $_POST['daily_taskid'];
$daily_progress = $_POST['daily_progress'];
$daily_tag = $_POST['daily_tag'];

// $total_taskid = $_POST['total_taskid'];
// $total_progress = $_POST['total_progress'];
// $total_tag = $_POST['total_tag'];

$total_taskid = 1;
$total_progress = 50;
$total_tag = 'js';

// $user = $_POST['user'];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();





//３．データ登録SQL作成 // bined var (:dsakj) to recieved value from Post request to html
$stmt = $pdo->prepare("INSERT INTO detail_summary1(lid,taskid,achievement,tag,indate )VALUES(:lid, :taskid, :achievement, :tag, sysdate() )");
$stmt->bindValue(":lid", $lid, PDO::PARAM_STR);
$stmt->bindValue(":taskid", $daily_taskid, PDO::PARAM_INT);  // IT SHOULD BE CORRESPONDED TO YOUR SETTING ON DB IN MYSQLFOR STR : Integer（数値の場合 PDO::PARAM_INT) 
$stmt->bindValue(":achievement", $daily_progress, PDO::PARAM_INT);
$stmt->bindValue(":tag", $daily_tag, PDO::PARAM_STR);  
$status = $stmt->execute(); // IT returns boolean (fail or success)

//４．データ登録処理後
if($status==false){
  //*** function化する！*****************
  sql_error($stmt);
}else{
  //*** function化する！*****************
//   redirect("index.php");
}


//３．データ登録SQL作成 // bined var (:dsakj) to recieved value from Post request to html
$stmt_ = $pdo->prepare("INSERT INTO detail_summary2(lid,taskid,progress,tag,indate )VALUES(:lid, :taskid, :progress, :tag, sysdate() )");
$stmt_->bindValue(":lid", $lid, PDO::PARAM_STR);
$stmt_->bindValue(":taskid", $total_taskid, PDO::PARAM_INT);  // IT SHOULD BE CORRESPONDED TO YOUR SETTING ON DB IN MYSQLFOR STR : Integer（数値の場合 PDO::PARAM_INT) 
$stmt_->bindValue(":progress", $total_progress, PDO::PARAM_INT);
$stmt_->bindValue(":tag", $total_tag, PDO::PARAM_STR);  
$status_ = $stmt_->execute(); // IT returns boolean (fail or success)

//４．データ登録処理後
if($status_==false){
  //*** function化する！*****************
  sql_error($stmt_);
}else{
  //*** function化する！*****************
  redirect("result_detail.php");
}
