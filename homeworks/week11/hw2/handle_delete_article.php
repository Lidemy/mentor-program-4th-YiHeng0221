<!-- soft delete version -->

<?php
session_start();
require_once('conn.php');
require_once('utils.php');

$username = $_SESSION['username'];
$article_id = $_GET['article_id'];

if(empty($article_id)) {
  header("Location: blog.php");
  die($conn->error);
} 

  $sql = "update YiHeng_blog_articles set is_deleted = 1 where article_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $article_id);


$result = $stmt->execute();
if(!$result){
  die($conn->error);	
}
header("Location: blog.php");

?>
