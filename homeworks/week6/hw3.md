## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
<textarea> 可輸入文字區域，
<hr> 加入分隔線

<dl>清單 Definition List
 <dt>項目 Definition Term
  <dd>描述 Definition Description
使用 <dl> 宣告一個清單，並將 <dl> 中包裹 <dt> 及 <dd> 用來製作出一個完整的清單組，而且可以呈現每個項目的標題及描述，會呈現縮排的效果。


## 請問什麼是盒模型（box modal）
box model 用於 CSS 中，是將每個 html 元素都以一個盒子（box）視之，再針對這個區塊去做調整，用以定義這個區塊的位置及大小，使排版能夠更加精確，也便於跟設計師作溝通。而在 box model 出現之前，大多設計區塊大小都還是要計算，而現在使用box model 中由外到內依序是 margin 、 border 、 padding 、 content，可以使用 box-sizing 這個 CSS 元素，來確保區塊大小定義起來比較直覺。


## 請問 display: inline, block 跟 inline-block 的差別是什麼？
inline：將元素們以同一行來呈現，而這些元素都不會換行。其寬高由內容長度來決定寬高，無法自行調整，而當內容過長時，可以搭配 overflow 來做出變化。

block：將元素們各自以區塊來呈現，與 inline 相反，會自動換行。如 <div> 就是默認以區塊方式來呈現，可使用 width 與 height 來調整寬高。

inline-block：綜合以上兩種，將區塊水平排列，但也可以使用 width 與 height 來調整寬高。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

static 是由瀏覽器預設來自動排版在頁面上。

relaive 基本上是與 static 相同，但加上 top 、 right 、 bottom 、 left 等等屬性之後會呈現相對於原本預設的位置，而且不會影響到其他元素的位置，如本週 hw1 中「吃過都說好」部分中，頭像留言區塊的關係。

absolute 是將元素定位於所屬區塊內的某個固定位置，但若所屬區塊是 static 的話，則會跳過在往上一層參考。

fixed 是會將元素固定在瀏覽器「視窗」的某個位置，設定之後不論頁面如何捲動，該元素就會固定在那個位置出現，還蠻常出現在某些網頁的廣告。