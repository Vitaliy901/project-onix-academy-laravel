// info for button file.
const inputFile = document.querySelector("#file");
const buttonFile = document.querySelector(".button-file");
let buttonCont = buttonFile.innerHTML;
inputFile.addEventListener("change", function (e) {
	if (this.files.length > 0) {
		buttonFile.innerHTML =  'File selected';
	} else {
		buttonFile.innerHTML = buttonCont ;
	}
}, false);
