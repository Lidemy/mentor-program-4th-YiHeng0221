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
    $id = $_GET['comment_id'];
  }
  $stmt = $conn->prepare('select * from YiHeng_board_comments where comment_id = ?
  ');
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  if(!$result){
    die('error:' . $conn->error);
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>修改留言</title>
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
    <h2>修改留言</h2>
    <div class="user-card">
      <div class="card__avatar"></div>
      <div class="comment-card__body">
        <span class="card__nickname"><?php echo escape($nickname); ?></span>
        <span class="card__username"><?php echo escape($username); ?></span>
      </div>
    </div>
    <form method="POST" action="handle_update_comment.php">
      <textarea style="background-color: white;" name="comment_content" rows="5"><?php echo $row['comment_content']; ?></textarea>
    <input type="hidden" name="comment_id" value="<?php echo $row['comment_id']?>" /> 
    <input type="submit" class="btn">
    <!-- 讓 handle_update_acomment.php 知道是 update 哪一個 id。 -->
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
    ?>
  </div>
</main>
  <footer class="under">
  	<div class="btns">
	    <a class = "btn" href="index.php">回留言板</a>
  	</div>
  </footer>
</body>
</html>
