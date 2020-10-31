<!-- soft delete version -->

<?php
session_start();
require_once('conn.php');
require_once('utils.php');

$username = $_SESSION['username'];
$role = $_GET['role'];
$id = $_GET['id'];

if(empty($role)) {
  header("Location: admin.php");
  die($conn->error);
}


$sql = "update YiHeng_board_users set role =? where id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $role, $id);

$result = $stmt->execute();
if(!$result){
  die($conn->error);	
}
header("Location: admin.php");

?>
