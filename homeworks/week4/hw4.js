const request = require('request');

request({
  url: 'https://api.twitch.tv/kraken/games/top',
  headers: {
    Accept: 'application/vnd.twitchtv.v5+json',
    'Client-ID': 'at57m34jpwez76jgyry1gbu1eactof',
  },
},

(error, response, body) => {
  if (error) {
    return console.log('Failed to catch!', error);
  }
  if (!error && response.statusCode === 200) {
    const info = JSON.parse(body);
    for (let i = 0; i < info.top.length; i += 1) {
      console.log(`${info.top[i].viewers} ${info.top[i].game.name}`);
    }
  }
});
