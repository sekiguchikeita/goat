<?php

 session_start();


//1.DB接続します
include("funcs.php");
$pdo = db_conn();



// https://www.flatflag.nir87.com/select-932#SELECT 参考にしたurl
//dbから引っ張ってきた目標時間を試験的に表示するコード
//??はtodo画面でボタンが押された数字が入る

// $sql = "SELECT * FROM outcome WHERE id = ？？";
// $stmt = $dbh->query($sql);
// foreach ($stmt as $row) {
//     echo $row['today'];
//     echo '<br>';
// }





//13に引っ張ってきた目標時間(分)が入る
 $ttt = 5 * 60;
 $php_test = $ttt;
 $json_test = json_encode( $php_test , JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/ja.js"></script>
 

    <title>Document</title>
</head>
<body>

    <div id = 'timer'>
        <div id = 'box'>
            <!-- ここに受け取った時間を表示する. -->
            <!-- 目標は仮に入れている -->
            <p id = 'display'><span id = 'goal'></span></p> 
            <div id= 'center'>
             <button id = 'start'>スタート</button>
            <button id = 'stop'>ストップ</button>
            <button id = 'done'>出力</button>
            <div id = "test" name="test"></div>
            </div>
        </div>
    </div>



  
<script src="https://cdn.jsdelivr.net/vue/latest/vue.js"></script>
    <script>


   
var start_click = false;

//時間データの代入
var time = js_test =JSON.parse('<?php echo $json_test; ?>');
var min = 0;
var sec = 0;

function show(){
    console.log(goal)
    var goal = document.getElementById('goal');
    var goal = getElementById("goal");
    goal.innerHTML = "100分";
}

function count_start(){
    if(start_click === false){
        interval_id = setInterval(count_down , 1000);
        start_click = true;
    }
}

function count_down(){
    var display = document.getElementById('display');
    var test = document.getElementById('test');
    console.log(time);
    if (time === 1 ){
        display.innerHTML = '終了';
    }else{
        time--;
        $(test).val(time) ;
        test.innerHTML = time;
        min = Math.floor(time / 60);
        sen = Math.floor(time % 60);
        display.innerHTML = '' + min +':' + sen ;
        if (min<10){
         display.innerHTML = '0' + min + ':' + sen;
        }
        
        if (sen<10) {
         display.innerHTML = '0' + min + ':' + '0' + sen;
     }
     }
}



function count_stop(){
    clearInterval(interval_id);
    start_click = false;
}



window.onload = function(){
    var start = document.getElementById('start');
start.addEventListener('click' , count_start , false);
var stop = document.getElementById('stop');
stop.addEventListener('click', count_stop , false );
}

    //出力と同時にcount_stopする
    function click(){
    count_stop()
    var time = $('#test').val()
    var time = parseInt(time);
    

    console.log(time);

    

    // 2　ここでHTMLからのインプットヴァリューをOBJ方式に
    let userinfo = {
        'time' : time}

// ３　ここでPOST
    var userInfo = JSON.stringify(time);
    
    $.ajax({
        url: "write1.php", // post先のページを入力
        type: "POST",//メソッド
        data: {user: userInfo},
        success: function (data, textStatus, jqXHR) {
            alert('success data');
             //whatever
        },
        error: function (jqXHR, textStatus, errorThrown) {
             //if fails
            alert('fail');
        }
    
    });
    }


$("#done").on("click", click)

//24時に発動

var midnight = "12:00:00";
var now = null;
setInterval(function () {
    now = moment().format("H:mm:ss");
    if (now === midnight) {
        count_stop();
        click()
    }
    $("#time").text(now);
}, 1000);



    </script>
    
</body>
</html>