<?php 

namespace Mini\Model;

use Mini\Core\Model;

class Personas extends Model 
{
    private $apellidoPersona;
    private $correoPersona;
    private $direccionPersona;
    private $documentoPersona;
    private $nombrePersona;
    private $rol;
    private $telefonoPersona;
    private $tipoDocumento;
    private $estado_persona;
    private $cod_personas;
    private $password;
    private $LugarProfesion;
    private $profesionPersona;
    private $idCursos;
    private $meses;

    public function __SET($attr, $value)
    {
        $this->$attr = $value;
    }

    public function __GET($attr)
    {
        return $this->$attr;
    }


    public function listartipoDocu()
    {
        $sql = "SELECT * FROM tipodocumento";
        $sml= $this->db->prepare($sql);
        $sml->execute();

        return $sml->fetchAll();
    }
   
    public function registrarpersonas()
    {
        $sql = " INSERT INTO personas (tipoDocumento,documentoPersona, nombrePersona, apellidoPersona, telefonoPersona, direccionPersona, correoPersona, rol, password, LugarProfesion, profesionPersona)
                 VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sml=$this->db->prepare($sql);
        $sml->bindParam(1, $this->tipoDocumento);
        $sml->bindParam(2, $this->documentoPersona);
        $sml->bindParam(3, $this->nombrePersona);
        $sml->bindParam(4, $this->apellidoPersona);
        $sml->bindParam(5, $this->telefonoPersona);
        $sml->bindParam(6, $this->direccionPersona);
        $sml->bindParam(7, $this->correoPersona);
        $sml->bindParam(8, $this->rol);
        $sml->bindParam(9, $this->password);
        $sml->bindParam(10, $this->LugarProfesion);
        $sml->bindParam(11, $this->profesionPersona);


        return $sml->execute();
    }

    public function editarPersonas()
    {
        $sql= " SELECT * FROM personas WHERE cod_personas = ? ";
        $sml= $this->db->prepare($sql);
        $sml->bindParam(1, $this->cod_personas);
        $sml->execute();

        return $sml->fetch();
    }


    public function modificarPersona()
    {
        $sql = " UPDATE personas SET nombrePersona= ?,apellidoPersona= ?, telefonoPersona= ?,direccionPersona= ?,correoPersona= ?, LugarProfesion= ?, profesionPersona = ? WHERE cod_personas= ?";
        $sml=$this->db->prepare($sql);
        $sml->bindParam(1, $this->nombrePersona);
        $sml->bindParam(2, $this->apellidoPersona);
        $sml->bindParam(3, $this->telefonoPersona);
        $sml->bindParam(4, $this->direccionPersona);
        $sml->bindParam(5, $this->correoPersona);
        $sml->bindParam(6, $this->LugarProfesion);
        $sml->bindParam(7, $this->profesionPersona);
        $sml->bindParam(8, $this->cod_personas);

        return $sml->execute(); 
    }

    public function listarPersonas()
    {
        $sql= "SELECT p.cod_personas, p.documentoPersona, t.nombreTipoDocumento AS tipoDocumento, p.nombrePersona, p.apellidoPersona, p.telefonoPersona, p.direccionPersona, p.correoPersona, r.nombreRol AS rol, p.estado_persona 
        FROM personas AS p INNER JOIN tipodocumento t ON p.tipoDocumento = t.idtipoDocumento INNER JOIN roles r ON p.rol = r.id WHERE r.id=2";
        $sml= $this->db->prepare($sql);
        $sml->execute();

        return $sml->fetchAll();
    }

    public function listarAdmin()
    {
        $sql= "SELECT p.cod_personas, p.documentoPersona, t.nombreTipoDocumento AS tipoDocumento, p.nombrePersona, p.apellidoPersona, p.telefonoPersona, p.direccionPersona, p.correoPersona, r.nombreRol AS rol, p.estado_persona 
        FROM personas AS p INNER JOIN tipodocumento t ON p.tipoDocumento = t.idtipoDocumento INNER JOIN roles r ON p.rol = r.id WHERE r.id=1";
        $sml= $this->db->prepare($sql);
        $sml->execute();

        return $sml->fetchAll();
    }

