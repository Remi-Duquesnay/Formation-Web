var button1 = document.getElementById("hello")
var button2 = document.getElementById("name")

function hello(){
	alert("Hello World")
}

function verifName(){
	let userName = prompt("Quel est votre prénom?")
	let userNameConfirm = prompt("Veuillez confirmer votre prénom")
	if (userName === userNameConfirm){
		alert("Votre prénom est : " + userName)
	} else {
		alert("Les prénoms ne correspondent pas.")
	}
}


button1.addEventListener("click", function (event) {hello()})
button2.addEventListener("click", function (event) {verifName()})