<?php
    require_once(__DIR__."/../model/Fichero.php");
    require_once(__DIR__."/../model/FicheroMapper.php");
    require_once(__DIR__."/BaseRest.php");

    class FicheroRest extends BaseRest  {
        private $ficheroMapper;

        public function __construct(){
            parent::__construct();

            $this->ficheroMapper = new FicheroMapper();
        }

    }

    $ficheroRest = new FicheroRest();
    URIDispatcher::getInstance()
    ->map("GET",    "/$1", array($ficheroRest, "loquesea"))
    ->map("GET",    "/fichero/$1", array($ficheroRest, "loquesea"))
    ->map("POST",   "/fichero", array($ficheroRest, "addFichero"));
?>