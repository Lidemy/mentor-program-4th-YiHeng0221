<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Heng's Blog</title>
  <link rel="stylesheet" href="style.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<body>
  <nav class="navbar">
    
    <div class="nav-right">
      <a href="blog.php" class="nav_title">Heng's Blog</a>
      <a href="sheet.php" class="nav_btn">文章列表</a>
      <a href="classify.php" class="nav_btn">分類專區</a>
      <a href="aboutMe.php" class="nav_btn">關於我</a>
    </div>
      
    
  </nav>
  <div class="banner">
    <h1>技術存放之地</h1>
    <p>Welcome to my blog</p>
  </div>
  <main class="wrap">
    <div class="article_body">
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
  <footer class="footer">
    Copyright © 2020 Heng's Blog All Rights Reserved.
  </footer>
</body>
</html>

