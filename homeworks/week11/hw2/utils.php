<?php
// random function
require_once("conn.php");

function getUserFromUsername($username) {
  global $conn; //要使用到全域變數時需要先用 global 宣告
 
  $sql = "select * from YiHeng_blog_users where username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  return $row;  //內容會有 username, id, nickname
}

function escape($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}

function isAdmin($username) {
  $user = getUserFromUsername($username);
  if($user['role'] == 'admin') {
    return true;
  } else {
  	return false;
  }
}
function isBanned($username) {
  $user = getUserFromUsername($username);
  if($user['role'] == 'banned') {
    return true;
  } else {
  	return false;
  }
}

?>
