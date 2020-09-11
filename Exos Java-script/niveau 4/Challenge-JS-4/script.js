let calc = ""
let inputValue = "0"
let result = ""
let currentDisplay

function displayCalc(param){
	if(param == "cube"){
		$("#calculDisplay").text(inputValue+"³")
	}else if(param == "square"){
		$("#calculDisplay").text(inputValue+"²")
	}else if(param == "sqrt"){
		$("#calculDisplay").text("sqrt("+inputValue+")")
	}else if(param == 0){
		$("#calculDisplay").text("")
	}else if(param == "divide"){
		$("#calculDisplay").text(inputValue+"÷")
	}else if(param == "add"){
		$("#calculDisplay").text(inputValue+"+")
	}else if(param == "sbstract"){
		$("#calculDisplay").text(inputValue+"-")
	}else if(param == "multiply"){
		$("#calculDisplay").text(inputValue+"×")
	}else{
		$("#calculDisplay").text(inputValue)
	}
}

function displayInputResult(toDisplay = "", param){
	console.log(param)
	if(currentDisplay == 0){
		inputValue = inputValue.substring(inputValue.length - 1)
		toDisplay = toDisplay.substring(toDisplay.length - 1, toDisplay.length)
		displayCalc(0)
	}
	currentDisplay = param
	if(inputValue[0] == 0 && inputValue[1] != ","){
	console.log("plop")
	console.log(inputValue, toDisplay)
		inputValue = inputValue.substring(1)
		toDisplay = toDisplay.substring(1)
	console.log(inputValue, toDisplay)
	}
	$("#inputResultDisplay").text(toDisplay)
}

function input(key){
	if($(key).hasClass("operator")){
		if(currentDisplay == 0){
			inputValue = result
		}
	}
	if($(key).hasClass("numpad")){
		if($(key).attr("id") == "plusMinus"){
			if(inputValue[0] == "-"){
				inputValue = inputValue.replace("-", "")
			}else{
				inputValue = "-" +inputValue
			}
			displayInputResult(inputValue, "input")
		}else{
			inputValue += $(key).text()
			displayInputResult(inputValue, "input")
		}
	}else if($(key).attr("id") == "percent"){    // percent
		
	}else if($(key).attr("id") == "clearLastAll"){    //clear input
		inputValue = "0"
		displayInputResult(inputValue, "input")
	}else if($(key).attr("id") == "clearAll"){      //clear input + calcul
		calc = ""
		inputValue = "0"
		displayInputResult(inputValue, "input")
		displayCalc()
	}else if($(key).attr("id") == "backspace"){     //clear only last of input
		if(currentDisplay == "input"){
			inputValue = inputValue.substring(0, inputValue.length - 1)
			displayInputResult(inputValue, "input")
		}
	}else if($(key).attr("id") == "cube"){    // cube ³
		displayCalc("cube")
		result = Math.pow(inputValue, 3);
		displayInputResult(result, 0)
	}else if($(key).attr("id") == "square"){    //square ²
		displayCalc("square")
		result = Math.pow(inputValue, 2);
		displayInputResult(result, 0)
	}else if($(key).attr("id") == "squareroot"){    // squareRoot
		displayCalc("sqrt")
		result = Math.sqrt(inputValue)
		displayInputResult(result, 0)
	}else if($(key).attr("id") == "divide"){     //divide
		displayCalc("divide")
		calc += inputValue+"/"
		inputValue = "0"
	}else if($(key).attr("id") == "multiply"){      //multiply
		displayCalc("multiply")
		calc += inputValue+"*"
		inputValue = "0"
	}else if($(key).attr("id") == "substract"){     //substract
		displayCalc("substract")
		calc += inputValue+"-"
		inputValue = "0"
	}else if($(key).attr("id") == "add"){      //add
		displayCalc("add")
		calc += inputValue+"+"
		inputValue = "0"
	}else if($(key).attr("id") == "equal"){
		calc += inputValue
		result = eval(calc)
		displayInputResult(result, 1)
		calc = ""
		inputValue = "0"
	}
}

$("span").click(function(){input(this)})


// faire que les virgules soit remplacer par des point dans la var calc
