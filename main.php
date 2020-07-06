<?php

session_start();
include("funcs.php");
loginCheck();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>main</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  <link rel="stylesheet" href='css/reset.css'>
  <link rel="stylesheet"  href="css/home.css">

</head>
<body>

<header>
<nav>
 <div class="drawer">
 <!--- いわゆるロゴ svg を利用------>
   <div id="logo"><a href="main.php">GOAT</a></div>
 

  </div>
 <!-------------- drawer ここまで-->
 
 <div class="menu">
  <ul>
   <li ><a href="main.php">ホーム</a></li>
   <li ><a href="index.php">計画</a></li>
   <li><a href="result.php">結果</a></li>
   <li ><a href="select.php">共有</a></li>
   <li ><a href="logout.php">Logout</a></li>
  </ul>
 </div>
</nav>
</header>
<!-- Head[End] -->




<footer>
  <p class="footer"> (C) g's academy</p>
</footer>


</body>
</html>