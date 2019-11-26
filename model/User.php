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
class User {

	/**
	* The user name of the user
	* @var string
	*/
	private $login;

	/**
	* The password of the user
	* @var string
	*/
	private $password;
	private $nombre;
	private $apellidos;
	private $email;
	private $uso;

	/**
	* The constructor
	*
	* @param string $login The name of the user
	* @param string $password The password of the user
	*/
	public function __construct($login=NULL, $password=NULL, $nombre=NULL, $apellidos=NULL, $email=NULl, $uso=NULL) {
		$this->login = $login;
		$this->password = $password;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->email = $email;
		$this->uso = $uso;
	}

	/**
	* Gets the login of this user
	*
	* @return string The login of this user
	*/
	public function getlogin() {
		return $this->login;
	}

	

	/**
	* Sets the login of this user
	*
	* @param string $login The login of this user
	* @return void
	*/
	public function setlogin($login) {
		$this->login = $login;
	}

	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function getApellidos() {
		return $this->apellidos;
	}
	public function setApellido($apellidos) {
		$this->apellidos = $apellidos;
	}

	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
	}

	public function getUso() {
		return $this->uso;
	}
	public function setUso($uso) {
		$this->uso = $uso;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getpassword() {
		return $this->password;
	}
	/**
	* Sets the password of this user
	*
	* @param string $password The password of this user
	* @return void
	*/
	public function setPassword($password) {
		$this->password = $password;
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
		if (strlen($this->login) < 5) {
			$errors["login"] = "login must be at least 5 characters length";

		}
		if (strlen($this->password) < 5) {
			$errors["password"] = "Password must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
}
