
<?php
session_start(); 
/*
	啟動 php 內建session 機制，php 的 response 就會在背後產生一個 cookie，裡面含有 session id 的內容，步驟為：
	1. 從 cookie 內讀取 PHPSESSID(token)
	2. 從檔案裡面讀取 session id 的內容
	3. 放到 $_SESSION
*/
require_once('conn.php');
require_once('utils.php');
$username = NULL;
if(!empty($_SESSION['username'])) {
  // 用來判斷用戶是否有登入
  $username = $_SESSION['username'];
  // 有登入的話將用戶名稱存於變數中
  $user = getUserFromUsername($_SESSION['username']);
  $nickname = $user['nickname'];
}
$stmt = $conn->prepare('select * from YiHeng_board_comments order by id desc');
$result = $stmt->execute();
if(!$result){
  die('error:' . $conn->error);
}
$result = $stmt->get_result();
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
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
      <?php if(!$username) { ?>
      	<h2>請登入後留言</h2>
      	<textarea name="comment" rows="5" placeholder="請登入後留言"></textarea>
      <?php }else { ?>
  	    <h2>建立留言</h2>
  	    <div class="user-card">
  	  	  <div class="card__avatar"></div>
  	  	  <div class="comment-card__body">
  	  	    <span class="card__nickname"><?php echo escape($nickname); ?></span>
  	  	    <span class="card__username"><?php echo escape($username); ?></span>
  	  	  </div>
  	    </div>
  	    <form method="POST" action="handle_add_comment.php">
          <textarea name="comment" rows="5" placeholder="請輸入留言"></textarea>
	      <input type="submit" class="btn">
        </form>
        <?php
  	      if(!empty($_GET['errCode'])){
  	  	    $code = $_GET['errCode'];
  	  	    $msg = 'Error';
  	  	    if($code === '1') {
  	  	      $msg = '請輸入留言';
  	  	    }
  	  	    echo '<h2 class="error">' . $msg . '</h2>';
  	      }
  	    }
  	    ?>
  	</div>
  	  
  	  <?php while($row = $result->fetch_assoc()){ ?>

  	    <div class="comment-card">
          <div class="card__avatar"></div>
          <div class="card__body">
  	  	    <div class="card__info">
  	  	      <div class="comment-card__body">
  	  	        <span class="card__nickname"><?php echo escape($row['nickname']); ?></span>
  	  	        <span class="card__username"><?php echo escape($row['username']); ?></span>
  	  	      </div>
  	  	      <span class="card__timestamp"><?php echo escape($row['created_at']); ?></span> 
  	  	    </div>
  	  	    <p class="card__content"><?php echo escape($row['comment']); ?></p>
  	      </div>
  	    </div>
  	  <?php } ?>

  </main>
  <footer class="under">
  	<div class="btns">
  	  <?php if(!$username){ ?>
  	  	<a class = "btn" href="login.php">登入</a>
        <a class = "btn" href="register.php">註冊</a>
      <?php } else { ?>
      	<a class = "btn" href="logout.php">登出</a>
      <?php } ?>
  	</div>
  </footer>
</body>
</html>
