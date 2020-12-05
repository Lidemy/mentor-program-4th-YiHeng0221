import $ from 'jquery';
import { apiSourse, ReqTemp, navbarList } from './variables';

export function fetchStreams(elem, temp) {
  $('h1').text(elem);
  // 更改 h1 標題
  $('.streams').text('');
  // 清空內容
  const url = `${apiSourse}streams?game=${encodeURIComponent(elem)}&limit=20`;
  fetch(url, temp).then((res) => {
    res.text().then((json) => {
      const streamContents = JSON.parse(json).streams;
      for (const content of streamContents) {
        const thumbTemp = `
      <div class="gameThumbnail" onclick="window.open('${content.channel.url}', '_blank')">
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
        $('.streams').append(thumbTemp);
      }
      if ($('.streams').length % 3 === 2) {
        $('.streams').append('<div class="emptyCard"></div>');
      } else if ($('.streams').length % 3 === 1) {
        $('.streams').append(`<div class="emptyCard"></div>
        <div class="emptyCard"></div>`);
      }
    });
  });
}

export function fetchTop5ForNav(url, temp) {
  fetch(url, temp).then((res) => {
    res.text().then((json) => {
      const top5 = JSON.parse(json).top;
      for (let i = 0; i < top5.length; i += 1) {
        const element = `<li>${top5[i].game.name}</li>`;
        navbarList.append(element);
      }
      fetchStreams(top5[0].game.name, temp);
    });
  });
}

export function clickListener() {
  $(navbarList).on('click', (e) => {
    const gameName = e.target.innerText;
    fetchStreams(gameName, ReqTemp);
  });
}
