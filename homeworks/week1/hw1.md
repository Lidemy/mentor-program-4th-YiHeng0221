## 交作業流程

### 設定專案寫作業

1. 看完第一週課程
2. 點擊進入[GitHuba classroom](https://classroom.github.com/a/SbDvk2VA)
3. 點擊 accept this assignment
4. 進入 lidemy/mentor-program-4th-<Your_GitHub_id>
5. 點擊 clone or download 複製網址
6. 進入 Terminal 輸入 git clone 並貼上該網址
7. 跑完之後就可以 cd 進入mentor-program-4th-<Your_GitHub_id> 的master
8. 打開 mentor-program-4th-<Your_GitHub_id>/ homework/ week(n)的資料夾
9. **輸入`git branch week(n)`新增分支並 `git checkout week(n)`切換到該分支**
10. **點開hw(n)開始寫作業**

### 寫完作業交作業

1. 輸入`git status`確定自己在week(n)分支上，並會看到有尚未暫存以備提交的變更 修改：homeworks/week(n)/hw(n).md
2. **輸入`git add homeworks/week(n)/hw(n).md`，若有很多檔案可以輸入`git add .`**
3. 若 add 之後想要取消可輸入`$git checkout homeworks/week(n)/hw(n).md`，在尚未 commit 的狀況下把檔案恢復成原本的樣子
4. **再輸入`$ git commit` 新建版本，存檔留底**
5. 步驟 2, 4 可用直接輸入 `git commit -am <更新訊息>` 取代 #ClayGau助教大大提醒：當新增一個檔案，沒有先用`git add`的狀況下輸入`git commit -am <更新訊息>`不會起作用！
6. 若發現錯誤想要取消 commit 可以輸入`git reset HEAD^ --hard`直接通通不要，用`git reset HEAD^ --soft` (default) 剛剛 commit 的檔案還會在。
7. **commit 完成後輸入  `git push origin week(n)`上傳到 GitHub**
10. **進入 lidemy/mentor-program-4th-<Your_GitHub_id> 點擊 pull request**
11. 點擊 compare & pull request，發出想要將 week(n)分支 merge 進 master
12. 可以在下面 Write 留言想問ㄉ問題
13. compare & pull request 若沒有出現可以輸入 new pull request，將 branch 選成自己要的再點擊 Creat pull request
14. 進入 https://learning.lidemy.com/ 的作業列表
15. **點擊新增作業，選擇作業當週並輸入 pull request 連結**
16. 確認檢查過作業以及自我檢討修正錯誤。
17. 助教收到 pull request 並改完之後會 merge week(n) 到 master
18. **回到 terminal 輸入 `git checkout master` 再輸入`git pull origin master`以更新本地端的 master**
19. **輸入 `git branch -d week(n)` 就口以把該分支刪除掉ㄌ**
