<?php


class Home
{
	/**
	* Pagina di creazio serie
	*/
    private $category = null;
    public function index($mail, $category = null)
    {
    	if (!isset($_SESSION['mail'])) {
    		header("location: http://localhost:8042/MVC/login/index/");
    	}
    	require_once 'application/models/connection.php';
    	$connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
		$connection->sqlConnection();
    	//require_once 'application/views/home/index.php';
        require 'application/views/Static/header.php';
        require 'application/views/sidebar/sidebarCS.php';
        require 'application/views/CreazioneSerie/CreazioneSerie.php';
        require 'application/views/Static/footer.php';
    }
    //Funzione che apre la pagina della domanda con la mail per riconosciere l'utente e la categoria in base alla materia una volta decisa
    public function creazioneDomanda($mail, $category = null)
    {
        if (!isset($_SESSION['mail'])) {
            header("location: http://localhost:8042/MVC/login/index/");
        }
        require_once 'application/models/connection.php';
       $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();
        
        require 'application/views/Static/header.php';
        require 'application/views/sidebar/sidebarCD.php';
        require 'application/views/CreazioneDomanda/CreazioneDomanda.php';
        require 'application/views/Static/footer.php';
    }
    /**
    * Funzione che richiama il model per aggiungere una materia al docente loggato
    */
    public function addMateria()
    {
        require_once 'application/models/connection.php';
        $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idMateria = $_POST["materieDaAggiungere"];
        }
        $connection->newMateria($idMateria);
        $this->index();
    }
    /**
    *
    */
    public function aggiungiMateria($mail)
    {
        if (!isset($_SESSION['mail'])) {
            header("location: http://localhost:8042/MVC/login/index/");
        }
        require_once 'application/models/connection.php';
       $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();
        
        require 'application/views/Static/header.php';
        require 'application/views/sidebar/sidebarAM.php';
        require 'application/views/AggiungiMateria/AggiungiMateria.php';
        require 'application/views/Static/footer.php';
    }
    //Funzione che apre la pagina di aggiunta di una categoria per una materia
    public function aggiungiCategoria($mail)
    {
        if (!isset($_SESSION['mail'])) {
            header("location: http://localhost:8042/MVC/login/index/");
        }
        require_once 'application/models/connection.php';
        $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();
        
        require 'application/views/Static/header.php';
        require 'application/views/sidebar/sidebarAC.php';
        require 'application/views/AggiungiCategoria/AggiungiCategoria.php';
        require 'application/views/Static/footer.php';
    }
    /**
    *
    */
    public function getCategoryQuestion($mail)
    {
        if (!isset($_SESSION['mail'])) {
            header("location: http://localhost:8042/MVC/login/index/");
        }
        require_once 'application/models/connection.php';
        $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();

        //Prendo la materia dal form che ha richiamato la funzione, quello della scelta materia
        $materia = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['Materia'])){
                $materia = $_POST['Materia'];
            }
        }
        //Richiamo la funzione che va a prendere la categoria
        $this->category = $connection->getCategory($materia, true, false);
        //Richiamo la funzione che riapre la pagina con la categoria
        $this->CreazioneDomanda($mail, $this->category);
    }
    /**
    *
    */
    public function getCategorySerie($mail)
    {
        if (!isset($_SESSION['mail'])) {
            header("location: http://localhost:8042/MVC/login/index/");
        }
        require_once 'application/models/connection.php';
        $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();

        //Prendo la materia dal form che ha richiamato la funzione, quello della scelta materia
        $materia = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['Materia'])){
                $materia = $_POST['Materia'];
            }
        }
        //Richiamo la funzione che va a prendere la categoria
        $this->category = $connection->getCategory($materia, true, false);
        //Richiamo la funzione che riapre la pagina con la categoria
        $this->index($mail, $this->category);
    }
    /**
    *
    */
    public function selezionaSerie($mail)
    {
        if (!isset($_SESSION['mail'])) {
            header("location: http://localhost:8042/MVC/login/index/");
        }
        require_once 'application/models/connection.php';
        $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();
        
        require 'application/views/Static/header.php';
        require 'application/views/sidebar/sidebarSS.php';
        require 'application/views/SelezioneSerie/SelezioneSerie.php';
        require 'application/views/Static/footer.php';
    }

    //Funzione per creare la domanda
    public function creaDomanda(){

        if (!isset($_SESSION['mail'])) {
            header("location: http://localhost:8042/MVC/login/index/");
        }
        require_once 'application/models/connection.php';
       	$connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();

        //Inizio del submit se c'è ilmetodo post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //prendo la categoria
            $categoria = $_POST["cat"];

            //If per prendere il valore dell'immagine o del testo della domanda
            if($_POST["format"] == "text"){
                $format = $_POST["textQuestion"];
            }else{
                $format = $_FILES['imageQuestion'];

                //Prendo il nome del file
                $name = $format['name'];

                //Prendo il percorso temporaneo del file e gli cambio nome
                $tmpName = $format['tmp_name'];
                $newName = 'application/img/'. $name;
				rename($tmpName, $newName);

            }

            //If che controlla se la domanda è pubblica o privata
            if($_POST["pubPriv"] == "public"){
                $pubPriv = true;
            }else{
                $pubPriv = false;
            }

            //Prendo la difficoltà
            $difficolta = $_POST["diff"];
            echo $categoria;
            if($_POST["format"] == "text"){
            	if($categoria == 'noCat'){
		            //Richiamo la funzione che inserisce i dati nel database
		            $connection->addQuestion($format, null, $pubPriv, null, $difficolta);
            	}else{
		            //Richiamo la funzione che inserisce i dati nel database
		            $connection->addQuestion($format, null, $pubPriv, $categoria, $difficolta);
            	}
	        }else{
            	if($categoria == 'noCat'){
		            //Richiamo la funzione che inserisce i dati nel database
		            $connection->addQuestion(null, $newName, $pubPriv, null, $difficolta);
            	}else{
		            //Richiamo la funzione che inserisce i dati nel database
		            $connection->addQuestion(null, $newName, $pubPriv, $categoria, $difficolta);
            	}
	        }

	        //Ritorno alla pagina di inserimento domanda
			header("location: http://localhost:8042/MVC/home/creazioneDomanda/". $_SESSION['mail']);
        }
    }

    //Funzione che crea la serie
    public function creaSerie(){
        if (!isset($_SESSION['mail'])) {
            header("location: http://localhost:8042/MVC/login/index/");
        }
        require_once 'application/models/connection.php';
       	$connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();

        //Inizio del submit se c'è ilmetodo post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    	//Prendo la difficoltà
	    	$difficolta = $_POST['diff'];

	    	//Inizio a prendere i valori per cercare la serie
	    	//Prendo la materia
	    	$materia = $_POST['matValue'];

	    	//Prendo la difficolta
	    	$categoria = null;
	    	if(isset($_POST["cat"])){
            	$categoria = $_POST["cat"];
        	}

	        //If che controlla se la domanda è pubblica o privata
	        if($_POST['pubPriv'] == "public"){
	            $pubPriv = true;
	        }else if($_POST['pubPriv'] == "private"){
	            $pubPriv = false;
	        }else{
	        	$pubPriv = "all";
	        }

	        //If che controlla se la domanda è pubblica o privata
	        if($_POST['useNew'] == "used"){
	            $useNew = true;
	        }else{
	            $useNew = false;
	        }

            //Prendo il numero di domande richieste
            $domRich = $_POST['QuestsNumber'];

	        //Richiamo la funzione che prende il numero di domande
	        $numDomande = $connection->numDomande($categoria, $difficolta, $pubPriv, $useNew);
            //rendo le domande
            $domande = $connection->getDomande($categoria, $difficolta, $pubPriv, $useNew);

            require('application/models/fpdf/fpdf.php');

	        // crea l'istanza del documento
            $pdf = new FPDF();
             
            // Setto il font del documento
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);

            //Header del pdf
            // Seleziona Arial 15
            $pdf->SetFont('Arial','',15);
            // Muove verso destra
            $pdf->Cell(130);
            // Titolo in riquadro
            $pdf->Cell(30,10,'Nome Cognome: ........................',0,0,'C');
            // Interruzione di linea
            $pdf->Ln(20);

            //Metto il titolo
            // Seleziona Arial 15
            $pdf->SetFont('Arial','B',30);
            // Muove verso destra
            $pdf->Cell(75);
            // Titolo in riquadro
            $pdf->Cell(30,10, 'Titolo',0,0,'C');
            // Interruzione di linea
            $pdf->Ln(20);

            //CNOtrollo se le domande richieste sono disponibili
            if($numDomande < $domRich){
                //Ciclo le domande
                for($i = 0; $i < $numDomande; $i++){
                    //Controllo se la domanda è un immagine o un testo
                    if($domande[1] == ''){
                        $pdf->Cell(100, 30, $domande[2]);
                    }else if($domande[2] == ''){
                        $pdf->Cell(100, 30, $domande[1]);
                    }
                }
            }else if($numDomande >= $domRich){
                for($i = 0; $i < $domRich; $i++){
                    if($domande[1] == ''){
                        $pdf->Cell(100, 30, $domande[2]);
                    }else if($domande[2] == ''){
                        $pdf->Cell(100, 30, $domande[1]);
                    }
                }
            }

            //Inserisco i valori nel database
            $titolo = 'application/pdf/Eserizio'. $domande[0] .'.pdf';
            $connection->insertSerie($titolo, $difficolta);
            //Salvo il pdf
            $pdf->Output('F', 'application/pdf/Eserizio'. $domande[0] .'.pdf');
            //Ritorno alla pagina di inserimento domanda
            header("location: http://localhost:8042/MVC/home/index/". $_SESSION['mail']);
	    }
    }

    //Funzione per prendere le serie la serie
    public function getSerie(){
        if (!isset($_SESSION['mail'])) {
            header("location: http://localhost:8042/MVC/login/index/");
        }
        require_once 'application/models/connection.php';
        $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection();

        return $connection->getSerie();
    }

    /**
    * Funzione che richiama il model per rimuovere una materia al docente loggato
    */
    public function removeMateria()
    {
       require_once 'application/models/connection.php';
        $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
        $connection->sqlConnection(); 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idMateria = $_POST["materieDaRimuovere"];
        }
        $connection->removeMateria($idMateria);
        $this->aggiungiMateria($_SESSION['mail']);
    }

    //Funzione per aggiungere la materia
    public function addCategory(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(!empty($_POST["mat"]) && !empty($_POST["newCategory"])){
                //Entrata nel database
                require_once 'application/models/connection.php';
                $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
                $connection->addCategoria($_POST["mat"],$_POST["newCategory"]);
                //Se funziona torno alla vecchia pagina altrimenti sampo l'errore
                header("location: http://localhost:8042/MVC/home/aggiungiCategoria/".$_SESSION['mail']);
            }else{
                //Richiamo la funzione che riapre la pagina con la categoria
                $this->aggiungiCategoria($_SESSION['mail']);
            }
        }
    }

    //Funzione per aggiungere la materia
    public function addMateriaNext($mail){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once 'application/models/connection.php';
            $connection = new Connection("efof.myd.infomaniak.com","efof_eserciz2018","Eserciz_Admin2018", "efof_Eserciz2018");
            $connection->addMateria($_POST['mat']);
            $this->aggiungiMateria($_SESSION['mail']);
        }
    }
}
