<?php
session_start();
require_once('conn.php');
require_once('utils.php');

//錯誤處理


$nickname = trim($_POST['nickname']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if(empty($nickname) || empty($username) || empty($password)) {
  header("Location: register.php?errCode=1");
  die($conn->error);
}

$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

$sql = "insert into YiHeng_board_users(nickname, username, password) value(?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $nickname, $username, $password);
$result = $stmt->execute();

if(!$result){
  die($conn->error);
  if($code === 1062) {
    header("Location: register.php?errCode=1062");
    // 若出現「#1062 Duplicate entry 'XXX' for key 'X'」代表是某個欄位設定為「Primary」或「Unique」的值有重複。
  }
  die($conn->error);
}
$_SESSION['username'] = $username;
header("Location: index.php");

?>