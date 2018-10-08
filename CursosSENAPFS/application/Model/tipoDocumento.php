<?php

namespace Mini\Model;

use Mini\Core\Model;


class tipoDocumento extends Model{


private $id;
private $td;


public function __SET($attr,$value){

    $this->$attr=$value;

}public function __GET($attr){

    return $this->$attr;

}
 public function guardar(){
     
$sql="INSERT INTO tipodocumento (nombreTipoDocumento) VALUES (?)";
$stm=$this->db->prepare($sql);
$stm->bindParam(1,$this->td);
return $stm->execute();
 
}

public function listar(){

    $sql="SELECT idtipoDocumento,nombreTipoDocumento FROM tipodocumento";
    $stm=$this->db->prepare($sql);
    $stm->execute();

    return $stm->fetchAll();

}

public function consultar(){
    $sql ="SELECT idtipoDocumento,nombreTipoDocumento FROM tipodocumento WHERE idtipoDocumento=?";
    $stm=$this->db->prepare($sql);
    $stm->bindParam(1,$this->id);
    $stm->execute();

    return $stm->fetch();
}

public function modificar(){

    $sql= "UPDATE tipodocumento SET nombreTipoDocumento=? where idTipoDocumento = ?";
    $stm = $this->db->prepare($sql);
    $stm ->bindParam(1,$this->td);
    $stm->bindParam(2,$this->id);

    return $stm->execute();
}

public function eliminartd(){
    $sql="DELETE FROM tipodocumento WHERE idtipoDocumento= ?";
    $stm= $this->db->prepare($sql);
    $stm->bindParam(1,$this->id);

    return $stm->execute();
    
}

}



?>