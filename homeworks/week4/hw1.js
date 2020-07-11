const request = require('request');

request(
  'https://lidemy-book-store.herokuapp.com/books?_limit=10',
  (error, response, body) => {
    if (error) {
      return console.log('抓取失敗', error);
    }
    const books = JSON.parse(body);
    for (let i = 0; i < books.length; i += 1) {
      console.log(`${books[i].id} ${books[i].name}`);
    }
  },
);

// 抓取 n 本書

// const request = require('request');
// const process = require('process');

//   request(
//     'https://lidemy-book-store.herokuapp.com/books?_limit=' + process.argv [2],
//     function (error, response, body) {
//       let books = JSON.parse(body)
//       for (let i = 0; i < books.length; i += 1) {
//         console.log(books[i].id +' '+ books[i].name);
//       }
//     }
//   );
