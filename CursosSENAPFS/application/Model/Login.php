<?php

namespace Mini\Model;

use Mini\Core\Model;

class Login extends Model{

    private $apellidoPersona;
    private $cod_personas;
    private $correoPersona;
    private $nombrePersona;
    private $password;
    private $rol;
    private $estado_persona;
    private $tipoDocumento;
    private $documentoPersona;
    private $profesionPersona;

    public function __SET($attr, $value)
    {
        $this->$attr=$value;
    }

    public function __GET($attr)
    {
        return $this->$attr;
    }

    public function validarLogin()
    {
        $sql= "SELECT p.cod_personas, p.rol, p.nombrePersona,p.password, p.apellidoPersona, r.nombreRol, p.estado_persona, p.profesionPersona, p.correoPersona FROM personas p JOIN roles r ON (p.rol=r.id) WHERE correoPersona= ?";
        $sml= $this->db->prepare($sql);
        $sml->bindParam(1, $this->correoPersona);
        $sml->execute();

        return $sml->fetch();
    }

    public function registrarUsuarios()
    {
        $sql= "INSERT INTO personas (nombrePersona, apellidoPersona, correoPersona, password, rol, documentoPersona, tipoDocumento, LugarProfesion, profesionPersona) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ";
        $sml= $this->db->prepare($sql);
        $sml->bindParam(1, $this->nombrePersona);
        $sml->bindParam(2, $this->apellidoPersona);
        $sml->bindParam(3, $this->correoPersona);
        $sml->bindParam(4, $this->password);
        $sml->bindParam(5, $this->rol);
        $sml->bindParam(6, $this->documentoPersona);
        $sml->bindParam(7, $this->tipoDocumento);
        $sml->bindParam(8, $this->LugarProfesion);
        $sml->bindParam(9, $this->profesionPersona);

        return $sml->execute();
    }

    public function changePassword()
    {
        $sql="UPDATE personas SET password = ? WHERE cod_personas = ? ";
        $sml=$this->db->prepare($sql);
        $sml->bindParam(1, $this->password);
        $sml->bindParam(2, $this->cod_personas);

        return $sml->execute();
    }

    public function searchPasssword()
    {
        $sql="SELECT * FROM personas WHERE cod_personas = ?";
        $sml=$this->db->prepare($sql);
        $sml->bindParam(1, $this->cod_personas);
        $sml->execute();
        
        return $sml->fetch();
    }
  
    public function getAllProfessions()
    {
        $sql = "SELECT idProfesion, nombreProfesion FROM profesiones";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
   
    public function validacionCorreo(){
        $sql = "SELECT COUNT(*) as cantidad from personas p where p.correoPersona= ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1,$this->correoPersona);
        $query->execute();
        return $query->fetch();
    }

    public function recoverPassword()
    {
        $sql = "SELECT * FROM personas WHERE correoPersona = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->correoPersona);
        $query->execute();

        return $query->fetch();
    }

    public function traerEstadoYRol(){
        $sql ="SELECT p.estado_persona as estado, r.id as rol from personas p JOIN roles r ON (p.rol=r.id ) where p.correoPersona=?";
        $query=$this->db->prepare($sql);
        $query->bindParam(1,$this->correoPersona);
        $query->execute();

        
        return $query->fetch();

    }

    public function documentoXtipodocumento()
    {
        
        $sql = "SELECT COUNT(*) as resuldo FROM personas p JOIN tipodocumento td ON (p.tipoDocumento=td.idtipoDocumento) WHERE p.documentoPersona=? AND td.idtipoDocumento=?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->documentoPersona);
        $query->bindParam(2, $this->tipoDocumento);
        $query->execute();


        return $query->fetch();
    }




}

