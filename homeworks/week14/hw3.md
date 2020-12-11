## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？

DNS(Domain Name System)，也就是網域名稱系統，網路上所有的電腦，包含手機、電腦一直到提供內容的伺服器，都是用 IP 位址來互相通訊，為了讓使用者更方便地記憶這些有意義的名稱並進入這些網站，只要輸入「網址」也就是域名來取代 IP 網址，就可以進入該網站，而 DNS 就是一套來進行 IP 位址與域名之間轉換的系統。

Google 提供公開的 DNS 也就是 Google Public DNS，是 Google 於 2009 年末提供的域名解析服務，其 IPv4 位址為 8.8.8.8 及 8.8.4.4；IPv6 位址為2001:4860:4860::8888 及 2001:4860:4860::8844。

對 Google 來說，身為搜尋引擎，只要有越多人使用這個 DNS 服務，就能收集到用戶的網路足跡，像是哪些網站常被造訪等等，再加上搜尋引擎的資料，可以整合出使用者的行為模式，當收集的資料量越大，競爭力就越大。
對於用戶，因為 Google 有相較於其他 DNS 提供商較完善的資料，因此使用速度上也會比較快，而 Ｇoogle 因規模較大，在世界上也許多的伺服器，因此比較穩定；Google 也表示他們特別重視處理域名服務的安全問題，因此也比較少遇上某些惡意 DNS 提供商所實施的域名劫持情形。


## 什麼是資料庫的 lock？為什麼我們需要 lock？
lock 是用來協調多個 transaction 一起訪問同一個資料的機制。
當沒有 lock 時，多個同時進行的 transactions 可能會造成資料錯誤，就以購票系統為例，若只剩一張票，而同時有三個人購買，在沒有 lock 的情況下就會造成超賣的情形。

lock 的可以以使用方式以及數據粒度來分類：
使用方式可分為 exclusive lock、sharing lock。
以數據粒度可分為 Table-level lock、Page-level lock、Key-level lock、Row-level lock。

mysql 中的 lock 語法
```sql
$conn->autocommit(FALSE);
$conn->begin_transaction();
$conn->query("SELECT amount from products where id = 1 for update");
$conn->commit();
```
## NoSQL 跟 SQL 的差別在哪裡？

SQL 是一種用於管理關連式資料庫管理系統的程式語言，透過這個程式語言，將資料儲存在已經設定好的資料表架構中（Schema），並對其進行資料流的處理。而當資料量大、型態多的時候，在架構上的設計與變更會很困難。

而 NoSQL 為 Not Only SQL，主流是以 key-value 的方式來儲存資料，每筆資料間沒有關聯性，可以認已調整或分割，可以用來儲存結構不固定的資料，而且不支援 JOIN。在效能上及擴佔性上都優於 RDBMS，但安全性與正確性較 RDBMS，結構也較鬆散。


## 資料庫的 ACID 是什麼？

是資料庫在進行交易（transaction）操作時，為了保證交易正確所必需符合的幾個特性：

Atomicity （原子性，亦為不可分割性）：確保所有修改都被執行，或是都不被執行。

Consistency （一致性）：交易前後的資料狀態不能破壞程式或資料庫的各項約束。

Isolation （隔離性）：交易操作時將資料「隔離」來起，讓該交易不被其它操作影響，也就是 lock 需要被應用的地方。

Durability （持久性），交易完成後，不論成功與否，其結果都會被寫入資料庫中，並且保證之後還能夠被存取。