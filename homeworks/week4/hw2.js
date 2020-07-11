const request = require('request');
const process = require('process');

function list() {
  request(
    'https://lidemy-book-store.herokuapp.com/books?_limit=20',
    (error, response, body) => {
      if (error) {
        return console.log('Failed to catch!', error);
      }
      // 錯誤處理
      const books = JSON.parse(body);
      for (let i = 0; i < books.length; i += 1) {
        return console.log(`${books[i].id} ${books[i].name}`);
      }
    },
  );
}

function read(id) {
  request(
    `https://lidemy-book-store.herokuapp.com/books/${id}`,
    (error, response, body) => {
      if (error) {
        return console.log('Failed to catch!', error);
      }
      const books = JSON.parse(body);
      return console.log(books);
    },
  );
}

function deleteBook(id) {
  request.delete(
    `https://lidemy-book-store.herokuapp.com/books/${id}`,
    (error, response, body) => {
      const books = JSON.parse(body);
      console.log(books.status);
      if (books.status >= 400 || books.length === undefined) {
        return console.log('Failed to delete!');
      }
      if (error) {
        return console.log('Failed to delete!', error);
      }
      return console.log('Deleted successfully!');
    },
  );
}

function create(addName) {
  request.post({
    url: 'https://lidemy-book-store.herokuapp.com/books',
    form: {
      name: addName,
    },
  },
  (error) => {
    if (error) {
      return console.log('Failed to create!', error);
    }
    return console.log('Created successfully!');
  });
}

function update(id, name) {
  request.patch({
    url: `https://lidemy-book-store.herokuapp.com/books/${id}`,
    form: {
      name,
    },
  }, (error) => {
    if (error) {
      return console.log('更新失敗', error);
    }
    return console.log('更新成功！');
  });
}

switch (process.argv[2]) {
  case 'list':
    list();
    break;
  case 'read':
    read(process.argv[3]);
    break;
  case 'delete':
    deleteBook(process.argv[3]);
    break;
  case 'create':
    create(process.argv[3]);
    break;
  case 'update':
    update(process.argv[3], process.argv[4]);
    break;
  default:
    console.log('Please enter \'list\', \'read\', \'delete\', \'create\' or \'update\'');
}
