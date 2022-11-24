<?php

    class User{
        private $id;
        private $name;
        private $password;
        private $email;
        private $rol;
        private $activated;
        private $vip;
        private $birthday;
        private $img;
        private $status;

        
        public function __construct($datos)
        {
            $this->id = $datos['id'];
            $this->name = $datos['name'];
            $this->password = $datos['password'];
            $this->email = $datos['email'];
            $this->rol = $datos['rol'];
            $this->activated = $datos['activated'];
            $this->vip = $datos['vip'];
            $this->birthday = $datos['birthday'];
            $this->img = $datos['img'];
            $this->status = $datos['status'];
        }

        public function getID(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getPassword(){
            return $this->password;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getRol(){
            return $this->rol;
        }
        public function getActivated(){
            return $this->activated;
        }
        public function getVip(){
            return $this->vip;
        }
        public function getBirthday(){
            return $this->birthday;
        }
        public function getImg(){
            return $this->img;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->vip = $status;
        }
    }


?>