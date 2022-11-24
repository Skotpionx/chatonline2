<?php
class RoomRepository{

    public static function getAllRooms(){
        $db = Conectar::conexion();
        if(!$db){
            $error = "No se ha podido conectar a la base de datos";
        }
        else{
            $salas = [];
            $qsalas = "SELECT * FROM `room`";
            $result = $db-> query($qsalas);
            while( $datos= $result -> fetch_assoc()){
                $salas[] = new Room($datos);
            }
            return $salas;
        }
    }

    public static function getCountRooms(){
        $db = Conectar::conexion();
        if(!$db){
            $error = "No se ha podido conectar a la base de datos";
        }
        else{
            $totalrooms = $db->query("SELECT COUNT(*) as cuenta FROM room")->fetch_assoc()['cuenta'];
            return ceil((int)$totalrooms);
        }   
    }

    public static function getRoomById($id){
		$db=Conectar::conexion();
		$result= $db->query("SELECT * FROM room WHERE id= ".$id);
		if($datos=$result->fetch_assoc()){
			$room = new Room($datos);
		}
		return $room;
	}
    public static function newRoom($name){
        $db= Conectar::conexion();
        $q="INSERT INTO room VALUES ('NULL','0','".$name."')";
        if($result = $db->query($q)){
            return true;
        }         
        return false; 
    }

    public static function editRoom($id,$privated,$name){
        $db= Conectar::conexion();
        $q="UPDATE `room` SET `id`='".$id."',`name`='".$name."',`privated`='".$privated."' WHERE id='".$id."'";
        if($result = $db->query($q)){
            return true;
        }         
        return false;
    }
    public static function deleteRoom($id){
        $db = Conectar::conexion();
        if(!$db){
            $error = "No se ha podido conectar a la base de datos";
        }
        else{

            if(RoomRepository::getRoomById($id)->getPrivated()==0){
                $q="UPDATE `room` SET `privated`='1' WHERE id='".$id."'";
            }else{
                $q="UPDATE `room` SET `privated`='0' WHERE id='".$id."'";
            }
            if($result = $db->query($q)){
                return true;
            }else{
               return false; 
            }              
        }
        
    }  
}
?>