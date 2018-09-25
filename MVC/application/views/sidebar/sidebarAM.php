
				<!--Sidebar dell'utente-->
				<aside id="sidebar" class="column-left">
					<!--Link per la pagina default e Info utente-->
					<header>
						<h1><a href="#">Eserciziario</a></h1>
						<table>
							<tr>
								<td><img src="http://eserciz.samtinfo.ch/application/views/sidebar/img/user_teacher.png" style="width: 30px; height: 30px;"></td>
								<td><h3><?php echo $connection->getFullUser("$mail", false, true, true); ?></h3></td>
							</tr>
						</table>
					</header>
					<!--Link pagine dell'utente-->
					<nav id="mainnav">
						<ul>
							<li><a href="http://eserciz.samtinfo.ch/home/index/<?php echo $mail ?>">Crea Serie</a></li>
							<li><a href="http://eserciz.samtinfo.ch/home/creazioneDomanda/<?php echo $mail ?>">Crea domanda</a></li>
							<li><a href="http://eserciz.samtinfo.ch/home/selezionaSerie/<?php echo $mail ?>">Seleziona serie</a></li>
							<li class="selected-item"><a href="http://eserciz.samtinfo.ch/home/aggiungiMateria/<?php echo $mail ?>">Aggiungi/Rimuovi materia</a></li>
							<li><a href="http://eserciz.samtinfo.ch/home/aggiungiCategoria/<?php echo $mail ?>">Aggiungi categoria</a></li>
							<li><a href="http://eserciz.samtinfo.ch/logout/">Disconetti</a></li>						</ul>
					</nav>
				</aside>