<?php


session_start();
include("funcs.php");
loginCheck();

$lid = $_SESSION['lid'];
//$name = $_SESSION["name"];
//$kanri_flg = $_SESSION["kanri_flg"];
// ここでsessionデータをjs 側に渡すため、json化
//$j = [ $name, $kanri_flg ];

//$jinfo = json_encode($j);

//1.  DB接続します
$pdo = db_conn();
//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM plan_table WHERE lid=:lid");
$stmt->bindValue(":lid", $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
 
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
  <meta charset="UTF-8">
  <title>計画表</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./style.css">
  
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="select.php">共有画面（達成度）</a>
          <a class="navbar-brand" href="result.php">ユーザーページ（結果まとめページ想定）</a>
        </div>
      </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<h1>本日のタスクメニュー</h1>
<!---plan 一覧-->

<h2 style="text-align: center">Your Posts</h2>
    <div id=archive class=wrapper style="
        display: grid;
        margin: auto;
        grid-template-columns: 1fr ;
    ">
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    let datas; 
    if (!'<?=$json?>') {
        datas = ("empty")
    } else {
        datas = JSON.parse('<?=$json?>')

  
    
        datas.map(data => 
            $('#archive').append( 
                `<div class="card" style=
                "width:80%; 
                margin: auto;
                display: flex;
                ">
                    <img src="https://robohash.org/${data.id}?200*200" style="width:20%">
                    

                    <div class="container">
                    <a href="detail.php?taskid=${data.taskid}">
                    <h3> 進捗状況表示（）</h3> </a>
                    <h3> ${data.task} </h3> </a>
                    <h3> アップ日：${data.indate} </h3> 
                    <h3> 完了予定日：${data.end_date} </h3> 
                    <h3> カテゴリー：${data.tag} </h3> 
                    <h3> 所要時間：${data.how_long} </h3>

                    <form method="post" id="plan_post" action="stop.php">
                        <label>今日の予定時間: <select id="today" name="today"></label><br>

                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option> 
                            <option value="5">5</option> 
                            <option value="6">6</option> 
                            <option value="7">7</option> 
                            <option value="8">8</option> 
                            <option value="9">9</option> 
                            <option value="10">10</option> 
                            <option value="11">11</option>
                            <option value="12">12</option> 

                        </select>
                        <label>分: <select id="today" name="todaymin"></label><br>

                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option> 
                            <option value="5">5</option> 
                            <option value="6">6</option> 
                            <option value="7">7</option> 
                            <option value="8">8</option> 
                            <option value="9">9</option> 
                            <option value="10">10</option> 
                            <option value="11">11</option>
                            <option value="12">12</option> 

                        </select></br>

                        <input type="hidden" name="taskid" value=${data.taskid}>
                        <input type="submit" id=plan_submit value="学習スタート">
                        
                    </form></br>

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

<!--<a href="mendy.php?taskid=${{taskid:data.taskid, today:  }}"> 学習スタート（stop watch画面へ）</a>
                    <br>-->