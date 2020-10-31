<?php
session_start();
require_once('conn.php');
require_once('utils.php');

//錯誤處理
if(empty($_POST['username']) || empty($_POST['password'])) {
  header("Location: login.php?errCode=1");
  die($conn->error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select * from YiHeng_board_users where username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$result = $stmt->execute();

if(!$result){
  die($conn->error);
}

$result = $stmt->get_result();
// 用get_result 來將結果取回，並存回 $result
if($result->num_rows === 0) {
  header("Location: login.php?errCode=2");
  exit();
}

$row = $result->fetch_assoc();
if(password_verify($password, $row['password'])){
  $_SESSION['username'] = $username;
  header("Location: index.php");
} else {
  header("Location: login.php?errCode=2");
}
?>