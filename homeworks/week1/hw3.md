## 教你朋友 CLI

Command line ，中文為命令行或命令行介面，為一個純文字的應用程式，用以處理、查看電腦中的檔案，平常我們使用的圖形使用者介面（Graphical User Interface，GUI），也是由command line 構成。
基本的指令有：
* ls （list）：
列出所有檔案及路徑。
* pwd （print working directory）：
顯示目前路徑。
* cd（change directory）：
切換目錄。
`＄ cd 子目錄`
* mkdir（make directory）：
新建資料夾。`＄ mkdir 資料夾名稱`
* rm（remove）：
直接刪除檔案。
* mv（move）：
移動檔案或更改檔名。
`$ mv 檔案名稱 /絕對路徑`
`$ mv 原檔名 新檔名`
* touch：
碰一下檔案，該檔案的修改日期會更新，而假若未有此檔案則進行新增。`$ touch 檔名`
* cp（copy）：
複製檔案。`$ cp 原檔名 複製檔名`
* echo：
印出字串在 Terminal 面板。
* cat（catenate）：
將膽案內容顯示在 Terminal 面板。
* less：
將檔案內容以分頁方式顯示於 Terminal 面板。
* grep：
抓取特定關鍵字。`$ grep 字串 檔名`
* man（manual）：
查看指令用法說明書。
* date
列印現在時間。
* ｜（pipe）：
串接指令`$ 指令 | 指令 `或把前者輸出變成後者輸入。
`$ cat 檔案名稱 ｜ 指令`
* > （redirect）：
重新導向。`$ date > time.txt`會將日期輸入至 time.txt 檔案中。

而 h0w 哥想用 command line 建立一個叫做 wifi 的資料夾，並且在裡面建立一個叫 afu.js 的檔案，首先打開電腦尋找 Terminal 應用程式，打開後使用 `$ cd`移動到自己想要建立資料夾的地方，使用 `$ mkdir  wifi`建立叫作 wifi 的資料夾並`$ cd wifi`進入資料夾，再使用`$ touch afu.js`來建立叫作 afu.js 的檔案，若要確定是否成功建立檔案可使用於 wifi 目錄內鍵入 `$ ls`指令，若有成功就會在命令提示字元介面上顯示。

步驟：
1. 打開電腦尋找 Terminal 應用程式
2. 使用 `$ cd`移動到自己想要建立資料夾的目錄
3. 使用 `$ mkdir  wifi`建立叫作 wifi 的資料夾
4. `$ cd wifi`進入資料夾
5. 使用`$ touch afu.js`來建立叫作 afu.js 的檔案。

