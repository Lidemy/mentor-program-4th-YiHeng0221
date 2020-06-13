## 跟你朋友介紹 Git

## Git

參考資料：
[Git](https://git-scm.com)
[第一週版本控制與 Git 基本指令 - Miahsu - Medium](https://medium.com/@miahsuwork/%E7%AC%AC%E4%B8%80%E9%80%B1-%E7%89%88%E6%9C%AC%E6%8E%A7%E5%88%B6%E8%88%87-git-%E5%9F%BA%E6%9C%AC%E6%8C%87%E4%BB%A4-fa3c4ba286a2)
[第二週Git 進階使用 Branch、Merge - Miahsu - Medium](https://medium.com/@miahsuwork/%E7%AC%AC%E4%BA%8C%E9%80%B1-git-%E9%80%B2%E9%9A%8E%E4%BD%BF%E7%94%A8-branch-merge-a571cc0a95de)
[GIT101 Git 超新手入門 | Lidemy 鋰學院](https://lidemy.com/courses/enrolled/379441)


Git 是免費開源的::分散式版本控制系統::

### 版本控制

**一個人的版本控制：**
像是在檔案名稱上寫上XX版的報告

**多人協作的版本控制：**

**中央式**系統版本控制
主要在一個伺服器上進行，由中央管理權限進行「上鎖」，一次只能讓一個開發者進行工作。（例如： [Subversion](https://zh.wikipedia.org/wiki/Subversion) 、 [CVS](https://zh.wikipedia.org/wiki/%E5%8D%94%E4%BD%9C%E7%89%88%E6%9C%AC%E7%B3%BB%E7%B5%B1)  等）
每個人都可以一定程度的知道專案中的其他人正在做些什麼。 管理員也可以輕鬆掌控每個開發者的權限；而且比每個用戶端只用本機的版本控制系統好管理很多。
但缺點是當中央伺服器如果發生故障的時候。 如果當機一小時，那麼這個小時之中，沒有人可以提交更新，也就無法協同合作。


**分散式**系統版本控制（Distributed Version Control Systems，簡稱 DVCSs）
讓開發者在沒有網路的情況下也能進行工作，也讓開發者有充分
的控制能力，不需經過中央許可，並且也向中央式系統一樣有上鎖的能力，因此相較來說彈性更大。（例如： [Git](https://git-scm.com/) 、 [BitKeeper](https://blog.techbridge.cc/2018/01/17/learning-programming-and-coding-with-python-git-and-github-tutorial/BitKeeper) 、 [mercurial](https://zh.wikipedia.org/zh-tw/Mercurial)  等）
假設有任何一個協同合作的伺服器故障，事後都可以用任何一個用戶端的鏡像來還原。 因為每個地方都有完整的資料備份。


## Mac 系統如何安裝 Git

* 第一種方式
[Git](https://git-scm.com) 打開此網站點擊下載並安裝
* 第二種方式
1. 於命令提示字元輸入：
`$ /bin/bash -c “$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)”`

2. 安裝 Homebrew 完畢後於命令提示字元輸入：
`$ brew install git`

3. 確認是否安裝成功可於命令提示字元輸入：
`$ git —version`
然後會顯示當前版本，代表安裝成功

4. 設定你的帳戶，讓 Git 知道這台電腦做的修改要連結到 Github 哪一個使用者：
`$ git config —global user.name “<Your Name>`
設定信箱：
`$ git config —global user.email "<your@gmail.com>"`
檢查現在的使用者：
`$ git config --list`


## Git 基本操作

1. 於自己設定的資料夾新增一個git_test的資料夾
`mkdir git_test`

2. 輸入指令讓 git 對此資料夾進行版本控制
`cd git_test`
`git init`
進行版本控制後，Git 會在這個資料夾內新增隱藏的資料夾 .git 裡面包含了系統檔。

3. 查看狀態
`git status`

4. 把檔案交給 Git
`git add 檔案名稱`
輸入後可以使用`git status`查看當前狀態，可看到被分成有版控與沒有版控的兩區塊，皆有提示如何取消與加入。

* 如果資料夾內有很多檔案，可以使用` $ git add . `，就可以把當前路徑的檔案全部加入版控
* 若想要將目錄底下的全部加入，可以使用 $ git —all

5. 假如要取消版，控在該資料夾筆下開終端機 輸入 ：
`rm --rf .git`
就會將版本控制的檔案清除，這樣就回到最原始的乾淨的資料夾。

6. `$ git rm --cached welcome.html`
讓檔案不再受 git 版控

7. `$ git mv` 變更檔名

8. `$ git checkout` 可以藉由輸入::版本號::切換到任何 commit 過的版本
`$ git check master`切換到最新版本

9. `$ git diff` 比對工作目錄與尚未進暫存區(unstaged)全部檔案的差異。

10. `$ git commit` 新建版本，存檔留底
把放在 Staging Area 的檔案放到 Repository中
[image:8B1DE751-C35F-48C6-A138-18FA12429A5D-481-00004238DF3D9E53/git-workflow.png]

11. `$ git log` 檢視 commit 紀錄，版本號都是使用 SHA-1（Secure Hash Algorithm 1）的演算法計算的結果，像是 commit 的身份證字號。
` $ git log —-oneline`：輸出更簡潔的 logo

>  [情況1] 檢視特定檔案的 commit
> `$ git log 檔案名稱` 如果想要看詳細的修改內容 可再加上 -p
> 舉例：
> `$ git log hello.html/`
> 
> [情況2] 我想要找某個人的 commit
> `—-author`
> 舉例：
> `$ git log —-oneline —-author=”Mia” `
> 補充：若想要找兩人以上：
> `$ git log —-oneline —-author=”Mia\|Ben”`
> 
>  [情況3] 我想要找 commint 訊息裡包含「woo」的字串
> `—-grep`
> 舉例：
> `$ git log —-oneline —grep=”woo”` 
> 
> [情況4] 我想要找到 commint 檔案裡包含「jQuery」的字串
> -S 舉例：
> `$ git log -S “jQuery”`
>  
> [情況5] 主管想看我今天做了什麼事情
> `—since`、`—until`
> 舉例：
> `$ git log —oneline —since=”9am” —until=”6pm”`


12. `$ touch .gitignore` `$ vim .gitignore`輸入要忽略的檔案，要記得把 .gitignore 加入版控中。

13. `$ git diff`在加到暫存區前可看修改了什麼。

14. 當commit 之後發現commit message打錯了，輸入`$ git commit --amend`會跳進 vim 編輯器，可以做修改。

15. 移除上一個 commit ，可以輸入`$ git reset HEAD^ --hard`直接通通不要，用`$ git reset HEAD^ --soft` (default) 剛剛 commit 的檔案還會在

16. `$git checkout --檔案名稱`，在尚未 commit 的狀況下把檔案恢復成原本的樣子


## Git branch 

 1. `$ git branch`
在哪個 branch

2. `$ git branch name`
新增分支

3. `$ git branch -v`
看有哪些branch 
 `$ git branch -v 原名稱 新名稱`
 `$ git branch -m 新名稱`（位於該 branch
更改分支名稱

4. `$ git branch -d name`
刪除 branch

5. `$ git checkout name`
切換到該分支（可遠端

6. `$ git merge 名稱`
把該分支合併進來現在所在的分支，更新的分支為現在所在的分支，合併進來就可以將該分支刪除。


## Conflic 衝突

在 Merge 的時候，假如同一份檔案有兩個人去做修改，內容有一或多個不同，而內容修改這個東西因為並不是說先搶先贏可以以時間來做判斷，所以 Git 在這種情形發生的時候會請你手動修改，以留下你要的東西。

* Pull 下來之後會出現 Conflict 的錯誤訊息，要手動修改

*  輸入 `$ git status`後也會出現哪裡未合併。

* 修改之後輸入 `$ git add 檔案名稱`再 Commit ，就可以解決衝突然後 Push 上去了 。


