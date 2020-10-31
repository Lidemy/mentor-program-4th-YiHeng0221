<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if(empty($_POST['article_title']) || empty($_POST['article_content'])) {
  	header("Location: add_article.php?errCode=1");
  	die('請輸入資料');
  }

  $user = getUserFromUsername($_SESSION['username']);
  $id = $user['user_id'];
  $title = $_POST['article_title'];
  $content = $_POST['article_content'];
  $classify_id = $_POST['classify'];
  // 防範 SQL injection 的方式

  $sql = "insert into YiHeng_blog_articles(user_id, article_title, article_content, article_classify_id) value(?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  /* 
    創造一個prepared的聲明(prepared statement)
    並且說明哪些是placeholder，會在之後的地方才放入。
    ? 及在變數前面加上冒號都可以當作是 placeholder
  */
  $stmt->bind_param('issi', $id, $title, $content, $classify_id);
  //  綁定參數，綁定在一個變數，這個變裡的值可以變。
  //  第一個參數為資料型態，如字串就為 s 。

  $result = $stmt->execute();
  // 執行，execute() 中不用帶入參數。

  if(!$result){
  	die($conn->error);
  	// 如果 $result 中沒東西就報錯
  }

  header("Location: blog.php");
  // 要回傳（response）的 header，用來跳轉頁面



?>