//Funzione per controllare che tutti i campi siano utilizzati
function finalCheck(){
	//Campi da controllare
	var mat = document.getElementById("mat").value;
	var newCat = document.getElementById("newCategory").value;
	//Campi da visualizzare in caso di errore
	var matError = document.getElementById("matError");
	var catError = document.getElementById("catError");
	//Form al quale fare submit
	var formAM = document.getElementById("formAC");
	//Paragrafo in cui inserire il valore
	if(mat != "" && newCat != ""){
		formAC.submit();
	}
	if(mat == ""){
		matError.style.display = "block";
	}else{
		matError.style.display = "none";
	}
	if(newCat == ""){
		catError.style.display = "block";
	}else{
		catError.style.display = "none";
	}
} 