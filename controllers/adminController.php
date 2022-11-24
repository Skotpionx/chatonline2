<?php  
// Si no está logeado pa casa
if($_SESSION['user']->getName() ==""){
    header("Location: index.php");
}
if(isset($_GET['panelAdmin'])){

    if($_GET['panelAdmin']!=""){
        if(UserRepository::getOneUsuario($_GET['panelAdmin'])->getRol()==0){ 
            UserRepository::goAdmin($_GET['panelAdmin']);
            header("Location: index.php?panelAdmin");
        }else{
            UserRepository::revokeAdmin($_GET['panelAdmin']);
            header("Location: index.php?panelAdmin");
        }
    }
}
if(isset($_GET['delete'])){
    if(RoomRepository::deleteRoom($_GET['id'])){
        header("Location: index.php?panelAdmin");
    }else{
        echo'No se ha podido borrar';
    }
}
if(isset($_GET['deleteUser'])){
    UserRepository::deleteUser($_GET['deleteUser']);
    header("Location: index.php?panelAdmin");
}

require_once('views/adminView.phtml');

?>