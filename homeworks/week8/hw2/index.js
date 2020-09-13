const errorMessage = '系統不穩定，請再試一次';
const request = new XMLHttpRequest();
const apiSourse = 'https://api.twitch.tv/kraken/';
const navbarList = document.querySelector('.navbar__list');
request.open('GET', `${apiSourse}games/top?limit=5`, true);
request.setRequestHeader('Client-ID', 'at57m34jpwez76jgyry1gbu1eactof');
request.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');

request.onload = () => {
// onload :當request 送出，透過網際網路連到伺服器，
// 成功取回資料就會觸發 load 事件，
// 當事件完成(request 拿到結果)就會觸發在裡面的 callback function
// 也就是幫 onlaod 上 EventListener
  if (request.status >= 200 && request.status < 400) {
  // 判斷 request 是否成功
    const top5 = JSON.parse(request.responseText).top;
    for (let i = 0; i < top5.length; i += 1) {
      const element = document.createElement('li');
      element.innerHTML = `<a>${top5[i].game.name}</a>`;
      navbarList.appendChild(element);
    }
    // 利用 responseText 拿到 response 的內容

    const requestStream = new XMLHttpRequest();
    // 每送一個請求就要多 new 一個 request
    document.querySelector('h1').innerText = top5[0].game.name;
    requestStream.open('GET', `${apiSourse}streams?game=${encodeURIComponent(top5[0].game.name)}&limit=20`, true);
    requestStream.setRequestHeader('Client-ID', 'at57m34jpwez76jgyry1gbu1eactof');
    requestStream.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');

    requestStream.onload = () => {
      if (requestStream.status >= 200 && requestStream.status < 400) {
      // 判斷 request 是否成功
        const streamContents = JSON.parse(requestStream.responseText).streams;
        const streams = document.querySelector('.streams');
        for (const content of streamContents) {
          const element = document.createElement('div');
          streams.appendChild(element);
          element.outerHTML =
            `<div class="gameThumbnail" onclick="window.open('${content.channel.url}', '_blank')">
              <img src="${content.preview.large}g">
              <div class="thumbnail__Desc">
                <div class="thumbnail__Avatar">
                  <img src="${content.channel.logo}">
                </div>
                <div class="thumbnail__Info">
                <div class="thumbnail__Title">
                  ${content.channel.status}
                  </div>
                  <div class="thumbnail__Streamer">
                    ${content.channel.name}
                  </div>
                </div>
              </div>
            </div>`;
        }
        if (streams.childElementCount % 3 === 2) {
          const element = document.createElement('div');
          streams.appendChild(element);
          element.outerHTML = '<div class="emptyCard"></div>';
        } else if (streams.childElementCount % 3 === 1) {
          const element = document.createElement('div');
          streams.appendChild(element);
          element.outerHTML =
          `<div class="emptyCard"></div>
          <div class="emptyCard"></div>`;
        }
      }
    };
    requestStream.send();

    navbarList.addEventListener('click', (e) => {
      const gameName = e.target.innerText;
      document.querySelector('h1').innerText = gameName;
      // 更改 h1 標題
      document.querySelector('.streams').innerText = '';
      // 清空內容
      const requestStream = new XMLHttpRequest();
      // 每送一個請求就要多 new 一個 request
      requestStream.open('GET', `${apiSourse}streams?game=${encodeURIComponent(gameName)}&limit=20`, true);
      requestStream.setRequestHeader('Client-ID', 'at57m34jpwez76jgyry1gbu1eactof');
      requestStream.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');

      requestStream.onload = () => {
        if (requestStream.status >= 200 && requestStream.status < 400) {
        // 判斷 request 是否成功
          const streamContents = JSON.parse(requestStream.responseText).streams;
          const streams = document.querySelector('.streams');
          for (const content of streamContents) {
            const element = document.createElement('div');
            streams.appendChild(element);
            element.outerHTML =
              `<div class="gameThumbnail" onclick="window.open('${content.channel.url}', '_blank')">
                <img src="${content.preview.large}g">
                <div class="thumbnail__Desc">
                  <div class="thumbnail__Avatar">
                    <img src="${content.channel.logo}">
                  </div>
                  <div class="thumbnail__Info">
                    <div class="thumbnail__Title">
                      ${content.channel.status}
                    </div>
                    <div class="thumbnail__Streamer">
                      ${content.channel.name}
                    </div>
                  </div>
                </div>
              </div>`;
          }
          if (streams.childElementCount % 3 === 2) {
            const element = document.createElement('div');
            streams.appendChild(element);
            element.outerHTML = '<div class="emptyCard"></div>';
          } else if (streams.childElementCount % 3 === 1) {
            const element = document.createElement('div');
            streams.appendChild(element);
            element.outerHTML =
            `<div class="emptyCard"></div>
            <div class="emptyCard"></div>`;
          }
        }
      };
      requestStream.send();
    });
  } else {
    console.log(errorMessage);
  }
};
request.send();
request.onerror = () => {
  console.log(errorMessage);
};
