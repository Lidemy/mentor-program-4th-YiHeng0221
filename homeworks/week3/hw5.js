const readline = require('readline');

const lines = [];

const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function higherOrLower(n) {
  const temp = n.split(' ');
  const a = temp[0].split('');
  const b = temp[1].split('');
  const k = Number(temp[2]);
  if (a.length > b.length) {
    if (k === 1) {
      return 'A';
    }
    return 'B';
  }
  if (a.length < b.length) {
    if (k === -1) {
      return 'A';
    }
    return 'B';
  }
  for (let i = 0; i < a.length; i += 1) {
    if (Number(a[i]) > Number(b[i])) {
      if (k === 1) {
        return 'A';
      }
      return 'B';
    }
    if (Number(a[i]) < Number(b[i])) {
      if (k === -1) {
        return 'A';
      }
      return 'B';
    }
  }
  return 'DRAW';
}

function solve(input) {
  const n = Number(input[0]);
  for (let i = 1; i <= n; i += 1) {
    console.log(higherOrLower(input[i]));
  }
}

rl.on('close', () => {
  solve(lines);
});
