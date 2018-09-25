<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php $idDoc = $connection->getId($_SESSION['mail']); ?>
	<?php $mat =  $connection->getMaterie(); ?>
    <?php $id =  $connection->getMaterie(true); ?>
	<form action="http://localhost/progetto-MVC/home/addMateria" method="POST" name="add">
		<input type="hidden" name="idDoc" value="$idDoc">
		<input type="hidden" name="mail" value="$mail">
		<select name="materieDaAggiungere">
			<option value="" selected="true" disabled="true" hidden="true"> Scegli materia...</option>
            <?php for ($i=0; $i < count($mat); $i++): ?>
	            <?php echo"<option value=$id[$i]>" ?>
	           		<?php echo " ".$mat[$i] ?>
	            <?php echo"</option>" ?>
            <?php endfor; ?>
		</select>
		<input type="submit" name="" value="Aggiungi materia">
	</form>
	<?php $mat =  $connection->userGetMaterie($idDoc); ?>
	<?php $mail = "davide@paradiso.ch" ?>
    <?php $id =  $connection->userGetMaterie($idDoc, true); ?>
	<form action="http://localhost/progetto-MVC/home/removeMateria" method="POST" name="remove">
		<input type="hidden" name="idDoc" value="$idDoc">
		<select name="materieDaRimuovere">
			<option value="" selected="true" disabled="true" hidden="true"> Scegli materia...</option>
            <?php for ($i=0; $i < count($mat); $i++): ?>
	            <?php echo"<option value=$id[$i]>" ?>
	           		<?php echo " ".$mat[$i] ?>
	            <?php echo"</option>" ?>
            <?php endfor; ?>
		</select>
		<input type="submit" name="" value="Rimuovi materia">
	</form>
	<form action="http://localhost/progetto-MVC/logout/index" method="POST">
		<input type="submit" name="" value="LOGOUT">
	</form>
</body>
</html>