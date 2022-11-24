<?php 

    class MessageRepository{

        public static function getRoomMessages($idroom){
            $db = Conectar::conexion();
            if(!$db){
                $error = "No se ha podido conectar a la base de datos";
            }
            else{
                $messages = [];
                $qMessages = "SELECT * FROM `message` where idroom=$idroom ORDER BY DATE";
                $result = $db-> query($qMessages);
                while( $datos= $result -> fetch_assoc()){
                    $messages[] = new Message($datos);
                }
                return $messages;
            }
        }

        public static function sendMessage($content, $room){
            $db = Conectar::conexion();
            if(!$db){
                $error = "No se ha podido conectar a la base de datos";
            }
            else{
                $qMessages = "INSERT INTO `message`  (content,iduser,idroom,activated, `date` )  VALUES('".$content."', '".$_SESSION['user']->getID()."','".$room."',1,NOW()  ) ";
                $result = $db-> query($qMessages);
                return true;
            }
        }

}
?>