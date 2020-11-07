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
  }

  $stmtForClassify = $conn->prepare('select * from YiHeng_blog_classify');
  $resultForClassify = $stmtForClassify->execute();
  if(!$resultForClassify){
    die('error:' . $conn->error);
  }

  $resultForClassify = $stmtForClassify->get_result();

?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Heng's Blog 新增文章</title>
  <link rel="stylesheet" href="style.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
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
    <h1>新增文章</h1>
    <p>Welcome to my blog</p>
  </div>
  <main class="wrap">
    <div class="article_body">
      <form method="POST" action="handle_add_article.php">
        <div class="add_article">
          <input type="title" name="article_title" />

          <div class="classify_select">
            <select name="classify">
              <?php while($rowForClassify = $resultForClassify->fetch_array()) {
                if($rowForClassify['is_deleted'] === null) { ?>
              <option value="<?php echo $rowForClassify['article_classify_id']; ?>"><?php echo $rowForClassify['classify_name']; ?></option>
              <?php } }?>
            </select>
          </div>
        
          <textarea class="textareaWithCKEditor" name="article_content" rows="5"></textarea>
          <script>
            ClassicEditor
              .create( document.querySelector( '.textareaWithCKEditor') )
              .catch( error => {
                console.error( error );
            } );
          </script>
        </div>
        <input type="submit" class="btn">
      </form>
    </div>
    
   

  </main>
  <footer class="footer">
    Copyright © 2020 Heng's Blog All Rights Reserved.
  </footer>
  
</body>

</html>


