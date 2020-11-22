<?php
  require_once('conn.php');
    // 引入連線檔
  header('Content-type:application/json;charset=utf-8');
    // 若要輸出 JSON 的資料要加此 header
  header('Access-Control-Allow-Origin: *');
    // 同源政策


  // 檢查是否有輸入值，無則報錯
  if (
    empty($_POST['comment_content']) || 
    empty($_POST['username']) || 
    empty($_POST['site_key'])
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please input missing fields",
    );
    $response = json_encode($json);
    echo $response;
    die(); 
  }

  // 取輸入值
  $username = $_POST['username'];
  $site_key = $_POST['site_key'];
  $content = $_POST['comment_content'];

  // prepare SQL 語法
  $sql = "insert into YiHeng_board_discussions(site_key, username, comment_content) values(?, ?, ?)";

  // 合併SQL語句與輸入值並執行
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss',$site_key, $username, $content);
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

  // execute 成功訊息
  $json = array(
    "ok" => true,
    "message" => "success"
  );
  $response = json_encode($json);
  echo $response;
?>