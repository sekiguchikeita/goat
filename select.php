<!--仮想sns postページ -->

<?php


session_start();
include("funcs.php");
loginCheck();



//1.  DB接続します
$pdo = db_conn();
//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM plan_table INNER JOIN summary_table ON plan_table.taskid = summary_table.taskid");

//$stmt = $pdo->prepare("SELECT * FROM crud");
$status = $stmt->execute();


//３．データ表示

if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  // the belw says extract line by line
  // $result is like (event) of event listner
  // if you have 10 rows, result ganna work 10 times (like map 's elem)
  while( $r[] = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    //$view .= '<p>'.$r['id'].": ".$r['title'].'</p>';  //.= ,eams += in js , connect & update one by one
    //$view .= "$r[url]";
    //$view .= "<p>";
    $json = json_encode($r);
    
  }

}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>共有画面（達成度）</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" type="text/css" href="./style.css">

<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<!--id="main"-->
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">計画表</a>
      <a class="navbar-brand" href="result.php">ユーザーページ（結果まとめページ想定）</a>
      <a class="navbar-brand" href="logout.php">Logout</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <h1>共有画面（達成度）</h1>
    <div class=""></div>
    <div id=archive class=wrapper style="display: flex;
        display: grid;
        margin: auto;
        grid-template-columns: 1fr ;
        
    ">
    </div>

</div>
<!-- Main[End] -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  let datas; 
  if (!'<?=$json?>') {
    datas = ("empty")
  } else {
    datas = JSON.parse('<?=$json?>')
    
  

  console.log(datas)
  console.log(datas[0].taskid)
  datas.map(data => 
    $('#archive').append( 
      `<div class="card" style=
        "width:80%; 
        margin: auto;
        display: flex;
        
        ">
          <img src="https://robohash.org/${data.id}?200*200" style="width:20%">


          <div class="container">
            <h3>User: ${data.name} </h3>
            <a href="detail.php?taskid=${data.taskid}">
            <h3>Task: ${data.task} </h3> </a>
            <h3>Rec date: ${data.indate} </h3> 
            <h3>Date: ${data.end_date} </h3> 
            <h3>Tag: ${data.tag} </h3> 
            <h3>Achievement Rate: ${data.stop_watch}/${data.how_long} ％</h3>

            <a href="delete.php?taskid=${data.taskid}"> <i class="far fa-trash-alt"></i></a>
            <br>
           
            <p> ${data.comment} </p>
          </div>



        </div>
      <div>`)
    )
  }
  
</script>


</body>
</html>
