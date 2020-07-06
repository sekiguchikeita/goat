

<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
session_start();
// dbからtaskid,lidを引っ張ってくる
// $taskid = $_POST['taskid'];
// $lid = $_SESSION['lid'];

//lidはsessionで受け取る

$aaa = 5; //lid
$bbb = '5'; //taskid
$stop_watch = $_POST['user'];



//echo gettype($sum_1day);



//2. DB接続します
include("funcs.php");
$pdo = db_conn();



//３．データ登録SQL作成 // bined var (:dsakj) to recieved value from Post request to html
$stmt = $pdo->prepare("INSERT INTO outcome_table(lid,taskid,stop_watch,indate)VALUES($aaa,$bbb,:stop_watch,sysdate())");
// $stmt->bindValue(":taskid", $taskid, PDO::PARAM_INT); 
// $stmt->bindValue(":lid", $lid, PDO::PARAM_STR); 
$stmt->bindValue(":stop_watch", $stop_watch, PDO::PARAM_INT);  // IT SHOULD BE CORRESPONDED TO YOUR SETTING ON DB IN MYSQLFOR STR : Integer（数値の場合 PDO::PARAM_INT) 
$status = $stmt->execute(); // IT returns boolean (fail or success)





//４．データ登録処理後
if($status==false){
  //*** function化する！*****************
  sql_error($stmt);
}else{
  //*** function化する！*****************
  
}

?>