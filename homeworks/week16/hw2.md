```javascript
for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}
```
輸出：
```
i: 0
i: 1
i: 2
i: 3
i: 4
5
5
5
5
5
```

1. 產生 global execution context，尋找變數與函式並丟入 Variable Object 中
```javascript
Global EC = {
    VO: {
        i: undefined
    },
}
```
2. 將主函式 main() 丟入 call stack 中
3. 進入 for 迴圈，i 為 0、i 小於 5 且每圈迴圈完成後 i + 1。進入第一圈迴圈。
```javascript
Global EC = {
    VO: {
        i: 0,
    },
}
```
4. 將`console.log('i: ' + i)` 放入 call stack 並執行，於作用域鏈上找 i 值，i 為 0，輸出，`console.log('i: ' + i)`，移出 call stack。
5. setTimeout() 進入堆疊並執行，呼叫 web APIs 0 秒後執行 `() => {console.log(i)}`，setTimeout() 執行結束，移出 call stack。
6. 倒數計時結束，第一個`() => {console.log(i)}`一到 call queue 等待執行。
7. 回到迴圈第一行，進行 i++，global EC 中的 i 重新賦值為 1 且仍小於 5。進入第二圈迴圈。
```javascript
Global EC = {
    VO: {
        i: 1,
    },
}
```
8. 將`console.log('i: ' + i)` 放入 call stack 並執行，於作用域鏈上找 i 值，i 為 1，輸出，`console.log('i: ' + i)`，移出 call stack。
9. setTimeout() 進入堆疊並執行，呼叫 web APIs 1 秒後執行 `() => {console.log(i)}`，setTimeout() 執行結束，移出 call stack。
10. `() => {console.log(i)}`等待倒數計時，計時玩將會到 call queue 中等待。
11. 重複進行步驟 7, 8, 9, 10 直到 i 為 5，迴圈檢查 i < 5 不成立，跳出迴圈。此時已經輸出 0, 1, 2, 3, 4，每個被呼叫的 setTimeout() 分別是 0, 1, 2, 3, 4 秒。
12. 跳出迴圈後主函式 main() 已執行完畢，移出 call stack。
13. event loop 偵測到 call stack 已空，開始呼叫 call queue 上排隊的`() => {console.log(i)}`們。
14. 第一個`() => {console.log(i)}`的 timer 為 0 秒，因此一計時完就來到了 call queue，而 main() 離開 call stack 之後，他就會被拉進 call stack。
15. 建立 `() => {console.log(i)}` 的執行環境（EC），並初始化 Activation Object，簡稱 AO，開始沿著作用域鏈尋找有沒有 i，而 `() => {console.log(i)}` 的 AO 中並沒有 i，因此向上尋找到 Global EC 的 VO， i 值為 5，輸出 5。
16. `() => {console.log(i)}` 執行完畢，離開 call stack。
17. 剩下於 Web API 的 `() => {console.log(i)}` 們倒數計時完畢之後就會被移到 call queue，並在 event loop 偵測到 call stack 沒東西時被依序（FIFO）抓進 call stack 並依照步驟 15、16 執行，並離開，直到最後一個 `() => {console.log(i)}`完成。