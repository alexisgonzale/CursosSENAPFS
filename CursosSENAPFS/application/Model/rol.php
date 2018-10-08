<?php


namespace Mini\Model;

use Mini\Core\Model;


class rol extends Model {

private $id;
private $rol;


public function __SET ($attr,$value){

$this->$attr=$value;

}
public function __GET ($attr){

   return $this->$attr;
}

// public function guardar(){

// $sql ="INSERT INTO roles (nombreRol) VALUES (?)";
// $stm = $this->db->prepare($sql);
// $stm->bindParam(1,$this->rol);
// return $stm->execute();
// }

    public function editar(){

        $sql ="SELECT id, nombreRol from roles where id=?";
        $stm=$this->db->prepare($sql);
        $stm->bindParam(1, $this->id);
        $stm->execute();
        return $stm->fetch();
    
    }
    
    public function listar(){
    
        $sql ="SELECT id, nombreRol from roles";
        $stm=$this->db->prepare($sql);
        $stm->execute();
        
        return $stm->fetchAll();


}


    public function modificar(){

        $sql ="UPDATE roles SET nombreRol = ? WHERE id = ? ";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(1,$this->rol);
        $stm->bindParam(2,$this->id);
        return $stm->execute();
    }
    
    // public function eliminarRol(){

    //     $sql="DELETE FROM roles WHERE id=?";
    //     $stm=$this->db->prepare($sql);
    //     $stm->bindParam(1,$this->id);
    //     return $stm->execute();
    // }

}






?>