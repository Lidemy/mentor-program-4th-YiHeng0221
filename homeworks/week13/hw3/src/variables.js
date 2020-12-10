import $ from 'jquery';

export const navbarList = $('.navbar__list');
export const apiSourse = 'https://api.twitch.tv/kraken/';
export const ReqTemp = {
  method: 'GET',
  headers: new Headers({
    'Client-ID': 'at57m34jpwez76jgyry1gbu1eactof',
    'Accept': 'application/vnd.twitchtv.v5+json',
    'Content-Type': 'application/json',
  }),
};
