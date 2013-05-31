<?php

class UsuarioModel {
	protected $mysqli;
	
	public function __construct() {
		include 'database/conexion.php';
		$this->mysqli = new mysqli($host, $user, $password, $database);
	}
	
	public function listall() {
		$sql = "SELECT * FROM `usuario`";
		$result = $this->mysqli->query($sql);
		
		return $result;
	}
	
	public function get($id) {
		$id = $id;
		$sql = 'SELECT `nombre`, `edad`, `sexo` FROM `usuario` WHERE `id` = '.$id.';';
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_object();
		return $row;
	}
	
	public function insert($nombre, $edad, $sexo) {
		$sql = "INSERT INTO `usuario` (`nombre`, `edad`, `sexo`) VALUES('$nombre', '$edad', '$sexo');";
		$this->mysqli->real_query($sql);
	}
	
	public function update($id, $nombre, $edad, $sexo) {
		$sql = "UPDATE `usuario` SET `nombre` = '$nombre', `edad` = '$edad', `sexo` = '$sexo' WHERE `id` = $id;";
		$this->mysqli->real_query($sql);
	}
	
	public function delete($id) {
		$sql = "DELETE FROM `usuario` WHERE `id` = $id;";
		$this->mysqli->real_query($sql);
	}
}
