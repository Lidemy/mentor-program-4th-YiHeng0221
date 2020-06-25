function capitalize(str) {
	let result = ''
	
	for(let i = 0; i < str.length; i++){
		let code = str.charCodeAt(i) // 可直接使用str[0]
		if(i === 0){
			if(code >= 97 && code <= 122){
				result += String.fromCharCode(code - 32)
			}else{
				result += str[i]
			}
		}else{
			result += str[i]
		}
	}
	return result
  
}

console.log(capitalize('hello'));
