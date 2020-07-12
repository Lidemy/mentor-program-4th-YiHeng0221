const request = require('request');

request(
  `https://restcountries.eu/rest/v2/name/${process.argv[2]}`,
  (error, response, body) => {
    const country = JSON.parse(body);
    if (country.status === 404) {
      return console.log('找不到國家資訊');
    }
    for (let i = 0; i < country.length; i += 1) {
      console.log(
        `============
國家：${country[i].name} 
首都：${country[i].capital}
貨幣：${country[i].currencies[0].code}
國碼：${country[i].callingCodes[0]}`,
      );
    }
  },
);
