const readline = require('readline');

const lines = [];

const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function palindrome(str) {
  let arr = '';
  for (let i = str.length - 1; i >= 0; i -= 1) {
    arr += str[i];
  }
  if (arr === str) {
    console.log('True');
  } else {
    console.log('False');
  }
}

function solve(input) {
  palindrome(input[0]);
}

rl.on('close', () => {
  solve(lines);
});
