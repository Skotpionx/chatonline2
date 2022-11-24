<?php

if($_SESSION['user']->getRol()==0){
    header('Location:index.php');
}else{
     if(isset($_POST['newroom'])){

        if(RoomRepository::newRoom($_POST['name'])){
            echo'<p>Creado Correctamente</p>';
        }
        
    }
    if(isset($_POST['editroom'])){

        if(RoomRepository::editRoom($_GET['id'],$_POST['privated'],$_POST['name'])){
            echo'<p>Editado Correctamente<a href="index.php?panelAdmin">Volver al panel administrativo</a></p>';
        }
    }
}
   require_once("views/new-editRoomView.phtml");
?>