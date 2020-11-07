<?php
session_start();
require_once('conn.php');
require_once('utils.php');

$username = $_SESSION['username'];
$article_id = $_POST['article_id'];


$title = $_POST['article_title'];
$classify_id = $_POST['classify'];
$editArticle = $_POST['article_content'];


if(empty($editArticle)) {
  header("Location: update_comment.php?errCode=1&article_id=" . $article_id);
  die($conn->error);
}

$sql = "update YiHeng_blog_articles 
    left join YiHeng_blog_users 
    on YiHeng_blog_articles.user_id = YiHeng_blog_users.user_id 
    set YiHeng_blog_articles.article_title=?, YiHeng_blog_articles.article_classify_id=?, 
        YiHeng_blog_articles.article_content=?
    where YiHeng_blog_articles.article_id=? 
    and YiHeng_blog_users.username =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sisis', $title, $classify_id, $editArticle, $article_id, $username);
$result = $stmt->execute();
if(!$result){
  die($conn->error);	
}
header("Location: blog.php");

?>