<?php
  require_once('conn.php');
  // 引入連線檔
  header('Content-type:application/json;charset=utf-8');
  // 若要輸出 JSON 的資料要加此 header
  header('Access-Control-Allow-Origin: *');
  // 同源政策

  // 檢查是否有 site_key，無則報錯
  if (
    empty($_GET['site_key'])
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please add site_key in url",
    );
    $response = json_encode($json);
    echo $response;
    die(); 
  }

  // 取 site_key
  $site_key = $_GET['site_key'];
 
  
  // prepare SQL 語法 
  $sql = "select * from YiHeng_board_discussions where site_key = ?" .(empty($_GET['before'])? "" : "and id < ?") . " order by comment_id desc";

  // 合併SQL語句與 site_key 並執行
  $stmt = $conn->prepare($sql);
  if(empty($_GET['before'])){
    $stmt->bind_param('s', $site_key);
  } else {
    $stmt->bind_param('si', $site_key, $_GET['before']) ;
  }
  
  $result = $stmt->execute();

  // execute 錯誤訊息
  if(!$result) {
    $json = array(
      "ok" => false,
      "message" => $conn->error
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  // 成功後則把資料取回
  $result = $stmt->get_result();
  
  // 將資料以陣列型態儲存
  $comments = array();
  while($row = $result->fetch_assoc()) {
    array_push($comments, array(
      "id" => $row["comment_id"],
      "username" => $row["username"],
      "comment_content" => $row["comment_content"],
      "created_at" => $row["created_at"]
    ));
  }

  // execute 成功訊息
  $json = array(
    "ok" => true,
    "comments" => $comments
  );
  $response = json_encode($json);
  echo $response;

?>