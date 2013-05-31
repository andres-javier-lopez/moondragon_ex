<?php

include '../moondragon/moondragon.manager.php';
include 'modelos/usuario.php';

class Usuarios extends Manager {
	protected $model;
	protected $sexo_seleccionado;
	protected $mensaje;
	
	public function __construct() {
		parent::__construct();
		
		$this->model = new UsuarioModel();
		$this->sexo_seleccionado = '';
		$this->mensaje = '';
	}
	
	public function index() {
		
		$result = $this->model->listall();
		
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
		$this->salida('templates/lista.php', array('table' => $table));
	}
	
	public function nuevo() {
		$vars['id'] = 0;
		$vars['nombre'] = '';
		$vars['edad'] = '';
		$this->sexo_seleccionado = '';
		$vars['task'] = 'crear';
		$this->salida('templates/form.php', $vars);
	}
	
	public function edit() {
		$vars['id'] = $_POST['id'];
		$row = $this->model->get($vars['id']);
		$vars['nombre'] = $row->nombre;
		$vars['edad'] = $row->edad;
		$this->sexo_seleccionado = $row->sexo;
		$vars['task'] = 'actualizar';
		$this->salida('templates/form.php', $vars);
	}
	
	public function crear() {
		$nombre = $_POST['nombre'];
		$edad = $_POST['edad'];
		$sexo = $_POST['sexo'];
		
		$this->model->insert($nombre, $edad, $sexo);

		$this->mensaje('Se ha guardado correctamente');
	}
	
	public function actualizar() {
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$edad = $_POST['edad'];
		$sexo = $_POST['sexo'];

		$this->model->update($id, $nombre, $edad, $sexo);
		
		$this->mensaje('Se ha actualizado correctamente');
	}

	public function delete() {
		$id = $_POST['id'];
		
		$this->model->delete($id);
		
		$this->mensaje('Se ha eliminado correctamente');
	}
	
	protected function mensaje($mensaje) {
		$this->mensaje = '<p>'.$mensaje.'</p>';
		$this->index();
	}
	
	protected function salida($contenido, $vars = array()) {
		extract($vars);
		include 'templates/main.php';
	}
	
	protected function select_sexo($sexo) {
		if($this->sexo_seleccionado == $sexo) {
			echo 'selected';
		}
	}
}

MoonDragon::run(new Usuarios());
