function calcul(op){
	let nb = Number(document.getElementById("nb").value)
	let nb2 = Number(document.getElementById("nb2").value)
	let resultDisp = document.getElementById("dispResult")
	let result
	if (op == 1){
		result = addition(nb, nb2)
	} else if (op == 2){
		result = soustraction(nb, nb2)
	} else if (op == 3){
		result = multiplication(nb, nb2)
	} else if (op == 4){
		result = division(nb, nb2)
	} else if (op == 5){
		result = modulo(nb, nb2)
	}
	console.log(result)
	resultDisp.innerHTML = result
}


function addition(nb, nb2){
	return nb + nb2
}
function soustraction(nb, nb2){
    return nb - nb2
}
function multiplication(nb, nb2){
    return nb * nb2
}
function division(nb, nb2){
	return  nb / nb2
}
function modulo(nb, nb2){
	return nb % nb2
}
