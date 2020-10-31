<!-- soft delete version -->

<?php
session_start();
require_once('conn.php');
require_once('utils.php');

$username = $_SESSION['username'];
$id = $_GET['id'];

if(empty($id)) {
  header("Location: admin.php");
  die($conn->error);
}

$sql = "update YiHeng_board_users left join YiHeng_board_comments on YiHeng_board_users.username = YiHeng_board_comments.username set YiHeng_board_users.is_deleted = 1, YiHeng_board_comments.is_deleted = 1 where YiHeng_board_users.id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$result = $stmt->execute();
if(!$result){
  die($conn->error);	
}
header("Location: admin.php");

?>


