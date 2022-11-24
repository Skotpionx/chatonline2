<?php
class Room {
    private $id;
    private $privated;
    private $name;

    public function __construct ($datos){
        $this->id = $datos['id'];
        $this->privated = $datos['privated'];
        $this->name = $datos['name'];
    }

    //método magico Get
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    public function getId(){
        return $this->id;
    }
    public function getPrivated(){
        return $this->privated;
    }
    public function getName(){
        return $this->name;
    }
}

?>