				<?php 
					/*if(isset($_POST['cat']) && $_POST['cat'] != ""){
						echo "ciao";
						header("location: http://localhost/progetto-MVC/application/views/CreazioneDomanda/creaDomanda.php");
					}*/
					$selected = '';
					if(isset($_POST['Materia'])){
						$selected = $_POST['Materia'];
						$select = $selected;
					}else{
						$selected = 'null';
					}
					$id = $connection->getFullUser("$mail", true);
					//Prendo nome e id della materia del docente
					$matName = $connection->userGetMaterie($id);
					$matId = $connection->userGetMaterie($id, true);
					//Prendo le difficolta
					$diff = $connection->getDifficulty();
				?>
				
				<!--Parte principale del sito-->
				<section id="content" class="column-right">
					<article>
						<h2>Creazione Domanda</h2>
						<br>
						<!-- Form che richiama la funzione che prende la categoria in base alla materia scelta -->
						<form id="formCategoria" method="post" action="http://eserciz.samtinfo.ch/home/getCategoryQuestion/<?php echo $mail ?>" style="display: inline;">
							<table style="display: inline;" class="inLine">
								<tr>
									<!-- Select per la selezione della materia -->
									<td><select required id="mat" name="Materia" onchange="this.form.submit()">
										<option value="" selected disabled hidden>Materia</option>
										<?php 
										for($i = 0; $i < count($matName); $i++){
									    	//Inserirso i dati nell'option
										    if($select == $matId[$i]){
												echo "<option value=$matId[$i] selected>$matName[$i]</option>";
											}else{
												echo "<option value=$matId[$i]>$matName[$i]</option>";
											}
										}
										?>
									</select></td>
								</tr>
								<tr>
									<!-- paragrafo nascosto per segnalare un errore -->
									<td><span style="display: none; color: red;" id="matError">Campo materia obbligatorio</span></td>
								</tr>
							</table>
						</form>
						<!-- Form che richiama la pagina corrente -->
						<form id="formSend" enctype="multipart/form-data" method="POST" action="http://eserciz.samtinfo.ch/home/creaDomanda" style="display: inline;">
							<!-- input per poter prendere i valori negli altri file php -->
							<input type="text" name="selected" value="<?php echo $selected ?>" hidden>
							<input type="text" name="mail" value="<?php echo $_SESSION ['$mail'] ?>" hidden>
							
							<table style="display: inline;" class="inLine">
								<tr>
									<!-- Select per la selezione della materia -->
									<td><select required id="cat" name="cat">
										<?php 
											//Controllo se ci sono delle categorie disponibili
											if (count($category) > 0) {
												//Option iniziale
												echo '<option value="" selected disabled hidden id="cat">Categoria</option>';
											    // Scrivo gli option
											    foreach ($category as $id => $nome) {
													echo "<option value='$id'>$nome</option>";
												}
												//se non ci sono categorie disponibili il select non verr contato nel controlo finale
											} else {
												echo '<option value="noCat" selected hidden id="cat">Categoria</option>';
											}
										?>
									</select></td>
								</tr>
								<tr>
									<!-- paragrafo nascosto per segnalare un errore -->
									<td><span style="display: none; color: red;" id="catError">Campo categoria obbligatorio</span></td>
								</tr>
							</table>
							<table style="display: inline;" class="inLine">
								<tr>
									<!-- Select per la selezione della difficoltà -->
									<td><select required id="diff" name="diff">
										<option value="" selected disabled hidden>Difficoltà</option>
										
										<?php
										for($i = 0; $i < count($diff); $i++){
											echo "<option value=$diff[$i]>$diff[$i]</option>";
										}
										?>

									</select></td>
								</tr>
								<tr>
									<!-- paragrafo nascosto per segnalare un errore -->
									<td><span style="display: none; color: red;" id="diffError">Campo difficoltà obbligatorio</span></td>
								</tr>
								</tr>
							</table>
							<br>
							<!-- radio button per la scelta se la domanda è pubblica o privata -->
							<input type="radio" name="pubPriv" id="public" value="public"><span style="margin-right: 10px;">Pubblica</span>
							<input type="radio" name="pubPriv" id="private" value="private"><span style="margin-right: 10px;">Privata</span>
							<!-- paragrafo nascosto per segnalare un errore -->
							<span style="display: none; color: red;" id="pubPrivError">Selezionare opzione</span>
							<br>
							<br>
							<!-- Radio button per scegliere se la domanda è immagine o testo -->
							<input type="radio" name="format" id="image" value="image" onclick="controlQuestionFormat()"><span style="margin-right: 10px;">Immagine</span>
							<input type="radio" name="format" id="text" value="text" onclick="controlQuestionFormat()"><span style="margin-right: 10px;">Testo</span>

							<!-- paragrafo nascosto per segnalare un errore -->
							<span style="display: none; color: red;" id="formatError">Selezionare opzione</span>
							<br>
							<br>

							<!-- Blocchi da mostrare in base alla scelta dei radio button precedenti -->
							<div style="display: none;" id="divImage">
								<span style="display: none; color: red;" id="imageError">Selezionare immagine</span>
								<input type="file" name="imageQuestion" accept="image/*" id="imageQuestion" required>
							</div>
							<div style="display: none;" id="divText">
								<span style="display: none; color: red;" id="textError">Testo obbligatorio</span>
								<input type="text" name="textQuestion" id="textQuestion" style="width: 300px; height: 20px;">
							</div>

						</form>
						<br>
						<!-- Submit per il  -->
						<input type="button" name="submitD" value="Crea domanda" onclick="finalCheck()">
						<script src="http://eserciz.samtinfo.ch/application/views/CreazioneDomanda/js/Script.js"></script>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				