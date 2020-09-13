const changeBg = document.querySelector('.banner');
const btn = document.querySelector('.act-btn');
const errorMessage = '系統不穩定，請再試一次';

btn.addEventListener('click', (e) => {
// set an event listener on btn
  getLottery(e.target);
});

function getLottery() {
  const request = new XMLHttpRequest();
  const apiSourse = 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery';
  request.open('GET', apiSourse, true);
  request.send();

  request.onerror = () => {
    alert(errorMessage);
  };

  request.onload = () => {
    if (request.status >= 200 && request.status < 400) {
      console.log(JSON.parse(request.responseText));
      const apiRes = JSON.parse(request.responseText);

      if (!apiRes.prize) {
        alert(errorMessage);
      } else {
        getNewBg(apiRes.prize);
      }
    } else {
      alert(errorMessage);
    }
  };
}

function getNewBg(prize) {
  const prizes = {
    FIRST: {
      className: 'first',
      title: '恭喜你中頭獎了！日本東京來回雙人遊！',
    },
    SECOND: {
      className: 'second',
      title: '二獎！90 吋電視一台！',
    },
    THIRD: {
      className: 'third',
      title: '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！',
    },
    NONE: {
      className: 'none',
      title: '銘謝惠顧',
    },
  }
  const { className, title } = prizes[prize];
  changeBg.classList.add(`${className}`);
  changeBg.innerHTML =
  `<div class="getLottery">
    <h2>
    ${title}
    </h2>
    <button class="act-btn" onclick="javascript:window.location.reload()">我要抽獎</button>
  </div>`;
}
