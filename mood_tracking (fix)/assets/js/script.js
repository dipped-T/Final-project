if (Notification.permission!=="granted") {
			Notification.requestPermission();
		}

/*Declare all elements tags of the website*/
const header = document.querySelector("header");
const main = document.querySelector("main");

const heading1 = document.querySelector("h1");
const div = document.querySelectorAll("div");
const p = document.querySelectorAll("p");
const links = document.querySelectorAll("a");
const labels = document.querySelectorAll("label");
/*Declare the light dark modes switch*/
const lightDarkSwitch = document.getElementById("light-dark-switch");

/*Get the mode Item stored in the browser*/
let getMode = localStorage.getItem("mode");

if (getMode && getMode == "dark") { /*Check if the mode Item is already declared and has dark value*/

	lightDarkSwitch.setAttribute("checked","checked");
	/*We toggle to dark mode and by adding the dark-mode classes to all elements tags (header, texts...etc)*/
	main.classList.toggle("dark-mode-background");
	header.classList.toggle("dark-mode-background");

	heading1.classList.toggle("dark-mode-color");
	
	for (var i = div.length - 1; i >= 0; i--) {
		div[i].classList.toggle("dark-mode-color");
	}

	for (var i = p.length - 1; i >= 0; i--) {
		p[i].classList.toggle("dark-mode-color");
	}

	for (var i = links.length - 1; i >= 0; i--) {
		links[i].classList.toggle("dark-mode-color");
	}

	for (var i = labels.length - 1; i >= 0; i--) {
		labels[i].classList.toggle("dark-mode-color");
	}
}
lightDarkSwitch.addEventListener("change",function(){
	/*We toggle to dark or light mode and by adding or removing the dark-mode classes to all elements tags (header, texts...etc)*/
	header.classList.toggle("dark-mode-background");
	main.classList.toggle("dark-mode-background");

	heading1.classList.toggle("dark-mode-color");

	for (var i = div.length - 1; i >= 0; i--) {
		div[i].classList.toggle("dark-mode-color");
	}

	for (var i = p.length - 1; i >= 0; i--) {
		p[i].classList.toggle("dark-mode-color");
	}
	
	for (var i = links.length - 1; i >= 0; i--) {
		links[i].classList.toggle("dark-mode-color");
	}

	for (var i = labels.length - 1; i >= 0; i--) {
		labels[i].classList.toggle("dark-mode-color");
	}

	if (!main.classList.contains("dark-mode-background")) { /*Check if we are in light mode and the mode Item in light value in localstorage if not, we set the dark value*/
		return localStorage.setItem("mode","light");
	}
	localStorage.setItem("mode","dark");
})