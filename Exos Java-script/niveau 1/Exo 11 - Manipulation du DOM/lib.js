function showHxContent(pNumber) {
	let vDiv = document.getElementById("title" + pNumber)
	vDiv.style.display = "block"
}

function hideAllDivs(){
	vDivs = document.getElementsByTagName("div")
	
	for (var i=0; i<vDivs.length; i++) {
		vDivs.item(i).style.display = "none"
	}
}

function alertTitle () {
	let vHx = document.getElementsByTagName("h1");
	console.log(vHx)
	let vIndice = document.getElementById("title").value;
	console.log(vIndice)
	vIndice = vIndice - 1;
	console.log(vIndice)
	alert(vHx.item(vIndice).firstChild.data);
}

function deleteTitle () {
	let vHx = document.getElementsByTagName("h1");
	let vIndice = document.getElementById("titleToDel").value;
	vIndice = vIndice - 1;
	vHx.item(vIndice).removeChild(vHx.item(vIndice).firstChild)
}

function defineTitle () {
	let vHx = document.getElementsByTagName("h1")
	let vIndice = document.getElementById("titleNb").value
	vIndice = vIndice - 1
	let titleNew = document.getElementById("newTitle").value
	let vText = document.createTextNode(titleNew)
	if (vHx.item(vIndice).hasChildNodes()) {
		vHx.item(vIndice).removeChild(vHx.item(vIndice).firstChild)
	}
	vHx.item(vIndice).appendChild(vText)
}