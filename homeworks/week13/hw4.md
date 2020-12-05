## Webpack 是做什麼用的？可以不用它嗎？

依照 Webpack 的文件敘述：
> webpack is a **static module bundler for modern JavaScript applications**. When webpack processes your application, it internally builds a dependency graph which maps every module your project needs and generates one or more bundles.

Webpack 是一個**現代 JavaScript 的靜態模組打包工具**，打包時會將每個模組之間建立關聯，因此在開發時可以進行模組化，也就是一個大的功能細分成許多小的單元，當確保每個單元可以獨立運作時，進行 debug 時較不會互相影響，管理上較方便而且在其他的系統需要用到該模組時也可直接使用。
當在引用多個 library 時，因其各有自己的全域變數，可能會產生命名衝突。而 webpack 進行「打包」時可以避免這個情形的產生。
但假設這次要開發的專案規模小，不會引用到多個 Library ，也不需要進行模組化的開發，就不需要使用到 webpack，當然在大型的專案中也可不用 webpack，但在使用後會方便很多。



## gulp 跟 webpack 有什麼不一樣？

依照 gulp 首頁的介紹來看：
> **A toolkit to automate & enhance your workflow**
> Leverage gulp and the flexibility of JavaScript to automate slow, repetitive workflows and compose them into efficient build pipelines.

gulp 主要功能是要讓許多重複性的任務自動化，以提升效率，例如像是 SCSS 轉換成 CSS 的編譯、進行 ES6 與 ES5 的轉換、uglify 與 minify 、壓縮圖片等等。

gulp 定位比較偏向任務管理，可以使用在更多元的地方，而 webpack 主要是將所有模組進行打包並進行預處理，因此定位不同。


## CSS Selector 權重的計算方式為何？

先簡單提一下 CSS Selector 權重：
> !important > inline style > ID > Class > Element > *
簡而言之，越精確的 Selector 權重越高。而還有其他像是 psuedo-class 與 attribute 權重與 Class 相同。
權重最高的為 !important，可以蓋過其他所有的 Selector，如果想要覆蓋原本的 css 又不直接改原本的檔案時，後來寫的 css 也必須加上 !important。
而權重的計算方式以以下程式碼來看：
```htmlmixed=
<style>
  * {
    color: black
  }

  div > span {
    color: grey;
  }

  .number {
    color: green;
  }
  
  *{
    color: orange !important;
  }
</style>
<body>
  <div class="nums">
    <span class="number" style="color:red">123<span>
  </div>
</body>
```
\* 有一個，得一分；Element 中使用到 div 與 span 得兩分；class 有一個得一分； inline css 也是一個，得一分，!important 也是一個。
依照 !important > inline style > ID > Class > Element > * 的順序來評分為：1-1-1-2-1，但因為 css 計算權重時大小僅僅在同一個種類中有效，也不會有什麼進位之類的東西，因此雖然橘色位於 \* 為最小，但因為他後面加上了一個 !important，因此最終會顯示為橘色。假設拿掉了 !important 與 inline css 好了，class 雖然分數低於 element，但因為以權重高的優先，因此還是以 class 中的 style 為主。
 
