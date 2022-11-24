<?php

if(isset($_POST['send'])){
    $msg =$_POST['send'];
    MessageRepository::sendMessage($msg);
    header('Location: index.php');
}
?>