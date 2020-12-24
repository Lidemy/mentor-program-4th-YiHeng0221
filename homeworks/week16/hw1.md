```javascript
  console.log(1)
  setTimeout(() => {
    console.log(2)
  }, 0)
  console.log(3)
  setTimeout(() => {
    console.log(4)
  }, 0)
  console.log(5)
```
會列出1, 3, 5, 2, 4


1. 將 `console.log(1)` 放入 call stack
2. 執行 `console.log(1)`，印出 1，執行完畢，移出 call stack
3. 將第一個 `setTimeout()` 放入 call stack 中
4. 執行 `setTimeout()`，瀏覽器設定一個定時器，定時 0 秒，執行完畢，移出 call stack
5. 計時完畢，將 callback `() => {console.log(2)}` 放入 call queue
6. 將 `console.log(3)` 放入 call stack
7. 執行 `console.log(3)`，印出 3，執行完畢，移出 call stack
8. 將第二個 `setTimeout()` 放入 call stack 中
9. 執行 `setTimeout()`，瀏覽器設定一個定時器，定時 0 秒，執行完畢，移出 call stack
10. 計時完畢，將 callback ``() => {console.log(4)}`` 放入 call queue
11. 將 `console.log(5)` 放入 call stack
12. 執行 `console.log(5)`，印出 5，執行完畢，移出 call stack
13. 將 call queue callback 的程式放入 call stack
14. 執行 `console.log(2)`，印出 2，執行完畢，移出 call stack
15. 執行 `console.log(4)`，印出 4，執行完畢，移出 call stack