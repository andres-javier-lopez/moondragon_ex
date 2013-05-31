<?php

include 'database/conexion.php';
$mysqli = new mysqli($host, $user, $password, $database);
$sexo_seleccionado = '';

function select_sexo($sexo) {
	global $sexo_seleccionado;
	
	if($sexo_seleccionado == $sexo) {
		echo 'selected';
	}
}

$task = isset($_REQUEST['task'])?$_REQUEST['task']:'lista';

switch($task) {
	
	case 'nuevo':
		$nombre = '';
		$edad = '';
		$sexo_seleccionado = '';
		$contenido = 'templates/form.php';
		$task = 'crear';
		break;
	case 'edit':
		$id = $_POST['id'];
		$sql = 'SELECT `nombre`, `edad`, `sexo` FROM `usuario` WHERE `id` = '.$id.';';
		$result = $mysqli->query($sql);
		$row = $result->fetch_object();
		$nombre = $row->nombre;
		$edad = $row->edad;
		$sexo_seleccionado = $row->sexo;
		$contenido = 'templates/form.php';
		$task = 'actualizar';
		break;
	case 'crear':
		$nombre = $_POST['nombre'];
		$edad = $_POST['edad'];
		$sexo = $_POST['sexo'];
		
		$sql = "INSERT INTO `usuario` (`nombre`, `edad`, `sexo`) VALUES('$nombre', '$edad', '$sexo');";
		$mysqli->real_query($sql);
		$mensaje = 'Se ha guardado correctamente';
		$contenido = 'mensaje.php';
		break;
	case 'actualizar':
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$edad = $_POST['edad'];
		$sexo = $_POST['sexo'];
		
		$sql = "UPDATE `usuario` SET `nombre` = '$nombre', `edad` = '$edad', `sexo` = '$sexo' WHERE `id` = $id;";
		$mysqli->real_query($sql);
		$mensaje = 'Se ha actualizado correctamente';
		$contenido = 'mensaje.php';
		break;
	case 'delete':
		$id = $_POST['id'];
		
		$sql = "DELETE FROM `usuario` WHERE `id` = $id;";
		$mysqli->real_query($sql);
		$mensaje = 'Se ha eliminado correctamente';
		$contenido = 'mensaje.php';
		break;
	case 'lista':
	default:
		$sql = "SELECT * FROM `usuario`";
		$result = $mysqli->query($sql);
		
		$table = '';
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
			$id = '<input type="hidden" name="id" value="'.$row->id.'" />';
			$update = '<form action="index.php?task=edit" method="post">'.$id.'<input type="submit" value="Edit" /></form>';
			$delete = '<form action="index.php?task=delete" method="post">'.$id.'<input type="submit" value="Delete" /></form>';
			$table .= "<tr><td>$row->nombre</td><td>$row->edad</td><td>$sexo</td><td>$update</td><td>$delete</td></tr>";
		}
		$contenido = 'templates/lista.php';
		break;
}

include 'templates/main.php';
