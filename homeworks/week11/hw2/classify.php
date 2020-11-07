<?php 
session_start();

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

$stmt = $conn->prepare('select * from YiHeng_blog_classify ORDER BY article_classify_id DESC limit ? offset ?');
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
  <title>Heng's Blog 分類專區</title>
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
      
    <div class="nav-left">
      <?php if(!$username){ ?>
        <a href="login.php" class="nav_btn left_btn"><i class="fas fa-user" ><p>登入</p></i></a>
      <?php }else{ ?>
        <a href="add_article.php" class="nav_btn left_btn"><i class="fas fa-plus"><p>新增</p></i></a>
        <a href="admin.php" class="nav_btn left_btn"><i class="fas fa-wrench"><p>管理</p></i></a>
        <a href="logout.php" class="nav_btn left_btn"><i class="fas fa-user" ><p>登出</p></i></a>
      <?php } ?>
    </div>
    
  </nav>
  <div class="banner">
    <h1>分類專區</h1>
    <p>Welcome to my blog</p>
  </div>
  <main class="wrap">

    <?php while($row = $result->fetch_assoc()) {?>
        <div class="article_body">
          <div class="article_classify"><i class="fas fa-folder-open"></i> <?php echo escape($row['classify_name']); ?></div>
        </div>
      <?php } ?>

   

  </main>
  <footer class="footer">
  	Copyright © 2020 Heng's Blog All Rights Reserved.
  </footer>
</body>
</html>
