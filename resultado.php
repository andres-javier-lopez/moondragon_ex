<?php

$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ejemplo de MoonDragon</title>
	</head>
	<body>
		<h1>Resultados</h1>
		<label>Nombre: <?php echo $nombre; ?></label><br/>
		<label>Edad: <?php echo $edad;?></label><br/>
		<label>Sexo:
		<?php
			switch($sexo) {
				case 'x':
					echo "no definido";
					break;
				case 'm':
					echo "masculino";
					break;
				case 'f':
					echo 'femenino';
					break;
			}
		?>	
		</label><br/>
		<a href="index.php">Regresar</a>
	</body>
</html>

