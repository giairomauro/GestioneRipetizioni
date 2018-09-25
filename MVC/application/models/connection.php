<?php  

class Connection
{
	private $servername;
	private $username;
	private $password;
	private $dbName;
	function __construct($servername, $username, $password, $dbName)
	{
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;
		$this->dbName = $dbName;
	}
	/**
	* Funzione che connette il sito al database
	*/
	public function sqlConnection()
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		// Check connection
		if (!$conn) {
		    //die("Connection failed: " . mysqli_connect_error());
		    $this->phpAlert( mysqli_connect_error());
		}
		$conn->close();
		return $conn;
	}
	/**
	* Funzione che permette l'inserimento dei docenti nel DB
	*/
	public function insertRecord($name, $surname, $mail, $phone, $via, $cap, $city, $pass, $role)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		//echo "Connected successfully";
		$sql = "INSERT INTO utente (nome, cognome, telefono, email, password, via, CAP, citta, nome_tipo, attivo)
		VALUES ('$name', '$surname', '$phone', '$mail', '$pass', '$via', '$cap', '$city', '$role', 0)";
		
		if ($conn->query($sql) === TRUE) {
		   // echo "New record created successfully";
		} else {
		    //echo "Error: " . $sql . "<br>" . $conn->error;
		    $msg = "Registrazione utente non avvenuta, l'utente é già esistente.";
		    return $msg;
		}
		$conn->close();
	}
	/**
	* Funzione che ritorna TRUE se é'utente esiste e la password é corretta
	* altrimenti ritorna FALSE
	*/
	public function getUser($mail)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM utente WHERE email LIKE '$mail'";
		$result = $conn->query($sql);
		//print_r($result);
		if (($result->num_rows) > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        if (!(strcmp($pass, $row["Password"]))) {
		        	// LOGIN
		        	return 1;
		        }
		        else {
		        	// PASSWORD SBAGLIATA
		        	return 2;
		        }
		    }
		}
		else {
			// UTENTE NON REGISTRATO
			return 3;
		}
		$conn->close();
	}
	/**
	* Funzione che ritorna la password di un utente in base all'email passata come parametro
	*/
	public function getPassword($mail)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		$sql = "SELECT Password FROM Docente WHERE Mail LIKE '$mail'";
		$result = $conn->query($sql);
		$row = mysqli_fetch_row($result);
		$conn->close();
		return $row[0];
	}
	/**
	* Funzione che ritorna il nome di tutte le materie se id rimane null, altrimenti ritorna tutti i loro id
	*/
	public function getRole()
	{
		//Connect to database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);

		//Get roles
		$sql = "SELECT nome FROM tipo";
		$result = $conn->query($sql);
		$materie = array();
		while ($row = mysqli_fetch_row($result)) {
			array_push($materie, $row[0]);
		}
		$conn->close();
		return $materie;
	}

	/**
	* Funzione che riorna le materie insegnate da un docente, se onlyID é != da NULL
	* ritorna gli ID delle materie insegnate
	*/
	public function userGetMaterie($idUser, $onlyID = null)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		$sql = "SELECT ID_Materia FROM Doc_Mat WHERE ID_Docente LIKE $idUser";
		$result = $conn->query($sql);
		$idMaterie = array();
		while ($row = mysqli_fetch_row($result)) {
			array_push($idMaterie, $row[0]);
		}
		if ($onlyID != null) {
			return $idMaterie;
		}
		$materie = array();
		foreach ($idMaterie as $value) {
			$sql = "SELECT Nome_Materia From Materia WHERE ID_Materia LIKE $value";
			$result = $conn->query($sql);
			$row = mysqli_fetch_row($result);
			array_push($materie, $row[0]);
		}
		return $materie;
	}
	/**
	* Funzione che ritorna l'id del docente in base alla mail
	*/
	public function getId($mail)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		$sql = "SELECT ID_Docente FROM Docente WHERE Mail LIKE '$mail'";
		$result = $conn->query($sql);
		$id = 0;
		while ($row = mysqli_fetch_row($result)) {
			$id = $row[0];
		}
		return $id;
	}
	/**
	* Funzione che aggiunge una nuova materia a quelle che il docente già insegna
	*/
	public function newMateria($idMateria)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		$idDocente = $this->getId($_SESSION['mail']);
		$sql = "SELECT count(ID_Materia) FROM Doc_Mat WHERE ID_Materia LIKE $idMateria";
		$result = $conn->query($sql);
		$row = mysqli_fetch_row($result);
		if ($row[0] > 0) {
			return;
		}
		$sql = "INSERT INTO Doc_Mat (ID_Docente,ID_Materia) VALUES ($idDocente,$idMateria)";
		$conn->query($sql);
		$conn->close();
	}
	/**
	* Funzione che rimuove una materia del docente tra quelle che già insegna
	*/
	public function removeMateria($idMateria)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		$sql = "DELETE FROM Doc_Mat WHERE ID_Materia LIKE $idMateria";
		$conn->query($sql);
		$conn->close();
	}

	function phpAlert($msg) {
    	echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}

	public function getFullUser($mail, $isId = null, $isName = null, $isSurname = null){
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		//Prendo nome e cognome ee l metto in una variabile che ritorno
		$sql = "SELECT * FROM Docente WHERE Mail = '$mail'";
		$result = $conn->query($sql);
		$doc = $result->fetch_assoc();
		
		//Variabile da ritornare con i valori richiesti 
		$res = "";
		if($isName){
			$res .= $doc["Nome"]. " ";
		}
		if($isSurname){
			$res .= $doc["Cognome"]. " ";
		}
		if($isId){
			$res .= $doc["ID_Docente"];
		}

		return $res;
	}

	//Funzione per prendere le categorie in base alla materia selezionata
	public function getCategory($materia){
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		//Select per prendere le categora in base alla materia
		$sql = "SELECT ID_Categoria, Nome_Categoria FROM Categoria WHERE ID_Materia = '$materia'";
		$result = $conn->query($sql);
		
		//Inserisco id e nome dele categorie nell'array e le ritorno
		$categorie = array();
		while ($row = mysqli_fetch_row($result)) {
			$categorie[$row[0]] = $row[1];
		}

		$conn->close();
		return $categorie;
	}	
	//Funzione per prendere le difficolta da usare nei select
	public function getDifficulty(){
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		//Select per prendere le difficolta
		$sql = "SELECT * FROM Difficolta";
		$result = $conn->query($sql);
		
		//Inserisco le difficolta nell'array e le ritorno
		$difficolta = array();
		while ($row = mysqli_fetch_row($result)) {
			array_push($difficolta, $row[0]);
		}
		$conn->close();
		return $difficolta;
	}

	/*
	Funzione per prendere il numero massimo di domande,
	da usare nella creazione delle serie per decidere quante domande inserirci
	*/
	public function getQuestions(){
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);

		//Prendo il numero di domande esistenti
		$sql = "SELECT * FROM Domanda";
		$result = $conn->query($sql); 
		$numRows = $result->num_rows;

		$conn->close();
		return $numRows;
	}

	public function addCategoria($mat,$cat)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		$sql = "INSERT INTO Categoria (Nome_Categoria, ID_Materia) VALUES ('$cat', $mat)";
		if ($conn->query($sql) === FALSE) {
        	echo "Error: " . $sql . "<br>" . $conn->error;
        }
	}

	public function addMateria($mat)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		$idDoc = $this->getId($_SESSION['mail']);

        //Prendo l'id della materia selezionata
        $ID_Materia = $mat;

        //Inserisco il campo nella tabella
        $sql = "INSERT INTO Doc_Mat (ID_Docente, ID_Materia) VALUES ($idDoc, $ID_Materia)";
        if ($conn->query($sql) === FALSE) {
    		$this->phpAlert("Insegni già questa materia !!!");
        }
	}

	public function addQuestion($text = null, $imagine = null,  $public, $idCat, $diff){
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);

		//Prendo l'id del docente
		$idDoc = $this->getId($_SESSION['mail']);

		//Controllo i campi da riempire
		if($imagine == null){
	        //Inserisco il campo nella tabella
	        $sql = "INSERT INTO Domanda (testoDomanda, pubblica, usata, immagine, ID_Docente, ID_Categoria, difficolta) VALUES ('$text', $public, 0, '', $idDoc, $idCat, '$diff')";
		}else{
	        //Inserisco il campo nella tabella
	        $sql = "INSERT INTO Domanda (testoDomanda, pubblica, usata, immagine, ID_Docente, ID_Categoria, difficolta) VALUES ('', $public, 0, '$imagine', $idDoc, $idCat, '$diff')";
		}

        if ($conn->query($sql) === FALSE) {
    		echo "Error: " . $sql . "<br>" . $conn->error;
        }
	}

	//Funzione che crea la serie
	public function numDomande($idCat, $difficolta, $pubPriv, $useNew)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);

		//COntrollo per i campi nulli
		if($useNew == false){
			//Prendo il numero di domande esistenti per i filtri richiesti
			$sqlCount = "SELECT count(*) FROM Domanda WHERE pubblica LIKE $pubPriv AND usata LIKE 0 AND ID_Categoria LIKE $idCat AND difficolta LIKE '$difficolta'";
		}else{
			//Prendo il numero di domande esistenti per i filtri richiesti
			$sqlCount = "SELECT count(*) FROM Domanda WHERE ID_Categoria LIKE idCat AND difficolta LIKE '$difficolta' AND pubblica LIKE $pubPriv AND usata LIKE $useNew";
		}
		$row = $conn->query($sqlCount);
		$rowNumber = mysqli_fetch_row($row);

		return $rowNumber[0];
	}

	//Funzione che crea la serie
	public function getDomande($idCat, $difficolta, $pubPriv, $useNew)
	{
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);

		//COntrollo per i campi nulli
		if($useNew == false){
			//Prendo il numero di domande esistenti per i filtri richiesti
			$sqlCount = "SELECT ID_Domanda, testoDomanda, immagine FROM Domanda WHERE pubblica LIKE $pubPriv AND usata LIKE 0 AND ID_Categoria LIKE $idCat AND difficolta LIKE '$difficolta'";
		}else{
			//Prendo il numero di domande esistenti per i filtri richiesti
			$sqlCount = "SELECT ID_Domanda, testoDomanda, immagine FROM Domanda WHERE ID_Categoria LIKE idCat AND difficolta LIKE '$difficolta' AND pubblica LIKE $pubPriv AND usata LIKE $useNew";
		}
		$row = $conn->query($sqlCount);
		$rowNumber = mysqli_fetch_row($row);

		return $rowNumber;
	}

	public function resetPassword($mail, $password)
	{
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		$id = $this->getId($mail);
		$password = md5($password);
		$sql = "UPDATE Docente SET Password = '$password' WHERE ID_Docente = $id";
		if ($conn->query($sql) === FALSE) {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	public function insertSerie($pdf, $diff){
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		//Prendo l'id del docente
		$idDoc = $this->getId($_SESSION['mail']);
        //Inserisco il campo nella tabella
        $sql = "INSERT INTO Serie (pdf, ID_Docente, difficolta) VALUES ('$pdf', $idDoc, '$diff')";
        if ($conn->query($sql) === FALSE) {
    		$this->phpAlert("Insegni già questa materia !!!");
        }
	}

	//Funzione per prendere la serie
	public function getSerie(){
		//Connetto al database
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);

		//Prendo le serie
		$sql = "SELECT * FROM Serie";
		$result = $conn->query($sql); 

		//Inserisco le difficolta nell'array e le ritorno
		$pdf = array();
		while ($row = mysqli_fetch_row($result)) {
			array_push($pdf, $row[1]);
		}
		return $pdf;
		$conn->close();
	}
}