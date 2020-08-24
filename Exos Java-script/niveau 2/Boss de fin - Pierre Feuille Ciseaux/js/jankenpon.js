const rockBtn = document.getElementById("pierre")
const paperBtn = document.getElementById("feuille")
const scissorBtn = document.getElementById("ciseaux")
const lizardBtn = document.getElementById("lezard")
const spockBtn = document.getElementById("spock")
const choiceDisplay = document.getElementById("partie")
const resultDisplayElem = document.getElementById("result") 

const winLose = [[0, 0, 1, 1, 0], //pierre [pierre, feuille, ciseaux, lezard, spock]
				 [1, 0, 0, 0, 1], //feuille
				 [0, 1, 0, 1, 0], //ciseaux
				 [0, 1, 0, 0, 1], //lezard
				 [1, 0, 1, 0, 0]] //spock
				 //0=perd, 1=gagne

function randomChoice() {
	const choice = Math.floor(Math.random() * (4 - 0 +1))
	return choice
}

function play(playerChoice){
	const aiChoice = randomChoice()
	
	if (playerChoice == aiChoice){
		result = "draw"
		} else {
		if ( winLose[playerChoice][aiChoice] == 1){
			result = "win"
			} else {
			result = "lose"
		}
	}
	displayResults(playerChoice, aiChoice, result)
}

function displayResults(playerChoice, aiChoice, result){
	let choiceScentence
	let resultScentence
	
	if (playerChoice == 0){
		playerChoice = "Pierre"
		} else if (playerChoice == 1){
		playerChoice = "Feuille"
		} else if (playerChoice == 2){
		playerChoice = "Ciseaux"
		} else if (playerChoice == 3){
		playerChoice = "Lezard"
		} else {
		playerChoice = "Spock"
	}
	
	if (aiChoice == 0){
		aiChoice = "Pierre"
		} else if (aiChoice == 1){
		aiChoice = "Feuille"
		} else if (aiChoice == 2){
		aiChoice = "Ciseaux"
		} else if (aiChoice == 3){
		aiChoice = "Lezard"
		} else {
		aiChoice = "Spock"
	}
	
	if (result == "win"){
		result = "gagné!!"
		} else if (result == "lose"){
		result = "perdu!!"
		} else {
		result = "fait un match nul."
	}
	
	if (choiceDisplay.hasChildNodes()){
		choiceDisplay.removeChild(choiceDisplay.firstChild)
	}
	
	if (resultDisplayElem.hasChildNodes()){
		resultDisplayElem.removeChild(resultDisplayElem.firstChild)
	}
	
	choiceScentence = document.createTextNode("l'ordi a joué: " + aiChoice + " et le joueur a joué: " + playerChoice)
	resultScentence = document.createTextNode("Vous avez " + result)
	choiceDisplay.appendChild(choiceScentence)
	resultDisplayElem.appendChild(resultScentence)
}

rockBtn.addEventListener("click", function (event) {play(0)})
paperBtn.addEventListener("click", function (event) {play(1)})
scissorBtn.addEventListener("click", function (event) {play(2)})
lizardBtn.addEventListener("click", function (event) {play(3)})
spockBtn.addEventListener("click", function (event) {play(4)})