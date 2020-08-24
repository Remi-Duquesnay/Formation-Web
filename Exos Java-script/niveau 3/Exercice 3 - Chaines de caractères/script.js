const btn1 = document.getElementById("btn1");
const btn2 = document.getElementById("btn2");
const btn3 = document.getElementById("btn3");
const btn4 = document.getElementById("btn4");
const outputMsg = document.getElementById("showString");




function testCaps(str){
	let upperCase
	let betweenAandD
	let showScentence
	console.log(str[0])
	if (str[0] == str[0].toUpperCase){
		upperCase = "majuscule"
	} else {
		upperCase = "minuscule"
	}
	if ( str[0].toLowerCase == "a" || str[0].toLowerCase == "b" || str[0].toLowerCase == "c" || str[0].toLowerCase == "d"){
		betweenAandD = "est "
	} else {
		betweenAandD = "n'est pas "
	}
	showScentence = document.createTextNode("Le premier charactère de la chaine est une " + upperCase + " et " + betweenAandD + "comprise entre \"a\"et \"d\".")
	if (outputMsg.hasChildNodes()){
		outputMsg.removeChild(outputMsg.firstChild)
	}
	outputMsg.appendChild(showScentence)
}

function testAt(){
	
}

function testNum(){
	
}

function changeNum(){
	
}

btn1.addEventListener("click", function(event) {testCaps(document.getElementById("inputStr").value)} )