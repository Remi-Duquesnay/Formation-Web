function selBodyPart(str){
	let remClass = document.getElementsByClassName("selected")
	let vDivDisp = document.getElementById("b-" + str)
	let vDivHide = document.getElementsByClassName("displayed")
	let select = document.getElementById(str)
 console.log(vDivHide)
	remClass[0].classList.remove("selected")
	select.classList.add("selected")
	vDivHide[0].style.display = "none"
	vDivHide[0].classList.remove("displayed")
	vDivDisp.classList.add("displayed")
	vDivDisp.style.display = "block"
}