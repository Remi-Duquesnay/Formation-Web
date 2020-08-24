function getChildsOfElem(elem) {
	console.log("Recherche...")
	let pArray = []
	let x = 0
	for (i = 0; i < elem.children.length; i++){
		console.log("Objets touvés, les quels sont des paragraphs?")
		if (elem.children[i].tagName == "P"){
			pArray[x] = elem.children[i]
			x++
			console.log("celui-ci, donc je le met de coté")
		}
	}
	return pArray
}

function action(elem, elemClassName) {
	let elemChild = getChildsOfElem(elem)
	console.log(elemChild)
	let str, changeDone, strArray, newStr, wordToChange, newWord
	switch (elemClassName){
		case 1:
			wordToChange = "plein"
			newWord = "vide"
			break
		case 2:
			wordToChange = "neuf"
			newWord = "déplacé"
			break
		case 3:
			wordToChange = "fait"
			newWord = "défait"
			break
		default:
			console.log("argument de la fonction incorect.")
	}
	for (childNb=0; childNb < elemChild.length; childNb++){
		str = elemChild[childNb].firstChild.data
		strArray = str.split(" ")
		console.log("séparation des mots")
		for (i=0; i < strArray.length; i++){
			if (strArray[i] == wordToChange){
				console.log("mot plein trouvé")
				strArray[i] = newWord
				console.log("mot " + wordToChange + " changé en " + newWord)
				newStr = document.createTextNode(strArray.join(" "))
				console.log("reconstruction de la phrase")
				elemChild[childNb].removeChild(elemChild[childNb].firstChild)
				console.log("supression de la ligne qui doit changer")
				elemChild[childNb].appendChild(newStr)
				console.log("ecriture de la nouvelle ligne")
				changeDone = true
				console.log("Changement effectué à la ligne: " + (childNb +1))
				break
			} else {
				console.log("le mot \"" + wordToChange + "\" n\'a pas été trouvé à la ligne " + (childNb + 1))
			}
		}
		if (changeDone == true){
				break
		}
			
	}
}
	
const soupDiv = document.getElementsByClassName("soupe")
const chairDiv = document.getElementsByClassName("fauteuil")
const bedDiv = document.getElementsByClassName("lit")

const drinkBtn = document.getElementById("boire")
const restBtn = document.getElementById("reposer")
const sleepBtn = document.getElementById("dormir")

drinkBtn.addEventListener("click", function (event) {action(soupDiv[0], 1)} )
restBtn.addEventListener("click", function (event) {action(chairDiv[0], 2)} )
sleepBtn.addEventListener("click", function (event) {action(bedDiv[0], 3)} )