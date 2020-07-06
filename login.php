<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Log in</title>
  <link rel="stylesheet" href='css/reset.css'>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/login.css">

  
  <style></style>
</head>
<body>
<div id="wrapper">
<!-- Head[Start] -->

<header>
<nav>
 <div class="drawer">
 <!--- いわゆるロゴ svg を利用------>
   <div id="logo"><a href="main.php">GOAT</a></div>
 

  </div>
 <!-------------- drawer ここまで-->
 
 <div class="menu">
  <ul>
   <li class="aaa"><a href="main.php">ホーム</a></li>
   <li class="b"><a href="index.php">計画</a></li>
   <li class="c"><a href="result.php">結果</a></li>
   <li class="d"><a href="select.php">共有</a></li>
   <li class="d"><a href="signup.php">Sign Up</a></li>
  </ul>
 </div>
</nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="login_act.php">
  <div class="fieldset">
   <fieldset>
    <legend>Login</legend><br><br>
     <label><input type="text" name="lid" placeholder="Login Id"></label><br><br><br>
     <label><input type="text" name="lpw" placeholder="password"></label><br><br>
     <br>
     <input type="submit" value="submit">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<footer>
  <p class="footer"> (C) g's academy</p>
</footer>

</div>
</body>
</html>
