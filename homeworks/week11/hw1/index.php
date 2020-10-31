
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
$page = 1;
if (!empty($_GET['page'])) {
  $page = intval($_GET['page']);
}
$limit = 5;
$offset = ($page -1) * $limit;  

$stmt = $conn->prepare('select * from YiHeng_board_comments left join YiHeng_board_users on YiHeng_board_comments.username = YiHeng_board_users.username where YiHeng_board_comments.is_deleted is NULL ORDER BY comment_id DESC limit ? offset ?');
$stmt->bind_param('ii', $limit, $offset);
$result = $stmt->execute();
if(!$result){
  die('error: ' . $conn->error);
}

$result = $stmt->get_result();
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
  	  	    <span class="card__username">
            <?php 
              echo escape($username); 
              echo authorityIcon($username);
            ?>
            </span>
  	  	  </div>
  	    </div>
        <?php
          if(!isBanned($username)) { ?>
            <form method="POST" action="handle_add_comment.php">
            <textarea name="comment_content" rows="5" placeholder="請輸入留言"></textarea>
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
          } else { ?>
            <h2 style="color: red;">您已被停權</h2>
            <textarea name="comment" rows="5" placeholder="請登入後留言"></textarea>
        <?php
          }
        }
        ?>	    
  	  </div>
  	  
  	  <?php while($row = $result->fetch_array()){ 
        if($row['is_deleted'] === null) { ?>

  	    <div class="comment-card">
          <div class="card__avatar"></div>
          <div class="card__body">
  	  	    <div class="card__info">
  	  	      <div class="comment-card__body">
  	  	        <span class="card__nickname"><?php echo escape($row['nickname']); ?></span>
  	  	        <span class="card__username">
                  <?php echo escape($row['username']);
                    echo authorityIcon($row['username']);
                  ?>  
                </span>
  	  	      </div>
  	  	      <span class="card__timestamp"><?php echo escape($row[3]); ?></span> 
  	  	    </div>
  	  	    <p class="card__content"><?php echo escape($row['comment_content']); ?></p>
  	      </div>
          <?php if($username) { ?>
            <div class="card__editors">
              <?php if($row['username'] == $username) { 
                ?>
                <a class="card__edit" href="update_comment.php?comment_id=<?php echo $row['comment_id'] ?>"><i class='far fa-edit'></i></a>
              <?php }
              if($row['username'] == $username || isAdmin($username)) { ?>
                <a class="card__delete" href="handle_delete_comment.php?comment_id=<?php echo $row['comment_id'] ?>"><i class='far fa-trash-alt'></i></a>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
          <?php } 
        }?>


        <?php
            $stmt = $conn->prepare('select count(comment_id) as count from YiHeng_board_comments where is_deleted is NULL');
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $count = $row['count'];
            $total_page = ceil($count / $limit);
          ?>
        <div class="comment-card">
          <div class="comment_pages">
            <div>共有 <?php echo $row['count']; ?> 則留言</div>
            <div>
              <?php if ($page != 1) { ?> 
              <a class="comment_page-number" href="index.php?page=<?php echo $page - 1 ?>">上一頁</a>
              <?php } ?>
              <?php if ($page != $total_page) { ?>
              <a class="comment_page-number" href="index.php?page=<?php echo $page + 1 ?>">下一頁</a>
              <?php } ?>
            </div>
            <a class="comment_page-number" href="index.php?page=1">首頁</a>
            <div class="comment_page-numbers">
            <?php for($i = 1; $i <= $total_page; $i ++) { 
              if($page == $i){ ?>
                <a class="the_page"><?php echo $i; ?></a><?php
              } else { ?>
              <a class="comment_page-number" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php
              } 
            } ?>
            </div>
            <a class="comment_page-number" href="index.php?page=<?php echo $total_page; ?>">最末頁</a>
          </div>
        </div>

  </main>
  <footer class="under">
  	<div class="btns">
  	  <?php if(!$username){ ?>
  	  	<a class = "btn" href="login.php">登入</a>
        <a class = "btn" href="register.php">註冊</a>
      <?php } else { ?>
      	<a class = "btn" href="logout.php">登出</a>
        <a class = "btn" href="updateNickname.php">修改暱稱</a>
        <?php if(isAdmin($username)){ ?>
          <a class = "btn" href="admin.php">管理頁面</a>
        <?php } ?>
      <?php } ?>
  	</div>
  </footer>
</body>
</html>
