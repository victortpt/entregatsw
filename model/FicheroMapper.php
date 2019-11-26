<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class UserMapper
*
* Database interface for User entities
*
* @author lipido <lipido@gmail.com>
*/
class FicheroMapper {
	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
        $this->db = PDOConnection::getInstance();
	}

	public function save($fichero) {
		$stmt = $this->db->prepare("INSERT INTO FICHERO values (?,?,?,?,?,?)");
		$stmt->execute(array($fichero->getId(), $fichero->getNombre(), $fichero->getMime(), $fichero->getFecha(), $fichero->getPadre(), $fichero->getAutor()));
	}

	public function existeFichero($fichero) {
		$id = $fichero->getId();
		$stmt = $this->db->prepare("SELECT count(id) FROM FICHERO where id=?");
		$stmt->execute(array($id));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	
	 //Funcionesç

	 public function addFichero(){
		$fichero = new Fichero();

		try {
			if($fichero->getPadre() == "NULL"){
				$this->ficheroMapper->save($fichero);
			} else {
				echo "si el padre no es null";
			}


			header($_SERVER['SERVER_PROTOCOL'].' 201 Created');
			header("Location: ".$_SERVER['REQUEST_URI']);
		}catch(ValidationException $e) {
			http_response_code(400);
			header('Content-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}

	public function eliminarFichero($fichero){
		if(existeFichero($fichero)){
			$stmt = $this->db->prepare("DELETE FROM FICHERO WHERE (`id`  = '" . $this->id . "')");
		} else {
			echo "El fichero a eliminar no existe";
		}
	}

	public function descargarFichero($fichero){

		/*$sql = "SELECT *
        FROM FICHERO
        WHERE (`id` = '" . $this->id . "' AND  `autor` = '" . $this->autor . "')";*/
		


		$archivo = basename($fichero['nombre']);

		$ruta = '../Files/'.$archivo;

		if (is_file($ruta))
		{
			header('Content-Type: application/force-download');
			header('Content-Disposition: attachment; filename='.$archivo);
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: '.filesize($ruta));

			readfile($ruta);
		}
		else{
			echo "No existe";
		}
		
	}


}
