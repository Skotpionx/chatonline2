<?php 

    class UserRepository{

        public static function getOneUsuario($id){
            $db = Conectar::conexion();
            if(!$db){
                $error = "No se ha podido conectar a la base de datos";
            }
            else{
                $qusuario = "SELECT * FROM users where id=$id";
                $result = $db-> query($qusuario);
                if( $datos= $result -> fetch_assoc()){
                    $qusuarios = new User($datos);
                    return $qusuarios;
                }else{
                    return null;
                }
            }
        }

        public static function getAllUsers(){
            $db = Conectar::conexion();
            if(!$db){
                $error = "Poos no me he conectao";
            }
            else{
                $usuarios = [];
                $queryGetAllUsers = "SELECT * FROM users";
                $resultQueryGetAllUsers = $db-> query($queryGetAllUsers);
                while( $resultado =  $resultQueryGetAllUsers->fetch_assoc()){
                    $usuarios[] =  new User($resultado);
                }
                return $usuarios;
            }
        }

        
        public static function getUsuarios(){
            $db = Conectar::conexion();
            if(!$db) $error = "Te explotó manito";
            else{
                $usuarios = [];
                $qusers = "SELECT * FROM users";
                $result = $db-> query($qusers);
                while($datos = $result->fetch_assoc()){
                    $usuarios[] = new User($datos);
                }
                return $usuarios;
            }
        }


        public static function changeStatus($value){
            $db= Conectar::conexion();
            $q="UPDATE   `users`  SET `status`=$value WHERE id='".$_SESSION['user']->getID()."' ";
            $db->query($q);   
        }


    public static function login($user,$pass){
        $db= Conectar::conexion();
        $q="SELECT * FROM users WHERE `name` ='$user' AND activated='1'";
        $result = $db->query($q);
        while($datos=$result->fetch_assoc()){
            if($datos['password'] == md5($pass)){
                $_SESSION['user'] = new User($datos);
                userRepository::changeStatus(1);
                return true;
            }     
        }
    }
 

    public static function addUser($user,$pass,$email,$date,$image){
        $db= Conectar::conexion();
        $q="INSERT INTO `users`(`name`, `password`, `email`,`rol`, `activated`, `VIP`, `birthday`, `img`) VALUES ('$user','$pass','$email' , 0 , 1 , 0 ,'$date','$image')";
        $db->query($q); 
    }
    
    public static function exists($name){
        $db= Conectar::conexion();
        $q="SELECT * FROM users WHERE name ='$name'";
        $result = $db->query($q);
        if($result->fetch_assoc() == null){
            return false;
        }else{
            return true;
        }
    }
    public static function goAdmin($id){
        $db= Conectar::conexion();
        $q="UPDATE `users` SET `rol` = '1' WHERE `users`.`id` = $id";
        $db->query($q); 
    }
    
    public static function revokeAdmin($id){
        $db= Conectar::conexion();
        $q="UPDATE `users` SET `rol` = '0' WHERE `users`.`id` = $id";
        $db->query($q); 
    }
    public static function deleteUser($id){
        $db=Conectar::conexion();        
        $result= $db->query("UPDATE users SET activated='0' WHERE id='".$id."'");         
    } 
}
?>