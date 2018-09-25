<?php
/**
* 
*/
class Login
{

	/*
		Funzione che carica la pagina di index
		e fa la connesione al server
	*/
	public function index($msn = "")
	{
		require_once 'application/models/connection.php';
		$connection = new Connection("localhost","root","", "ripetizioni");
		$connection->sqlConnection();
		require 'application/views/_templates/header.php';
		require 'application/views/login/index.php'; 
	}

    /*
        Funzione che richiama la classe Connection e inserisce i dati nel Database
    */
    public function sendMail()
    {
        require_once 'application/models/connection.php';
        $connection = new Connection("localhost","root","", "ripetizioni");

        //Get the entered data
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $mail = $_POST["mail"];
            $phone = $_POST["phone"];
            $via = $_POST["via"];
            $cap = $_POST["cap"];
            $city = $_POST["city"];
            $pass = $_POST["pass"];
            $pass = hash('sha512', $pass);
            $role = $_POST["role"];
        }

        if (strcmp($name, "") || strcmp($surname, "") || strcmp($mail, "") || strcmp($phone, "") || strcmp($via, "") || strcmp($cap, "") || strcmp($city, "") || strcmp($pass, "") || strcmp($role, "")) {
            $msn = $connection->insertRecord($name, $surname, $mail, $phone, $via, $cap, $city, $pass, $role);
        }

        if(strcmp($role, "coach")){
            $msn = "\'$name $surname\' attiva il tuo account";
            $msn = $msn."\n<a href='http://localhost:8042/MVC/login/register/$mail'>Attiva</a>";
            $headers = "From: progettoripetizioni@gmail.com";
            $a = mail($mail,"NON RISPONDERE A QUESTA MAIL",$msn,$headers);
        }else{
            $to = "giairo.mauro@samtrevano.ch";
            $subject = "NON RISPONDERE A QUESTA MAIL";
            $msn = "\'$name $surname\' vorrebbe creare un account sulla mail $mail";
            //$msn = $msn."\n<a href='http://localhost:8042/MVC/login/register/$mail'>Attiva</a>";
            //$msn = $msn."\n<a href='http://localhost:8042/MVC/login/noRegister/$mail'>Non attivare</a>";
            $headers = "From: progettoripetizioni@gmail.com";
            $a = mail($to, $subject, $msn, $headers);
        }

        header("location: ". URL);
    }

    /*
        Funzione che richiama la classe Connection e inserisce i dati nel Database
    */
    public function noRegister($mail)
    {
        //Send email to the not activated user
        $msn = $msn."Il suo account non è stato attivato, in";
        $msn = $msn."\n<a href='http://localhost:8042/MVC/login/register'>Attiva</a>";
        $msn = $msn."\n<a href='http://localhost:8042/MVC/login/noRegister'>Non attivare</a>";
        $headers = "From: progettoripetizioni@gmail.com";
        $a = mail($mail,"NON RISPONDERE A QUESTA MAIL",$msn,$headers);

        header("location: ". URL);
    }

	/*
		Funzione che richiama la classe Connection e inserisce i dati nel Database
	*/
	public function register($mail)
	{
		require_once 'application/models/connection.php';
		$connection = new Connection("localhost","root","", "ripetizioni");

        /*if (strcmp($name, "") || strcmp($surname, "") || strcmp($mail, "") || strcmp($phone, "") || strcmp($via, "") || strcmp($cap, "") || strcmp($city, "") || strcmp($pass, "") || strcmp($role, "")) {
        	$msn = $connection->insertRecord($name, $surname, $mail, $phone, $via, $cap, $city, $pass, $role);
        }
		header("location: ". URL);*/
	}

	/*
		Funzione che richiama il metodo della classe Connection che controlla se le credenziali sono corrette
	*/
	public function log_in()
	{
		require_once 'application/models/connection.php';
		$connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mail = $_POST["mail"];
            $pass = $_POST["pass"];
            $pass = hash('sha512', $pass);
            //echo $pass;
        }
        if ((strcmp($mail, "") || strcmp($pass, ""))) {
        	$var = ($connection->getUser($mail, $pass));
        	switch ($var) {
        		case 1: // LOGIN
        			$_SESSION['mail'] = $mail;
        			header("location: http://localhost:8042/MVC/home/index/".$_SESSION['mail']);
        			break;
        		
        		case 2: // PASSWORD SBAGLIATA
 					$this->phpAlert("Password Errata");
        			$this->index();
        			break;

        		default: // UTENTE NON REGISTRATO
        			$this->phpAlert("Utente non registrato");
        			$this->index();
        			break;
        	}
        } 
        
	}

	function phpAlert($msg) {
    	echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
} 

?>