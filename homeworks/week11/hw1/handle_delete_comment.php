<!-- soft delete version -->

<?php
session_start();
require_once('conn.php');
require_once('utils.php');

$username = $_SESSION['username'];
$comment_id = $_GET['comment_id'];

if(empty($comment_id)) {
  header("Location: index.php");
  die($conn->error);
}

if (isAdmin($username)) {
  $sql = "update YiHeng_board_comments set is_deleted = 1 where comment_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $comment_id);
} else {
  $sql = "update YiHeng_board_comments set is_deleted = 1 where comment_id=? and username =?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('is', $comment_id, $username);
}

$result = $stmt->execute();
if(!$result){
  die($conn->error);	
}
header("Location: index.php");

?>
