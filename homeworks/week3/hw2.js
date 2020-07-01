const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function digiCount(n) {
// 計算幾次方
  if (n === 0) return 1;
  // edge case
  let result = 0;
  let d = n;
  while (d !== 0) {
    d = Math.floor(n / 10);
    result += 1;
  }
  return result;
}
function isNarcissistic(n) {
  let m = n;
  const digits = digiCount(m);
  let sum = 0;
  while (m !== 0) {
    const num = m % 10;
    sum += num ** digits;
    m = Math.floor(m / 10);
  }
  return sum === n;
}

function solve(input) {
  const temp = input[0].split(' ');
  const n = Number(temp[0]);
  const m = Number(temp[1]);
  for (let i = n; i <= m; i += 1) {
    if (isNarcissistic(i)) {
      console.log(i);
    }
  }
}

rl.on('close', () => {
  solve(lines);
});
