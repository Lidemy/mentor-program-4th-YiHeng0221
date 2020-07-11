## 請以自己的話解釋 API 是什麼

API 是 Application Programming Interface 的縮寫，
是一個用來交換資料的介面，可以使用者可以藉由這個介面來讀取、新增、更新、刪除資料。
以老師上課舉的 USB 隨身碟來當概念，USB本身是屬於一個連接電腦系統與外部裝置已進行輸入輸出的介面，而一樣，使用者也可以藉由這個介面來讀取、新增、更新、刪除資料。
API 是以抽象的方式來定義一個介面，並不涉及實作，代表著應用程式之間的橋樑。
以實際生活來舉一個例子，顧客在菜單上選好餐點，呼叫服務生來點餐，服務生再將顧客的需求傳至廚房，當煮好之後再送回來給顧客，這裡的服務生就是 API 的概念，而一樣的，顧客也不需要知道服務生本人學歷怎麼樣、生活經驗怎麼樣甚至是由什麼組成的，就像使用 API 時不需要知道內部程式運作的邏輯或演算法。
再來以 skyscanner 這個 application 來舉例，他串接了許多航空公司的 API，當你輸入了你要去哪個國家時，他會以 API 向各家航空公司索取航班資訊再回傳給你。

## 請找出三個課程沒教的 HTTP status code 並簡單介紹

504 Getway time-out
網頁請求超時，當瀏覽網站時所發出的請求未反應的時候會出現

451 Unavailable For Legal Reasons
用戶端請求違法的資源，例如受政府審查的網頁。當使用者請求存取某個經政府審核等查核方法後認定不合法的來源時，就會顯示這個錯誤代碼。

405 Method Not Allowed
伺服器理解此請求方法，但它被禁用或不可用。例如該網站伺服器設定為不可讓 client 端修改的，使用 put 或 delete 時就會顯示此錯誤訊息，又或者是沒有使用者輸入的靜態網頁，使用 POST 就會出現此錯誤。

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

Base URL: <平台網址>
回傳所有餐廳資料：
  Method: GET
  Path: /restaurant
  Request: <平台網址>/restaurant
回傳單一餐廳資料：
  Method: GET
  Path: /restaurant/:id
  Request: <平台網址>/restaurant/3
刪除餐廳：
  Method: DELETE
  Path: /restaurant/:id
  Request: <平台網址>/restaurant/3
新增餐廳：
  Method: POST
  Path: /restaurant
  Parameter: name=餐廳名稱
更改餐廳：
  Method: PATCH
  Path: /restaurant/:id
  Parameter: name=餐廳名稱
