<?php
session_start();
require_once('conn.php');
require_once('utils.php');

$comment = $_POST['comment_content'];
$username = $_SESSION['username'];
$comment_id = $_POST['comment_id'];

if(empty($comment)) {
  header("Location: update_comment.php?errCode=1&comment_id=" . $comment_id);
  die($conn->error);
}
print_r($comment);

$sql = "update YiHeng_board_comments set comment_content=? where comment_id=? and username =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sis', $comment, $comment_id, $username);
$result = $stmt->execute();
if(!$result){
  die($conn->error);	
}
header("Location: index.php");

?>