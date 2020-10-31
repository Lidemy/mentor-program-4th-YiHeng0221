<?php ?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>登入</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="warning">
  	<strong>
  	  注意！本站為練習用網站，因教學用途刻意忽略資安實作，註冊時請勿使用任何真實的帳號或密碼。
  	</strong>
  </header>
  <main class="wrap">
  	<div class="add_comment-card">
  	  <form method="POST" action="handle_login.php">

        <div class="login"> 
          帳號：
          <input type="text" name="username">
        </div>

        <div class="login">
          密碼：
          <input type="password" name="password">
        </div>
        <?php
  	      if(!empty($_GET['errCode'])){
  	  	    $code = $_GET['errCode'];
  	  	    $msg = 'Error';
  	  	    if($code === '1') {
  	  	      $msg = '錯誤：請輸入帳號或密碼';
  	  	    } else if($code === '2') {
              $msg = '錯誤：帳號或密碼輸入錯誤';  
            }
  	  	    echo '<h3 class="error">' . $msg . '</h3>';
  	      }
  	    ?>

	    <input type="submit" class="btn">
      </form>
  	</div>

  </main>
  <footer class="under">
  	<div class="btns">
	  <a class = "btn" href="index.php">回留言板</a>
      <a class = "btn" href="register.php">註冊</a>
  	</div>
  </footer>
</body>
</html>
