<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Carpeta.php");

/**
* Class UserMapper
*
* Database interface for User entities
*
* @author lipido <lipido@gmail.com>
*/
class CarpetaMapper {
	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a User into the database
	*
	* @param User $user The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
    
    function RellenaDatos($carpeta){
       
        //Sentencia SQL de búsqueda de la tupla
        if($carpeta->getPadre() == "NULL"){
            $autor = $carpeta->getAutor();
            $stmt = $this->db->query("SELECT * FROM CARPETA WHERE autor = '" . $autor . "'  and padre is NULL");
            $carpetas_bd = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $carpetas_array = array();
            foreach ($carpetas_bd as $carpetas) {
                array_push($carpetas_array, new Carpeta($carpetas['uid'], $carpetas['nombre'], $carpetas['padre'], $carpetas['fecha'], $carpetas['autor']));
            }
            
            return $carpetas_array;
        }else{
            $autor = $carpeta->getAutor();
            $padre = $carpeta->getPadre();
            $stmt = $this->db->query("SELECT * FROM CARPETA WHERE autor = '" . $autor . "'  and padre = '" . $padre . "'");
            $carpetas_bd = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $carpetas_array = array();
            foreach ($carpetas_bd as $carpetas) {
                array_push($carpetas_array, new Carpeta($carpetas['uid'], $carpetas['nombre'], $carpetas['padre'], $carpetas['fecha'], $carpetas['autor']));
            }
            
            return $carpetas_array;
        }
    }


	/**
	* Checks if a given username is already in the database
	*
	* @param string $username the username to check
	* @return boolean true if the username exists, false otherwise
    */
    function existe($carpeta){
        if($carpeta->getPadre() == NULL){
            $stmt = $this->db->prepare("SELECT count(nombre) FROM CARPETA where nombre=? and padre IS NULL");
            $stmt->execute(array($carpeta->getNombre()));
        }else{
            $stmt = $this->db->prepare("SELECT count(nombre) FROM CARPETA where nombre=? and padre=?");
            $stmt->execute(array($carpeta->getNombre(),$carpeta->getPadre()));
        }

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }


    function Add($carpeta)
	{

        if($this->existe($carpeta)){
            return "MALLL";
        }else{
            if($carpeta->getPadre() == NULL){
                $stmt = $this->db->prepare("INSERT INTO  CARPETA (uid, nombre, padre, fecha, autor) VALUES (?,?,?,?,?)");
                $stmt->execute(array(NULL, $carpeta->getNombre(), NULL, $carpeta->getFecha(), $carpeta->getAutor()));
            }else{
                $stmt = $this->db->prepare("INSERT INTO  CARPETA (uid, nombre, padre, fecha, autor) VALUES (?,?,?,?,?)");
                $resultado = $stmt->execute(array(NULL, $carpeta->getNombre(), $carpeta->getPadre(), $carpeta->getFecha(), $carpeta->getAutor()));
            }
            if($resultado)
            {
                return "Bien";
            }
            else
            {
                return "MAL";
            }
        }  
    }

    function Eliminar($carpeta){
        $stmt = $this->db->prepare("DELETE FROM CARPETA WHERE uid=?");
        $resultado = $stmt->execute(array($carpeta->getUid()));

        if ($resultado) {
            return "Bien";
        } else {
            return "MAL";
        }
    }


    function EliminarTodo($carpeta){

        $stmt = $this->db->prepare("DELETE FROM CARPETA WHERE autor=?");
        $resultado = $stmt->execute(array($carpeta->getAutor()));

        if ($resultado) {
            return "Bien";
        } else {
            return "MAL";
        }
    }

    function sePuedeBorrar($carpeta){
        $stmt = $this->db->prepare("SELECT autor FROM CARPETA WHERE uid=?");
        $resultado = $stmt->execute(array($carpeta->getUid()));

        if (!$resultado){ //Si la busqueda no da resultado (la tupla no está en la BD)
            return 'tupla inexistente';

        }else{ //Si la búsqueda da resultado
            return $resultado;//Devuelve la tupla resultado
        }
    }

    function GetPermiso(){
        $stmt = $this->db->prepare("SELECT autor FROM CARPETA WHERE uid=?");
        $resultado = $stmt->execute(array($carpeta->getPadre()));

        if (!$resultado){ //Si la busqueda no da resultado (la tupla no está en la BD)
            return 'tupla inexistente';

        }else{ //Si la búsqueda da resultado
            return $resultado; //Devuelve la tupla resultado
        }
    }

    function GetPermiso2(){
        $stmt = $this->db->prepare("SELECT autor FROM CARPETA WHERE uid=?");
        $resultado = $stmt->execute(array($carpeta->getUid()));

        if (!$resultado){ //Si la busqueda no da resultado (la tupla no está en la BD)
            return 'tupla inexistente';

        }else{ //Si la búsqueda da resultado
            return $resultado;
        }
    }


    function NOMBRE(){
        $stmt = $this->db->prepare("SELECT nombre FROM CARPETA WHERE uid=?");
        $resultado = $stmt->execute(array($carpeta->getUid()));

        if (!$resultado){ //Si la busqueda no da resultado (la tupla no está en la BD)
            return 'tupla inexistente';

        }else{ //Si la búsqueda da resultado
            return $resultado; //Devuelve la tupla resultado
        }
    }


    function PADRE(){

        $stmt = $this->db->prepare("SELECT padre FROM CARPETA WHERE uid=?");
        $resultado = $stmt->execute(array($carpeta->getUid()));

        if (!$resultado){ //Si la busqueda no da resultado (la tupla no está en la BD)
            return 'tupla inexistente';

        }else{ //Si la búsqueda da resultado
            return $resultado; //Devuelve la tupla resultado

        }
    }
    

	/**
	* Checks if a given pair of username/password exists in the database
	*
	* @param string $username the username
	* @param string $passwd the password
	* @return boolean true the username/passwrod exists, false otherwise.
	*/
	public function isValidUser($login, $password) {
		$stmt = $this->db->prepare("SELECT count(login) FROM USUARIO where login=? and password=?");
		$stmt->execute(array($login, $password));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
}
