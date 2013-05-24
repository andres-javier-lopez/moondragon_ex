<!DOCTYPE html>
<html>
	<head>
		<title>Ejemplo de MoonDragon</title>
	</head>
	<body>
		<h1>Formulario de prueba</h1>
		<table>
			<thead>
				<tr><th>Nombre</th><th>Edad</th><th>Sexo</th></tr>
			</thead>
		
		<?php 
			include "database/conexion.php";
			$mysqli = new mysqli($host, $user, $password, $database);
			
			$sql = "SELECT * FROM `usuario`";
			$result = $mysqli->query($sql);
			
			while($row = $result->fetch_object()) {
				switch($row->sexo) {
					case 'm':
						$sexo = "Masculino";
						break;
					case 'f':
						$sexo = "Femenino";
						break;
					default:
						$sexo = "No definido";
				}
				echo "<tr><td>$row->nombre</td><td>$row->edad</td><td>$sexo</td></tr>";
			}
		?>
		</table>
	</body>
</html>
