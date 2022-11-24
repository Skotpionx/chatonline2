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

        public static function getLastTimeMessage($iduser){
            $db = Conectar::conexion();
            if(!$db){
                $error = "No se ha podido conectar a la base de datos";
            }
            else{
                $qMessages = "SELECT `date` FROM `message` WHERE iduser = $iduser ORDER BY DATE DESC LIMIT 1";
                $result = $db-> query($qMessages);
                $resultado = $result->fetch_assoc();
                if($resultado !=null){
                    $resultados = explode(" ",$resultado['date']);
                    $resultadotres = explode(":",$resultados[1]);
                    return $resultadotres;
                }
            }
        }

        public static function getSeconds($time){
            if($time != null){
                $hours = $time[0]*60*60;
                $minutes = $time[1]*60;
                $seconds = $time[2];
                return $hours+$minutes+$seconds;
            }
        }

        public static function getTimeNow(){
            $time = getdate();
            $hours = $time['hours'] *60 * 60;
            $minutes = $time['minutes'] * 60;
            $seconds = $time['seconds'];
            
            return $hours+$minutes+$seconds;
        }
}
?>