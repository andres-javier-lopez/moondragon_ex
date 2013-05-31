<h1>Usuario</h1>
<form action="index.php" method="POST">
	<input type="hidden" name="task" value="<?php echo $task ?>" />
	<input type="hidden" name="id" value="<?php echo $id ?>" />
	<label>Nombre: </label><input type="text" name="nombre" value="<?php echo $nombre ?>" /><br/>
	<label>Edad: </label><input type="number" name="edad" value="<?php echo $edad ?>" /><br/>
	<label>Sexo: </label><select name="sexo">
		<option value="x">Seleccionar...</option>
		<option value="m" <?php select_sexo('m') ?>>Masculino</option>
		<option value="f" <?php select_sexo('f') ?>>Femenino</option>
	</select><br/>
	<input type="submit" value="Guardar" />
</form>
<br/>
<a href="index.php">Regresar</a>
