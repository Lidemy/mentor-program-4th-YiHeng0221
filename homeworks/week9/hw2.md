## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼

text 不可以有默認值，而 varchar 可以，因此在知道資料長度的狀況下，可以使用 varchar 來節省儲存空間。

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？

因為 HTTP 協議是無狀態性 (stateless) 的，因此瀏覽器上每個頁面都是沒有關聯的，每個 Request 都是單獨的，因此伺服器將 Cookie 存在瀏覽器上，用以辨識這些請求是不是同一個人發出來的。

而 Server 會在要回傳給瀏覽器的 Response 上加入一個 Cookie 的 Header ，要求瀏覽器來儲存 Cookie，因此之後只要 Cookie 沒有過期，瀏覽器端就可以將相對應的 Cookie 放進 Header 中，讓伺服器端了解這些 Request 是否是有關聯的。

以 PHP 使用 set-cookie 這個指令來設定 cookie：

```php
  $expire = time() + 3600 * 24 * 30; // 30 days
  setcookie("token", $token, $expire);
  /*
    setcookie(name(必須), value(必須), expire(選填), path(選填), domain(選填), secure(選填));
  */
  header("Location: index.php");
} else {
  header("Location: login.php?errCode=2");
}
// 要回傳（response）的 header，用來跳轉頁面
```

可使用`$_COOKIE['參數']` 來抓取資料：

```php
  $username = NULL;

  if(!empty($_COOKIE['token'])) {
    $user = getUserFromToken($_COOKIE['token']);
    $username = $user['username'];
  }
```


清空 Cookie 的方式就是將時間設定為過期時間：

```php
setcookie("token", "", time() - 3600);
```


## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？

1. 密碼是以明文傳遞，只要駭進資料庫，會員資料就全部都被知道了。-> 使用雜湊或加密
2. cookie 是以 userid 或 username 來儲存，而瀏覽器端可以擅自改 cookie，因此會產生身份偽造的情形。-> session 機制或產生隨機的 token
3. SQL injection 及 XSS：因為沒有將使用者輸入的文字進行「跳脫(escape)」，因此只要使用者輸入一些如`<script>alert('attack!');</script>`、`"), ("allen", (select password from users limit 1)) #`之類的，就會被當作程式碼的一部份而執行。

