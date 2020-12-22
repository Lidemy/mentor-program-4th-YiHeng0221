## 請說明以下程式碼會輸出什麼，以及盡可能詳細地解釋原因。
```javascript
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello() // ??  2
obj2.hello() // ??  2
hello() // ??  undefined
```

分別會輸出：
```
2
2
undefined
```

### Step 1
我們可以看到這個 main() 建立 global EC 後有三個宣告值並賦值的地方：
```javascript
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
const obj2 = obj.inner
const hello = obj.inner.hello
```

### Step 2
接下來執行 `obj.inner.hello()`，很直觀的可以去看 `obj` 這個物件，首先存取了 `inner`，再呼叫 `hello()` 這個 function，而因為是由 `obj.inner` 來呼叫 `hello()` 的，因此裡面的 this 即是 `obj.inner` ，其 value 為 2，故列出 2

### Step 3
我們可以看到呼叫 `hello()` 的是 `obj2`，而 `obj2` 是誰？是  `obj.inner`，因此等同於是由 `obj.inner` 來呼叫 `hello()` 的，因此裡面的 this 即是 `obj.inner` ，其 value 為 2，故列出 2。

### Step 4
我們先往 `const hello = obj.inner.hello` 這行來看，這個 hello 只是指向 `obj.inner.hello` 的位置，並不是呼叫這個 function，等於我們是直接在全域的環境下呼叫 `hello()`，所以這裡的 this 為預設值，而也根本沒有 value 這東西，所以會印出 undefined，而若是在嚴格模式 `'use strict';` 下則會輸出`Cannot read property 'value' of undefined`