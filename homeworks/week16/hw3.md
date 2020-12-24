```javascript
var a = 1
function fn(){
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2(){
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)
```

## step 1:
建立 global EC 及其 VO 並初始化
```javascript
globalEC: {
  globalVO: {
    fn: function,
    a: undefined,
  }
}
```

## Step 2:
global 賦值 a = 1
```javascript
globalEC: {
  globalVO: {
    fn: function,
    a: 1,
  }
}
```

## Step 3:
建立 fnEC 及其 AO 並初始化，依照 stack LIFO 特性疊在 Global 上。
hoisting a 為 undefined。
執行 fn() 中程式碼 console.log(a) 為 undefined。
```javascript
fnEC: {
  fnAO: {
    fn2: function,
    a: undefined,
  }
}
globalEC: {
  globalVO: {
    fn: function,
    a: 1,
  }
}
```

## Step 4:
賦值 a = 5，執行第二個 console.log(a) 為 5
```javascript
fnEC: {
  fnAO: {
    fn2: function,
    a: 5,
  }
}
globalEC: {
  globalVO: {
    fn: function,
    a: 1,
  }
}
```

## Step 5:
a++ 為 6、宣告 a 可忽略。建立  fn2EC 及其 AO，未有宣告變數，AO 為空。
執行 fn2 中的 console.log(a)，因 fn2 AO 為空，沿著作用域鏈找到上層之 fnEC 的 a 為 6。
```javascript
fn2EC: {
  fn2AO: {
  }
}
fnEC: {
  fnAO: {
    fn2: function,
    a: 6,
  }
}
globalEC: {
  globalVO: {
    fn: function,
    a: 1,
  }
}
```

## Step 6:
fn2() 中賦值 a = 20、b = 100。
因 fn2 AO 為空，沿著作用域鏈找到上層之 fnEC 的 a 與賦值；
因作用域鏈中未宣告 b，於 global 宣告並賦值。
```javascript
fn2AO: {
  fn2VO: {
  }
}
fnEC: {
  fnAO: {
    fn2: function,
    a: 20,
  }
}
globalEC: {
  globalVO: {
    fn: function,
    a: 1,
    b: 100,
  }
}
```

## Step 7:
fn2 執行完畢，移出 stack，執行第九行之 console.log(a)，印出 20。
```javascript
fnEC: {
  fnAO: {
    fn2: function,
    a: 20,
  }
}
globalEC: {
  globalVO: {
    fn: function,
    a: 1,
    b: 100,
  }
}
```

## Step 8:
fn 執行完畢，移出 stack，執行 17 行 console.log(a)，取 globalVO 中 a 值，印出 1。
```javascript
globalEC: {
  globalVO: {
    fn: function,
    a: 1,
    b: 100,
  }
}
```

## Step 9:
賦值 a = 10
```javascript
globalEC: {
  globalVO: {
    fn: function,
    a: 10,
    b: 100,
  }
}
```

## Step 10:
執行 19 行 console.log(a) 及 20 行 console.log(b)，取 globalVO 之值，分別印出 10 與 100。

## Step 11:
程式執行結束，移出 stack。