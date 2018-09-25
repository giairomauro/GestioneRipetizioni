//Variabili dei radiobutton da controllare
var image;
var text;
//Variabili dei div da mostrare o meno
var divImage = document.getElementById("divImage");
var divText = document.getElementById("divText");
//Funzione per il controllo del metodo di inserimento domanda
function controlQuestionFormat(){
	image = document.getElementById("image").checked;
	text = document.getElementById("text").checked;
	//Se viene premuto il bottone dell'immagine si apre la selezione di questa altrimenti l'input di testo
	if(image){
		divImage.style.display = "block";
		divText.style.display = "none";
	}else if(text){
		divText.style.display = "block";
		divImage.style.display = "none";
	}
}

//Funzione per controllare che tutti i campi siano utilizzati
function finalCheck(){
	//Campi da controllare
	var diff = document.getElementById("diff").value;
	var mat = document.getElementById("mat").value;
	var cat = document.getElementById("cat").value;
	var public = document.getElementById("public").checked;
	var private = document.getElementById("private").checked;
	var imageQuestion = document.getElementById("imageQuestion").files;
	var textQuestion = document.getElementById("textQuestion").value;
	//Campi degli errori da attivare in caso di errore
	var diffError = document.getElementById("diffError");
	var matError = document.getElementById("matError");
	var catError = document.getElementById("catError");
	var formatError = document.getElementById("formatError");
	var imageError = document.getElementById("imageError");
	var textError = document.getElementById("textError");
	var pubPrivError = document.getElementById("pubPrivError");
	//Form al quale fare submit
	var formSend = document.getElementById("formSend");
	//Controllo che i campi richiesti non siano vuoti
	if(diff != "" && mat != "" && (cat != "" || cat == "noCat") && (public || private)){
		matError.style.display = "none";
		catError.style.display = "none";
		diffError.style.display = "none";
		pubPrivError.style.display = "none";
		formatError.style.display = "none";
		//Se è richiesta l'immagine controllo che sia selezionata e faccio submit
		if(image){
			console.log(imageQuestion[0].name);
			if(imageQuestion.length === 0){
				imageError.style.display = "block";
			}else{
				formSend.submit();
			}
		//Se è richiesto il testo controllo che sia scritto e faccio submit
		}else if(text){
			if(textQuestion != ""){
				formSend.submit();
			}else{
				textError.style.display = "block";
			}
		}else{
			formatError.style.display = "block";
		}
	//In caso di campi vuoti controllo quali sono e attivo i relativi messaggi d'errore
	}else{
		if(mat == ""){
			matError.style.display = "block";
		}
		if(cat == ""){
			catError.style.display = "block";
		}
		if(diff == ""){
			diffError.style.display = "block";
		}
		if(!public && !private){
			pubPrivError.style.display = "block";
		}
	}
} 