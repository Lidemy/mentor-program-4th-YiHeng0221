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
}

$article_id = $_GET['article_id'];

$stmt = $conn->prepare('select * from YiHeng_blog_articles left join YiHeng_blog_classify on YiHeng_blog_articles.article_classify_id = YiHeng_blog_classify.article_classify_id where YiHeng_blog_articles.article_id = ?');
$stmt->bind_param('i', $article_id);
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
  <title>Heng's Blog</title>
  <link rel="stylesheet" href="style.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<body>

  <!-- navbar -->
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

  <!-- banner -->
  <div class="banner">
    <h1>技術存放之地</h1>
    <p>Welcome to my blog</p>
  </div>

  
  <!-- article -->
  <main class="wrap">
  <?php while($row = $result->fetch_array()) {
    if($row['is_deleted'] === NULL) { ?>
      <div class="article_body">

        <!-- title -->
        <h3 class="article_title"><?php echo escape($row['article_title']); ?></h3>
        <?php if($username){?>

          <!-- editor -->
          <div class="article_editor">
            <a href="edit_article.php?article_id=<?php echo $row['article_id'] ?>" class="article_edit"><i class="fas fa-edit"></i></a>
            <a class="article_remove" onclick="return confirm('確定要刪除此文章嗎')" href="handle_delete_article.php?article_id=<?php echo $row['article_id'] ?>"><i class="fas fa-trash"></i></a>
          </div>
        <?php } ?>

        <!-- classify -->
        <div class="article_info">
          <a class="article_info-timeStamp"><i class="fas fa-clock"></i> <?php echo escape($row['created_at']); ?> </a>
          <a class="article_info-classify"><i class="fas fa-folder-open"></i> <?php echo escape($row['classify_name']); ?></a>
        </div>

        <!-- content -->
        <div class="article_content">
          <p><?php echo $row['article_content']; ?></p>
        </div>
      </div>
    <?php } 
  } ?>
  </main>

  <!-- footer -->
  <footer class="footer">
  	Copyright © 2020 Heng's Blog All Rights Reserved.
  </footer>
</body>
</html>
