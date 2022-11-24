<?php

//cargamos el modelo
require_once('models/userModel.php');
require_once('models/userRepository.php');
require_once('models/messageModel.php');
require_once('models/messageRepository.php');
require_once('models/roomModel.php');
require_once('models/roomRepository.php');
session_start();


if(!isset($_SESSION['user'])){
    $datos['id']=0;
    $datos['name']="";
    $datos['rol']=0;
    $datos['email']="";
    $datos['birthday']="";
    $datos['vip']=0;
    $datos['activated']=1;
    $datos['password']="";
    $datos['img']="";
    $datos['status']=0;
    $_SESSION['user'] = new User($datos);
}

UserRepository::getAllUsers();

if(isset($_GET['sala'])){
    UserRepository::calculateStatus($_SESSION['user']->getID());
    // $time=UserRepository::getTimeAction();
    require_once('controllers/editCreateController.php');
    die();
}
if(isset($_GET['room'])){
    UserRepository::calculateStatus($_SESSION['user']->getID());
    $totalrooms = RoomRepository::getCountRooms();
    if($_GET['room']<=$totalrooms && $_GET['room']>0){
        if(RoomRepository::getRoomById($_GET['room'])->getPrivated()==1){
            echo "<script>alert('Soy una sala privada Onichan ✌')</script>";
        }else{
            $roomMessages = MessageRepository::getRoomMessages($_GET['room']);
            $allUsers = UserRepository::getAllUsers();
            require_once('controllers/roomController.php');
            die();
        }
    }else{
        // Así mandamos mensaje informando de no hacer cosas 
        // echo "<script>alert('No me metas cosas extrañas por URL')</script>";
        // Así no mandamos mensaje pero recargamos la página principal
        header("Location: index.php");
    }
}

if(isset($_GET['rooms'])){
    UserRepository::calculateStatus($_SESSION['user']->getID());
// Aquí lo mismo, necesitamos comprobar que haya usuario logeado para acceder y que así no nos rompan las bolas
    if($_SESSION['user']->getName() ==""){
        header('Location: index.php');
    }else{
       $allrooms = RoomRepository::getAllRooms();
    require_once('views/roomList.phtml');
    die(); 
    }
    
}

if(isset($_GET['panelAdmin'])) {
    UserRepository::calculateStatus($_SESSION['user']->getID());
    // Aquí primero comprobamos que sea admin y dentro del admin controller he comprobado si esta logado o no para que no rompan las bolas pasando panelAdmin por url
    if($_SESSION['user']->getRol()!=1){
        header('Location: index.php');
    }else{
        require_once('controllers/adminController.php');
    die();
    }
}
if(isset($_GET['logout'])){
    unset($_SESSION['user']);
    $datos['id']=0;
    $_SESSION['user'] = new User($datos);
}
if(isset($_GET['login'])) {
    require_once('controllers/loginController.php');
    die();
}


// cargar la vista
require_once("views/mainView.phtml");
?>