<?php
/**
* 
*/
class GestioneMaterie
{
	/**
	* Funizione che aggiunge una materia al docente
	*/
	public function addMateria()
	{
		require_once 'application/models/connection.php';
    	$connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
		$connection->sqlConnection();
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mail = $_POST["mail"];
            $materia = $_POST[""];
        }
		$connection->insertMatDoc();
		header("location: http://eserciz.samtinfo.ch/home");
	}
}