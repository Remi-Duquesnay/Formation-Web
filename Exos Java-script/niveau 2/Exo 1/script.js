//Les variables
//nombre
var nombre = 42
console.log(nombre);
//tableau
var tab = [2, 5, 6, 7, 9]
console.log(tab);
console.log(tab.length)
//chaine de caracteres
var chaine = "ceci est une chaine de characteres"
console.log(chaine);
//Conditions

//if, else if ,else
if (nombre >= 50){
	console.log("super moitmoit")
	} else if (nombre <= 40){
	console.log("peux mieux faire")
	} else {
	console.log("la grande réponse")
}

//switch
var tabLength = tab.length
console.log(tabLength)
switch (tabLength){
	case 10:
	console.log("Il y a 10 éléments dans le tableau");
	break
	case 5:
	console.log("Il y a 5 éléments dans le tableau");
	break
	case 0:
	console.log("Le tableau est vide");
	break
	default:
	console.log("Je ne connais pas le nombre d'éléments du tableau");
}

//Boucles
var counter = 0
//while
while (counter <= 4){
	console.log("Messire, on en a gros")
	counter++
}

//for
for(i=0; i < tab.length; i++){
	console.log(tab[i])
}