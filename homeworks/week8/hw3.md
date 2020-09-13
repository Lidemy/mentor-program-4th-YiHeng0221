## 什麼是 Ajax？

因為使用 form 就會刷新頁面，但當有時候只是從 Server 拿取資料只需要部分畫面改變，而我們使用 JavaScript 來傳送資料，就可以解決換頁問題，這類的方式統稱為：
> Asynchronous JavaScript and XML(AJAX)

XMLHttpRequest 是一個傳統的 AJAX 應用，以下利用其來做 AJAX 的範例
```htmlmixed=
<html>
  <head>
  	<meta charset="utf-8" />
  	<meta name="viewport" content="width-device-width, initial-scale=1" />
    <title>AJAX</title>
  </head>
  <body>
    <script>
      // AJAX
      const request = new XMLHttpRequest() 
      // 瀏覽器提供的一個 class ，用 new 產生
      request.onload = function() { 
      // onload :當request 送出，透過網際網路連到伺服器，
      // 成功取回資料就會觸發 load 事件，
      // 當事件完成(request 拿到結果)就會觸發在裡面的 callback function
      // 
      // 也就是幫 onlaod 上 EventListener
        if (request.status >= 200 && request.status < 400)
        // 判斷 request 是否成功
        {
          console.log(request.responseText)
          // 利用 responseText 拿到 response 的內容
        }else {
          console.log('err')
        }
      }
      request.onerror = function() {
        console.log('error')
      }
      request.open('GET', 'https://reqres.in/api/users', true) 
      // 發 request 到網址，第三個參數是選擇是否非同步
      request.send();
    </script>
  </body>
</html>
```

## 用 Ajax 與我們用表單送出資料的差別在哪？

一樣是透過瀏覽器發送 request 給 server，而與表單的差別是表單方式中 server 傳送 response 給瀏覽器之後，瀏覽器會再重新渲染成新的頁面；AJAX 方式則是將 response 透過瀏覽器轉傳給 JavaScript 來達成動態更動介面及內容，不需要再重新讀取整個網頁。


## JSONP 是什麼？

JSONP也就是 JSON with padding
因為有些標籤不受同源政策影響，例如`<img>`, `<script>`，這兩者的 src 因為較沒有安全性問題，所以可以不用受同源政策管理，而JSONP就是利用這些不受同源政策管理的標籤來取資料。
假設我們引入"https://test.com/user.js"
`<script src="https://test.com/user.js"></script>`
這個 user.js 回傳的內容是一個 function setData()，而這個 function 中夾帶要回傳的資料：
```htmlmixed=
setData([
  {
    id:1,
    name: 'hello'
  }, {
    id:2,
    name: 'hey'
  }
])
```
在這之前我們就可以先設定
```htmlmixed=
<script>
  function setData(users) {
    console.log(users) 
    // 或是任何對資料執行的動作
  }
</script>
```
進而存取到 “https://test.com/user.js” 中 setData 的資料。
也可以使用動態的方式來存取：
```htmlmixed=
<script src="https://test.com/user.js">
  const request = new XMLHTTPRequest()
  const element = document.createElement('script')
  element.src = 'https://test.com/user.js?id=1'
</script>
```

## 要如何存取跨網域的 API？

因為CORS （跨來源資料共用）這個規範的緣故，當你想要跨來源存取時，對方 response header 中必須有 ‘Access-Control-Allow-Origin’。例如 `https://reqres.in/api/users` 中的 response header 裡 Access-Control-Allow-Origin 這個 header 內容為 `*`，也就是全部的origin都可以來存取。
所以當 server 的 response header 中沒有加上 Access-Control-Allow-Origin 的話，只要是非同源，不論怎麼樣都沒辦法繞過它來取得 response。
另外也可以使用某些不受同源政策影響的標籤來存取資料，也就是上一題提到的JSONP


## 為什麼我們在第四週時沒碰到跨網域的問題，這週（觀看 JS102 影片的時候）卻碰到了？

因為瀏覽器主要為了安全性而有 CORS 與 Same origin policy 的限制，比如說這樣就不能隨意讀取其他 server 的檔案。
但 CORS 與 Same origin policy 因為僅適用於瀏覽器，所以脫離瀏覽器，就沒有這些限制。
