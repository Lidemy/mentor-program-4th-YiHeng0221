
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
  	  <form method="POST" action="handle_updateNickname.php">
  	  	<div class="login"> 
          新暱稱：
          <input type="text" name="nickname">
        </div>
        <?php
  	      if(!empty($_GET['errCode'])){
  	  	    $code = $_GET['errCode'];
  	  	    $msg = 'Error';
  	  	    if($code === '1') {
  	  	      $msg = '錯誤：請輸入資料';
  	  	    } else if($code === '1062') {
              $msg = '錯誤：暱稱重複';  
            } else if($code === '2') {
              $msg = '錯誤：暱稱過長';  
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
  	</div>
  </footer>
</body>
</html>
