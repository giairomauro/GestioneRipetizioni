				<?php 
					$select = '';
					if(isset($_POST['Materia'])){
						$select = $_POST['Materia'];
					}else{
						$select = 'null';
					}
					//Prendo l'id dell'utente
					$id = $connection->getFullUser($_SESSION['mail'], true);
					//Prendo nome e id della materia del docente
					$matName = $connection->userGetMaterie($id);
					$matId = $connection->userGetMaterie($id, true);
					//Prendo le difficolta
					$diff = $connection->getDifficulty();
					//Prendo il numero delle domande esistenti
					$numRows = $connection->getQuestions();
				?>
				<!--Parte principale del sito-->
				<section id="content" class="column-right">
					<article>
						<h2>Creazione Serie</h2>
						<br>
						<form id="formCategoria" method="post" action="http://eserciz.samtinfo.ch/home/getCategorySerie/<?php echo $mail ?>" style="display: inline;">
							<!-- Select per la selezione della materia -->
							<select required id="mat" name="Materia" required onchange="this.form.submit()">
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
							</select>
						</form>
						<form id="formSend" method="post" action="http://eserciz.samtinfo.ch/home/creaSerie" style="display: inline;">

							<!-- Select per la selezione della materia -->
							<select required id="cat" name="cat" required>
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
										echo '<option value="noCat" selected disabled hidden id="cat">Categoria</option>';
									}
								?>
							</select>

							<!-- Select per la selezione della difficoltà -->
							<select required id="diff" name="diff" required>
								<option value="" selected disabled hidden>Difficoltà</option>
								
								<?php
								for($i = 0; $i < count($diff); $i++){
									echo "<option value=$diff[$i]>$diff[$i]</option>";
								}
								?>

							</select>
							<br>
							<br>
							<p>Domande: </p>
							<!-- Radio Button per la sccelta del tipo di domane -->
							<input type="radio" name="pubPriv" value="public" required><span style="margin-right: 10px;">Pubbliche</span>
							<input type="radio" name="pubPriv" value="private" required><span style="margin-right: 10px;">Private</span>
							<input type="radio" name="pubPriv" value="all" required><span style="margin-right: 10px;">Tutte</span>
							<br>
							<br>
							<input type="radio" name="useNew" value="used" required><span style="margin-right: 10px;">Usate</span>
							<input type="radio" name="useNew" value="new" required><span style="margin-right: 10px;">Nuove</span>
							<br>
							<br>
							<!-- Numero delle domandee -->
							<?php
							?>
							<!-- Setto il massimo delle domande al numero delle domande esistenti -->
							<span>Numero domande: </span> <input type="number" name="QuestsNumber" min=0 max=
														  <?php
														  echo($numRows);
														  ?> required
														  >
							<br>

							<!-- Input per prendere il valore della materia -->
							<input type="text" name="matValue" id="matValue" hidden>
						</form>
						<input type="submit" name="submitD" value="Crea serie" onclick="finalCheck()">
						<script src="http://eserciz.samtinfo.ch/application/views/CreazioneSerie/js/Script.js"></script>
						<br>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br>