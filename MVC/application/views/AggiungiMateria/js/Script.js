//Funzione per controllare che tutti i campi siano utilizzati
function finalCheck(){
	//Campi da controllare
	var mat = document.getElementById("mat").value;
	//Campi da visualizzare in caso di errore
	var matError = document.getElementById("matError");

	//Form al quale fare submit
	var formAM = document.getElementById("formAM");
	if(mat != ""){
		formAM.submit();
	}
	/*if(mat == ""){
		matError.style.display = "block";
	}*/
} 