function join(arr, concatStr) {
  if (arr.length === 0) { // edge case
    return '';
  }
	let str = ''
	for(let i = 0; i < arr.length; i++){
		if(i !== arr.length - 1){
			str += arr[i]
			str += concatStr
		}else{
			str += arr[i] //避免最後跑出concatStr
		}
	}
	return str

}

function repeat(str, times) {
	let ans = ''
	for(let i = 0; i < times; i++){
		ans += str
	}
	return ans
  
}
console.log(join([1, 2, 3], ''))
console.log(join(['a', 'b', 'c'], '!'))	
console.log(join(['a', 1, 'b', 2, 'c', 3], ','))

console.log(join(['a'], '!'));
console.log(repeat('a', 5));
