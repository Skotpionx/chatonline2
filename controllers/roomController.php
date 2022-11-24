<?php
//Si no hay usuario lo mandamos al index.php así forzamos a que se logee y no rompa las bolas tocando la url 
if($_SESSION['user']->getName() ==""){
    header('Location: index.php');
}

if(isset($_POST['send'])){  
    $msg =$_POST['send'];
    MessageRepository::sendMessage($msg,$_GET['room']);
   // Recargar para mostrar el mensaje insertado
   header("Location: index.php?room=".$_GET['room']);
}

require_once("views/roomView.phtml");
?>