var userInput = askUser()

function askUser(){
	input = Number(prompt("Jusqu'à quelle table de multiplication voulez-vous afficher?"))
	if(isNaN(input)){
		alert("Saisie incorrecte, veuillez entrez un chiffre/nombre!")
		askUser()
	}
	return input
}

function displayTable(x){
	document.write("<table border = \"1\">")
	document.write("<tr>")
	document.write("<th></th>")
	
	for(i=1; i<=x; i++){
	console.log("1")
		document.write("<th>Table de " + i +"</th>")
	}
	
	document.write("</tr>")
	
	for(i=1; i<=10; i++){
			console.log("2")
		let color
		if(i%2 == 0){
			color = "#d1d0cd"
		}else{
			color = "#ffffff"
		}
		document.write("<tr style=\"background-color: "+color+";\">")
		document.write("<th>Table de " + i +"</th>")

		for(j=1; j<=x; j++){
			console.log("3")
			result = i * j
			document.write("<td>"+result+"</td>")
		}
		
		document.write("</tr>")
	}
	
}


displayTable(userInput)