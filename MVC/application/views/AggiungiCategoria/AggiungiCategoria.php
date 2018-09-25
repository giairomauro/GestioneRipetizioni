				<?php
					$id = $connection->getFullUser("$mail", true);
					//Prendo nome e id della materia del docente
					$matName = $connection->userGetMaterie($id);
					$matId = $connection->userGetMaterie($id, true);
				?>
				<!--Parte principale del sito-->
				<section id="content" class="column-right">
					<article>
						<h2>Aggiunta categoria</h2>
						<br>
						<form method="post" action="http://eserciz.samtinfo.ch/home/addCategory/<?php echo $mail ?>" id="formAC">
							<table>
								<tr>
									<!-- Select per la selezione della materia -->
									<td><select required id="mat" name="mat">
										<option value="" selected disabled hidden>Materia</option>
										
										<?php
										for($i = 0; $i < count($matName); $i++){
											echo "<option value=$matId[$i]>$matName[$i]</option>";
										}
										?>

									</select></td>
									<!--  Input per la nuova categoria -->
									<td><input type="text" id="newCategory" name="newCategory" placeholder="Nuova categoria"></td>
								</tr>
								<tr>
									<!-- paragrafo nascosto per segnalare un errore -->
									<td><span style="display: none; color: red;" id="matError">Campo materia obbligatorio</span></td>
									<!-- paragrafo nascosto per segnalare un errore -->
									<td><span style="display: none; color: red;" id="catError">Campo categoria obbligatorio</span></td>
								</tr>
							</table>
							<!-- Input per prendere i valori per la funzione del submit -->
							<input type="text" name="mail" value="<?php echo $mail ?>" hidden>
						</form>
						<input type="button" name="submitAM" value="Aggiungi categoria" onclick="finalCheck()">
						<script src="http://eserciz.samtinfo.ch/application/views/AggiungiCategoria/js/Script.js"></script>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				