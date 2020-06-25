``` js
function isValid(arr) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] <= 0) return 'invalid'
  }
  for(var i=2; i<arr.length; i++) {
    if (arr[i] !== arr[i-1] + arr[i-2]) return 'invalid'
  }
  return 'valid'
}

isValid([3, 5, 8, 13, 22, 35])
```

## 執行流程
1. 讀取 isValid 函式內的輸入[3, 5, 8, 13, 22, 35]。
2. 進入以下迴圈
```javascript
for(var i=0; i<arr.length; i++) {
    if (arr[i] <= 0) return 'invalid'
  } 
```
3. 進入第一圈迴圈：設定 i 值為 0，檢查 i 值是否小於 arr.length，是，判斷 arr[i] 是否小於等於 0，arr[i] 為 3，結束判斷，進入下一個迴圈。
4. 進入第二圈迴圈：i++，i 值為 1，檢查 i 值是否小於 arr.length，是，判斷 arr[i] 是否小於等於 0，arr[i] 為 5，結束判斷，進入下一個迴圈。
5. 進入第三圈迴圈：i++，i 值為 2，檢查 i 值是否小於 arr.length，是，判斷 arr[i] 是否小於等於 0，arr[i] 為 8，結束判斷，進入下一個迴圈。
6. 進入第四圈迴圈：i++，i 值為 3，檢查 i 值是否小於 arr.length，是，判斷 arr[i] 是否小於等於 0，arr[i] 為 13，結束判斷，進入下一個迴圈。
7. 進入第五圈迴圈：i++，i 值為 4，檢查 i 值是否小於 arr.length，是，判斷 arr[i] 是否小於等於 0，arr[i] 為 22，結束判斷，進入下一個迴圈。
8. 進入第六圈迴圈：i++，i 值為 5，檢查 i 值是否小於 arr.length，是，判斷 arr[i] 是否小於等於 0，arr[i] 為 35，結束判斷，進入下一個迴圈。
9. 進入第七圈迴圈：i++，i 值為 5，檢查 i 值是否小於 arr.length，否，結束此迴圈。
10. 進入以下迴圈
```javascript
for(var i=2; i<arr.length; i++) {
    if (arr[i] !== arr[i-1] + arr[i-2]) return 'invalid'
  }
```
11. 進入第一圈迴圈：設定 i 值為 2，檢查 i 值是否小於 arr.length，是，判斷 arr[i] 是否不等於 arr[i-1] + arr[i-2]，arr[i] 為 8，arr[i-1] 為 5， arr[i-2] 為 3，等於，結束判斷，進入下一個迴圈。
12. 進入第一圈迴圈：i++，i 值為 3，檢查 i 值是否小於 arr.length，是，判斷 arr[i] 是否不等於 arr[i-1] + arr[i-2]，arr[i] 為 13，arr[i-1] 為 8， arr[i-2] 為 5，等於，結束判斷，進入下一個迴圈。
13. 進入第一圈迴圈：i++，i 值為 4，檢查 i 值是否小於 arr.length，是，判斷 arr[i] 是否不等於 arr[i-1] + arr[i-2]，arr[i] 為 22，arr[i-1] 為 13， arr[i-2] 為 8，步等於，回傳 ‘invalid’，結束此迴圈。
14. 執行完畢。
