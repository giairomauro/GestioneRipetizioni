//Funzione per controllare che tutti i campi siano utilizzati
function finalCheck(){
	//prendo il valore della materia e l'input in cui inserirlo
	var mat = document.getElementById("mat");
	var matValue = document.getElementById("matValue");
	//Form al quale fare submit
	var formSend = document.getElementById("formSend");
	//Controllo che i campi richiesti non siano vuoti
	if(mat.value != ""){
		console.log(document.getElementById("cat").value)
		matValue.value = mat.value;
		//Faccio il submit
		formSend.submit();
	}else{
		window.alert("Selezionare la materia");
	}
} 