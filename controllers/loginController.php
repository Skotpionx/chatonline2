<?php   

if(isset($_GET['logout'])){
    unset($_SESSION['user']);
    header('Location: index.php?login');
}
// Si ya estas logeado que no puedas logearte
if($_SESSION['user']->getName() !=""){
    header('Location: index.php');
}
if(isset($_POST['logeo'])){
    if(userRepository::exists($_POST['user'])){
        if(isset($_POST['user']) && isset($_POST['password'])){
            var_dump("ADIOS");
            if(userRepository::login($_POST['user'], $_POST['password'])){
                var_dump("ADIOSSSSS");
                header('Location: index.php');
            }
        }
    }else{
        echo'My dude este nombre no ta registrated';
    }
}
if(isset($_POST['registro'])){
        if($_FILES['img']['name'] == ''  ){
            $imagen = 'minion.png';
        }else{
            $ruta= 'views/img/';
            $imagen = basename($_FILES['img']['name']);
            $uploadfile = $ruta.$imagen;
            move_uploaded_file($_FILES['img']['tmp_name'],$uploadfile);
        }
        if(isset($_POST['user']) && isset($_POST['password']) && isset($_POST['password2'])&& isset($_POST['email'])&& isset($_POST['birthday'])){
            $user = $_POST['user'];
            $email = $_POST['email'];
            $date = $_POST['birthday'];
            if(!userRepository::exists($user)){
                if($_POST['password'] == $_POST['password2']){
                    $pass = md5($_POST['password']);
                        userRepository::addUser($user,$pass,$email,$date,$imagen);
                        // con esto borramos las $_POST pasadas al registrar tras registrarse para evitar problemas de recarga 
                        $_POST = [];
                }else{
                    echo'La contraseña debe ser igual a la anterior';
                }
            }else{
                echo'Lamentablemente ese usuario ya existe';
            }
    }
}
require_once('views/loginView.phtml');
?>