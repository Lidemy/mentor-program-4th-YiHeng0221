<?php
session_start();
require_once('conn.php');
require_once('utils.php');

//錯誤處理


$nickname = trim($_POST['nickname']);
$username = $_SESSION['username'];

if(empty($nickname)) {
  header("Location: updateNickname.php?errCode=1");
  die($conn->error);
} else if(strlen($nickname) > 64) {
  header("Location: updateNickname.php?errCode=2");
}

$sql = "update YiHeng_board_users set nickname=? where username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $nickname, $username);
$result = $stmt->execute();

if(!$result){
  $code = $conn->errno;
  if($code === 1062) {
    header("Location: updateNickname.php?errCode=1062");
    // 若出現「#1062 Duplicate entry 'XXX' for key 'X'」代表是某個欄位設定為「Primary」或「Unique」的值有重複。
  }
  die($conn->error);
}
$_SESSION['username'] = $username;
header("Location: index.php");

?>