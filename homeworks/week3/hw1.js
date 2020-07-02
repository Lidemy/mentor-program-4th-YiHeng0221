const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function printStars(n) {
  let s = '';
  // 設定空字串
  for (let i = 0; i < n; i += 1) {
    s += '*';
    // 每跑一次回圈就加一個星星
  }
  console.log(s);
}

function solve(input) {
  for (let i = 1; i <= input; i += 1) {
    printStars(i);
  }
}

rl.on('close', () => {
  solve(lines);
});
