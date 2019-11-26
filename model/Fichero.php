<?php
    require_once(__DIR__."/../core/ValidationException.php");

    class Fichero {
        /**
	* The id of this post
	* @var string
	*/
	private $id;

	/**
	* The title of this post
	* @var string
	*/
	private $nombre;

	/**
	* The content of this post
	* @var string
	*/
	private $mime;

	/**
	* The author of this post
	* @var User
	*/
	private $fecha;

	/**
	* The list of comments of this post
	* @var mixed
	*/
    private $padre;
    
    /**
	* The list of comments of this post
	* @var string
	*/

	private $autor;

	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	//Constructor de la clase
    function __construct($id, $nombre, $mime, $fecha, $padre, $autor){
        $this->id = $id; 
        $this->nombre = $nombre; 
        $this->mime= $mime; 
        $this->fecha = $fecha; 
        $this->padre = $padre; 
        $this->autor = $autor; 

    } //Fin del constructor

    public function getId(){
        return $this->id;
    }

    public function setId(){
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre(){
        $this->nombre = $nombre;
    }

    public function getMime(){
        return $this->apellidos;
    }

    public function setMime(){
        $this->mime = $mime;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha(){
        $this->fecha = $fecha;
    }

    public function getPadre(){
        return $this->padre;
    }

    public function setPadre(){
        $this->padre = $padre;
    }

    public function getAutor(){
        return $this->autor;
    }

    public function setAutor(){
        $this->autor = $autor;
    }

    }
?>