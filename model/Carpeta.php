<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class User
*
* Represents a User in the blog
*
* @author lipido <lipido@gmail.com>
*/
class Carpeta {

	/**
	* The user name of the user
	* @var string
	*/
	private $uid;

	/**
	* The password of the user
	* @var string
	*/
	private $nombre;
	private $padre;
	private $fecha;
	private $autor;

	/**
	* The constructor
	*
	* @param string $login The name of the user
	* @param string $password The password of the user
	*/
	public function __construct($uid=NULL, $nombre=NULL, $padre=NULL, $fecha=NULL, $autor=NULl) {
		$this->uid = $uid;
		$this->nombre = $nombre;
		$this->padre = $padre;
		$this->fecha = $fecha;
		$this->autor = $autor;
	}

	/**
	* Gets the login of this user
	*
	* @return string The login of this user
	*/
	public function getUid() {
		return $this->uid;
	}

	public function setUid($uid) {
		$this->uid = $uid;
	}

	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function getPadre() {
		return $this->padre;
	}
	public function setPadre($padre) {
		$this->padre = $padre;
	}

	public function getFecha() {
		return $this->fecha;
	}
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function getAutor() {
		return $this->autor;
	}
	public function setAutor($autor) {
		$this->autor = $autor;
	}


	/**
	* Checks if the current user instance is valid
	* for being registered in the database
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForRegister() {
        $errors = array();
		if (strlen($this->nombre) < 5) {
			$errors["nombre"] = "nombre must be at least 5 characters length";

		}
	}
}
