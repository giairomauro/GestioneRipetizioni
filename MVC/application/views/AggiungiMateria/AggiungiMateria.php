				<?php
					$id = $connection->getFullUser("$mail", true);
					//Prendo nome e id della materia del docente
					$matName = $connection->getMaterie();
					$matId = $connection->getMaterie(true);
				?>
				<!--Parte principale del sito-->
				<section id="content" class="column-right">
					<article>
						<h2>Aggiunta materia</h2>
						<br>
						<form method="POST" action="http://eserciz.samtinfo.ch/home/addMateriaNext/<?php echo $mail ?>" id="formAM">
							<!-- Select per la selezione della materia -->
							<select required id="mat" name="mat" required>
								<option value="" selected disabled hidden>Materia</option>
								
								<?php
								for($i = 0; $i < count($matName); $i++){
									echo "<option value=$matId[$i]>$matName[$i]</option>";
								}
								?>

							</select>
							<br>
							<input type="submit" name="" value="Aggiungi materia">
						</form>

						<?php $mat =  $connection->userGetMaterie($id); ?>
						<?php $mail = $_SESSION['mail'] ?>
					    <?php $id =  $connection->userGetMaterie($id, true); ?>
					    <br><br>
						<form action="http://eserciz.samtinfo.ch/home/removeMateria" method="POST" name="remove">
							<input type="hidden" name="idDoc" value="$idDoc">
							<select name="materieDaRimuovere" required>
								<option value="" selected="true" disabled="true" hidden="true"> Scegli materia...</option>
					            <?php for ($i=0; $i < count($mat); $i++): ?>
						            <?php echo"<option value=$id[$i]>" ?>
						           		<?php echo " ".$mat[$i] ?>
						            <?php echo"</option>" ?>
					            <?php endfor; ?>
							</select><br>
							<input type="submit" name="" value="Rimuovi materia">
						</form>
						<script src="http://eserciz.samtinfo.ch/application/views/AggiungiMateria/js/Script.js"></script>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				