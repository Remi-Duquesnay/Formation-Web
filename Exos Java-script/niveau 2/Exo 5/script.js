function recovery(param){
	let elem = document.getElementById(param)
	return elem
}

function eliminate(elemId){
	console.log(elemId)
	let elem = recovery("poisson" + elemId)
	console.log(elem)
	let str = elem.firstChild.data
	strArray = str.split(" ")
	console.log(strArray)
	for (i=0; i < strArray.length; i++){
		if (strArray[i] == "vivant"){
			strArray[i] = "mort"
		}
	}
	console.log(strArray)
	newStr = document.createTextNode(strArray.join(" "))
	elem.removeChild(elem.firstChild)
	elem.appendChild(newStr)
	
}

function eliminateRandom(){
	eliminate(Math.floor((Math.random() * (4 - 1)) + 1))
}