    public function cambiarEstadoPersonaS()
    {
        
        $sql ="CALL cambiarEstadoPersona (?, ?) ";
        $sml= $this->db->prepare($sql);
        $sml->bindParam(1, $this->cod_personas);
        $sml->bindParam(2, $this->estado_persona);
        
        return $sml->execute();
        
        
    }
    public function cambiarEstadoPersona()
    {
        
        $sql ="UPDATE personas SET estado_persona = ? WHERE cod_personas= ? ";
        $sml= $this->db->prepare($sql);
        $sml->bindParam(1, $this->estado_persona);
        $sml->bindParam(2, $this->cod_personas);
        
        return $sml->execute();
        
        
    }


    //Interesados
    public function completarPersona()
    {
        
        $sql = " UPDATE personas SET documentoPersona = ?, tipoDocumento = ?, nombrePersona= ?, apellidoPersona= ?, telefonoPersona= ?,direccionPersona= ?, LugarProfesion=? WHERE cod_personas= ?";
        $sml=$this->db->prepare($sql);
        $sml->bindParam(1, $this->documentoPersona);
        $sml->bindParam(2, $this->tipoDocumento);
        $sml->bindParam(3, $this->nombrePersona);
        $sml->bindParam(4, $this->apellidoPersona);
        $sml->bindParam(5, $this->telefonoPersona);
        $sml->bindParam(6, $this->direccionPersona);
        $sml->bindParam(7, $this->LugarProfesion);
        $sml->bindParam(8, $this->cod_personas);
        
        return $sml->execute(); 
    }

    public function searchWithEmail()
    {
        $sql = "SELECT p.cod_personas, p.documentoPersona, p.tipoDocumento, p.nombrePersona, p.apellidoPersona, p.telefonoPersona, p.direccionPersona, p.LugarProfesion, pf.nombreProfesion FROM personas AS p JOIN profesiones AS pf ON p.profesionPersona = pf.idProfesion WHERE cod_personas = ?";
        $sml= $this->db->prepare($sql);
        $sml->bindParam(1, $this->cod_personas);
        $sml->execute();
        return $sml->fetch();
    }

    // busqueda de los cursos de cada aprendiz
    public function misCursos(){

        $sql="SELECT c.nombreCurso,c.encargadoCurso,c.fechaInicio,c.fechaFin from personas p join cursos_has_personas cp on (p.cod_personas=cp.Personas_codPersona) JOIN cursos c on(cp.Cursos_idCursos=c.idCursos) where p.cod_personas =?";
        $sml=$this->db->prepare($sql);
        $sml->bindParam(1, $this->cod_personas);
        $sml->execute();
        return $sml->fetchAll();
    }
    
    public function cursosPersona()
    {
        $sql = "SELECT distinct(c.nombreCurso),c.idCursos, cp.Personas_codPersona FROM cursos_has_personas cp JOIN cursos c ON (cp.Cursos_idCursos=c.idCursos) WHERE Personas_codPersona = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->cod_personas);
        $query->execute();

        return $query->fetchAll();
    }

    public function buscarpersonas()
    {
        $sql="SELECT cod_personas, nombrePersona, apellidoPersona, correoPersona FROM personas WHERE documentoPersona= ? AND tipoDocumento= ?";
        $sml=$this->db->prepare($sql);
        $sml->bindParam(1, $this->documentoPersona);
        $sml->bindParam(2, $this->tipoDocumento);
        $sml->execute();
        
        return $sml->fetchAll();
    }
    
    public function validacionCorreo(){
        $sql = "SELECT COUNT(*) as cantidad from personas p where p.correoPersona=?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1,$this->correoPersona);
        $query->execute();
        return $query->fetch();
    }

    public function supender() {

        $sql="Call InsertarSanciones (?,?)";
        $query= $this->db->prepare ($sql);
        $query->bindParam(1,$this->cod_personas);
        $query->bindParam(2,$this->meses); 

        return $query->execute();
    }

    public function listarSuspendidos(){


        $sql="SELECT td.nombreTipoDocumento,p.documentoPersona,p.nombrePersona,p.apellidoPersona,p.correoPersona,p.lugarProfesion,pr.nombreProfesion,s.fechaInicio,s.fechaFin FROM personas p JOIN tipodocumento td ON (p.tipoDocumento=td.idtipoDocumento) JOIN profesiones pr ON (p.profesionPersona=pr.idProfesion) JOIN sanciones s ON(s.persona=p.cod_personas)";
        $sml= $this->db->prepare($sql);
        $sml->execute();
        return $sml->fetchAll();

    }

    public function getAllProfessions()
    {
        $sql = "SELECT idProfesion, nombreProfesion FROM profesiones";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
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