# Hw4:*簡答題*

##1 什麼是 DOM？

在JavaScript 與瀏覽器的溝通上，有一個重要的角色叫做 DOM。
文件物件模型（Document Object Model, DOM）簡單來說，就是把「Document」轉換成「Object」的東西。

Document 即是在 html 中寫下的，當把這個結構各個拆解，如下圖，就會很像一個「Object」，用 JavaScript 針對每個節點去做改變，而瀏覽器會依照所寫下 JavaScript 的去直接改變所呈現的模樣。

![取自維基百科](https://i.imgur.com/R3ubxco.png)

##2 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？

事件傳遞依序定義為三個階段:

* Capture phase(捕獲階段)
由 DOM Tree 的根節點依序向內傳遞，過程中觸發各別元素的捕獲階段事件監聽。
* Target phase(目標階段)
到達事件目標（Event Target），依照註冊順序觸發事件監聽。
* Bubbling phase(冒泡階段)
由事件目標依序向外傳遞，過程中觸發各別元素的冒泡階段事件監聽。

特別要注意的是在 Target phase(目標階段)，如以下的程式碼所示， false 在 true 之前，console 出來 bubbling 會先出現，因為在將事件 console.log 出來的時候會發現是依照註冊順序觸發事件監聽，但其實在目標階段並沒有分是冒泡還是捕獲。

```javascript
function addEvent(className) {
  document.querySelector(className)
  .addEventListener('click', function() {
  console.log(className, '冒泡')
  }, false)
}
function addEvent(className) {
  document.querySelector(className)
  .addEventListener('click', function() {
  console.log(className, '捕獲')
  }, true)
}
```

##3 什麼是 event delegation，為什麼我們需要它？

當新增的按鈕數量越來越龐大，這個迴圈就要幫每個按鈕都新增一個監聽器，而且 callback function 的內容都很相近，那不是非常的沒有效率？啊如果我們是要用 appendChild 之類的動態新增元素，要怎麼加上 eventListener？

這時就可以回到事件傳遞機制的部分，回去看看捕獲與冒泡機制，只要 button 被使用者觸發事件，都會逐層傳遞到最上層的 outer，那我們就直接將監聽器綁定在 outer 就好了，這樣也不用擔心之後新增的子元素沒辦法觸發，因為都在 outer 裡面囉。

這種方式就是 event delegation （事件代理）。

##4 event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

### preventDefault

preventDefault 按字面上來說就是阻止（瀏覽器的）預設行為，以超連結為例：
```htmlmixed=
<a href="/test">link</a>
<script>
  const element = document.querySelector('a')
  element.addEventListener('click', function(e){
  // 替超連結加上 click 的 event listener
  e.preventDefault()
  // 阻止超連結點擊後的預設行為，也就是連到某個地方
  })

</script>
```
常見的範例就是表單的送出以及超連結，以上面程式碼為例，執行 preventDefault 之後，點擊 a 就不再進行導向頁面的動作。


### stopPropagation

冒泡機制其實有點像是逐級回報，從子元素一直往上層回報至根元素，但若當你不想要一直逐級回報上去，可使用 stopPropagation。
```htmlmixed=
<div>
  <div>
    <button class='btn'>
    clickme
    </button>
  </div>
</div>

<script>
document.querySelector('.btn')
  .addEventListener('click', function(e) {
  e.stopPropagation();  // 阻止事件繼續傳遞
  console.log('.btn 冒泡');
  }, )}
</script>

```

如此一來，事件就會只綁定在目標（target）`'.btn'`上，用來阻止目標冒泡事件，當點擊`'.btn'` 時，就不會發生上層`div` 們的預設事件。