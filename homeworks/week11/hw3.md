## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
加密是由明文改變成密文，且可利用解密來將密文還原為明文。

而加密主要分為兩種形式，分為對稱加密以及非對稱加密，在對稱加密（Symmetric-key algorithm）中加密和解密的金鑰是相同的，而非對稱加密（Asymmetric cryptography），又稱公開金鑰密碼學（Public-key cryptography）需要兩個金鑰，一個是公開密鑰，另一個是私有密鑰；公鑰用作加密，私鑰則用作解密。

但有些資料是不應該被還原的，因此需要使用雜湊（Hashing algorithms），將其變為資料指紋（data fingerprint），此值將無法逆推回原本的明文。因此當資料庫被竊取時，竊取者也無法使用解密的方式來還原出密碼。

## `include`、`require`、`include_once`、`require_once` 的差別

include 與 require 都是將指定的檔案讀入並且執行裡面的程式，而 require 因為只處理一次程式碼，通常是放在最前面，在執行程式前就先導入需要 require 的程式碼，而 include 通常放在程式碼中，執行程式中遇到時才會執行。
兩者錯誤處理的方式也不同，require 導入的程式碼有錯誤時，整個程式會中斷，並回報一個 fatal error；而 include 則會繼續執行程式，並回報一個 warning。

有 once 與沒有 once 的差別在於有 once 的會先檢查要匯入的檔案在其他地方是否已經匯入過了，如果有的話就不會再次重複匯入該檔案。


## 請說明 SQL Injection 的攻擊原理以及防範方法

攻擊者會透過輸入來修改語法邏輯或加入特殊指令，可以來對資料庫進行增刪查改甚至更多的動作，例如在一個未作保護的登入頁面輸入當帳號輸入 `' OR ''=''#` 或是`' OR ''=''-- `，就可以進行非法登入，因為以以下 SQL 語法來看
`select * from members where account='$name' and password='$password'`

就會變成`select * from members where account='' or 1=1 #' and password=''`
，account欄位部分就會變成判斷式`account='' or 1=1`而 `1=1` 為真，後面的密碼則被注釋掉了，因此就可以非法登入。


##  請說明 XSS 的攻擊原理以及防範方法


XSS 全稱為 Cross-Site Scripting，中文為跨網站指令碼攻擊。
利用網頁開發的漏洞，將惡意程式碼注入網頁中，讓使用者在載入網頁時執行攻擊者所注入的程式碼。可能導致受到釣魚攻擊、網頁置換、Cookie 資料被竊取或 Session 劫持（通過獲取使用者 Session ID 後，使用該 Session ID 登入目標帳號的攻擊方法）
 XSS 攻擊大致上分為以下三種：
* Stored XSS (儲存型)
即表示會被儲存在資料庫中的惡意代碼，在留言板、論壇等使用者可以輸入內容的地方常見，若沒有確實的做 escape ，使用者只要在內容輸入如 `<script>` 等關鍵字就會被當成正常的 HTML 執行，而 `<script>`內的程式碼也會被執行。
* Reflected XSS (反射型)
最常見的就是以 GET 方法傳送資料給 Server 端時，Server 端未檢查就直接將內容回應到網頁上。如在網址上的 GET 參數，也就是 ? 後面修改成 `?name=<script>alert('hacked')</script>` 就會直接跳出 alert 視窗並顯示 hacked。
* DOM-Based XSS (基於 DOM 的類型)
攻擊者讓用戶打開包含惡意代碼的 URL，用戶端接受到 response 後執行，JavaScript 取出 URL 中的惡意代碼並執行之，跟前面兩者 XSS 不同處在於 DOM 型 XSS 為前端的安全漏洞，而其他兩者都是屬於 Server 端的安全漏洞。

防範方法 參考 [Web Security - A7 . Cross-Site Scripting (XSS) - 下篇](https://ithelp.ithome.com.tw/articles/10220667)
* 跳脫字元，將使用者輸入的內容先執行跳脫在儲存。
```JavaScript
function escape(str)
{
    str = str.replace(/</g, "&lt");
    str = str.replace(/>/g, "&gt");

    return str;
}
```
* 過濾特殊字元

> PHP：htmlentities()、htmlspecialchars()
> Python：cgi.escape()
> ASP：Server.HTMLEncode()
> ASP.NET：Server.HtmlEncode()、Microsoft Anti-Cross Site Scripting Library

* 使用HTTP頭指定類型

使輸出的內容避免被作為HTML解析，即可強行指定輸出內容為文字

```
<?php
   header('Content-Type: text');
?>
```


## 請說明 CSRF 的攻擊原理以及防範方法

Cross-site request forgery (CSRF)，中文稱為跨網站請求偽造攻擊，會讓受害者在非自願的狀況下發出請求，通常與 XSS 一樣是以社交工程傳送惡意網址、網站來誘使受害者點擊或瀏覽，範例如下：
```htmlmixed=
<form method="$method" action="$url">
     <input type="hidden" name="$param1name" value="$param1value">
</form>
<script>
      document.forms[0].submit();
</script>
```

先設定一個包含攻擊者目的的表單標籤並隱藏之，再使用 JavaScript 去 submit 該表單，使用者就會在不知情的狀況下送出該請求。

防範方法：
1. 使用者於每次使用完網站就登出。
2. 要於後端驗證 Referer 請求來自的位置是否合法。但有些瀏覽器不會帶 referer、也有些使用者會將帶 referer 這個功能關閉。
3. 使用圖形驗證碼、簡訊驗證碼等，只是在使用者體驗上可能會變差。
4. 加上 CSRF token，隨機產生 CSRF token 並存在 server 的 session，送出請求之後，server 端會檢查 CSRF token 是否相同，攻擊者無法預測 CSRF token 因此無法攻擊。但當server 支持 cross origin 的 request，這個方法就不成立，攻擊者可以在自己的頁面發出 request 並得到該 CSRF token。
