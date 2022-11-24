<?php
class Message {
    private $id;
    private $content;
    private $iduser;
    private $idroom;
    private $activated;

    public function __construct ($datos){
        $this->id = $datos['id'];
        $this->content = $datos['content'];
        $this->iduser = $datos['iduser'];
        $this->idroom = $datos['idroom'];
        $this->activated = $datos['activated'];
    }

    //método magico Get
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }


}

?>