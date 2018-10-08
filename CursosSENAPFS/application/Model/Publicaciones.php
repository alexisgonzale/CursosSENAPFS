<?php 

namespace Mini\Model;

use Mini\Core\Model;

class Publicaciones extends Model
{
    private $idPublicacion;
    private $tituloPublicacion;
    private $descripcionPublicacion;
    private $fechaPublicacion;
    private $idCurso;
    private $codPersona;
    private $Cursos_idCursos;
    private $Personas_codPersona;
    private $img;
    private $requisitosCurso;
    private $distribucionHoraria;
    private $Estado;

    public function __SET($attr, $value)
    {
        $this->$attr = $value;
    }

    public function addPublication()
    {
        $sql = "INSERT INTO publicaciones (tituloPublicacion, descripcionPublicacion, idCurso, distribucionHoraria, requisitosCurso, img) VALUES (?,?,?,?,?,?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->tituloPublicacion);
        $query->bindParam(2, $this->descripcionPublicacion);
        $query->bindParam(3, $this->idCurso);
        $query->bindParam(4, $this->distribucionHoraria);
        $query->bindParam(5, $this->requisitosCurso);
        $query->bindParam(6, $this->img);

        return $query->execute();

    }

    public function getAllPublicaciones()
    {
        $sql = "SELECT p.idPublicacion, p.descripcionPublicacion, p.tituloPublicacion, c.nombreCurso,c.idCursos, p.distribucionHoraria, p.requisitosCurso, img, Estado FROM publicaciones p INNER JOIN cursos c ON p.idCurso = c.idCursos WHERE p.Estado= 'Activo'";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idCurso);
        $query->execute();

         return $query->fetchAll();
    }
    public function getAllPublicaciones2()
    {
        $sql = "SELECT p.idPublicacion, p.descripcionPublicacion, p.tituloPublicacion, c.nombreCurso,c.idCursos, p.distribucionHoraria, p.requisitosCurso, img, Estado FROM publicaciones p INNER JOIN cursos c ON p.idCurso = c.idCursos WHERE p.Estado= 'Activo' AND c.idCursos = ? ";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idCurso);
        $query->execute();

         return $query->fetchAll();
    }
    public function getAllPublicacionesListar()
    {
        $sql = "SELECT p.idPublicacion, p.descripcionPublicacion, p.tituloPublicacion, c.nombreCurso,c.idCursos, p.distribucionHoraria, p.requisitosCurso, img, Estado FROM publicaciones p INNER JOIN cursos c ON p.idCurso = c.idCursos";
        $query = $this->db->prepare($sql);
        $query->execute();

         return $query->fetchAll();
    }

    public function getPublication()
    {
        $sql = "SELECT p.idPublicacion, p.tituloPublicacion, p.requisitosCurso, p.distribucionHoraria, p.descripcionPublicacion, c.idCursos, c.nombreCurso, c.cantidadHoras, c.encargadoCurso, c.cupos, c.fechaInicio, c.fechaFin FROM publicaciones p JOIN cursos c ON(p.idCurso=c.idCursos) WHERE p.idPublicacion = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idPublicacion);
        $query->execute();

        return $query->fetch();
    }

    public function validacion(){
        $sql = " SELECT count(*) as cantidad FROM cursos_has_personas cp WHERE cp.Cursos_idCursos=? AND cp.Personas_codPersona=?";
        $query = $this->db->prepare($sql); 
        $query->bindParam(1, $this->idCurso);
        $query->bindParam(2, $this->codPersona);
        $query->execute();
        return $query->fetch();
    }

    public function registrarCursoPersonas()
    {
        $sql="CALL validate(?,?)";
        $query= $this->db->prepare($sql);
        $query->bindParam(1, $this->codPersona);
        $query->bindParam(2, $this->idCurso);
        

        return  $query->execute();
    }
    
    public function updateCupos(){

        $sql="UPDATE CURSOS SET CUPOS= CUPOS -1 WHERE idCursos=?";
        $query=$this->db->prepare($sql);
        $query->bindParam(1,$this->idCurso);

        return $query->execute();
    }

    public function informeMatricula()
    {

        $sql="SELECT tp.nombreTipoDocumento, p.documentoPersona, p.apellidoPersona, p.nombrePersona, c.nombreCurso,c.fechaInicio, c.fechaFin, c.encargadoCurso,c.cupos FROM personas AS p INNER JOIN tipodocumento tp ON p.tipoDocumento = tp.idtipoDocumento INNER JOIN cursos_has_personas AS cHAS ON P.cod_personas =cHAS.Personas_codPersona INNER JOIN cursos AS c ON cHAS.Cursos_idCursos = c.idCursos WHERE p.cod_personas=? AND C.idCursos=?";
        $query=$this->db->prepare($sql);
        $query->bindParam(1,$this->codPersona);
        $query->bindParam(2,$this->idCurso);
        $query->execute();
        return $query->fetch();
    }

    public function getPublicationn()
    {
        $sql = "SELECT p.idPublicacion, p.tituloPublicacion, p.descripcionPublicacion, p.fechaPublicacion, p.distribucionHoraria, p.requisitosCurso, p.img, c.nombreCurso FROM publicaciones AS p JOIN cursos AS c ON p.idCurso = c.idCursos WHERE idPublicacion = ?";
        $query = $this->db->prepare($sql);  
        $query->bindParam(1, $this->idPublicacion);
        $query->execute();

        return $query->fetch();
    }

    public function updatePublications()
    {
        $sql = "UPDATE publicaciones SET tituloPublicacion = ?, descripcionPublicacion = ?, distribucionHoraria = ?, requisitosCurso = ?, img = ? WHERE idPublicacion = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->tituloPublicacion);
        $query->bindParam(2, $this->descripcionPublicacion);
        $query->bindParam(3, $this->distribucionHoraria);
        $query->bindParam(4, $this->requisitosCurso);
        $query->bindParam(5, $this->img);
        $query->bindParam(6, $this->idPublicacion);
        

        return $query->execute();
    }

    public function deletePublication()
    {
        $sql = "UPDATE publicaciones  SET Estado = ? WHERE idPublicacion = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->Estado);
        $query->bindParam(2, $this->idPublicacion);
        

        return $query->execute();
    }

    public function showWithProfession()
    {
        $sql = "SELECT p.idPublicacion,p.tituloPublicacion,p.img,p.requisitosCurso,p.distribucionHoraria,p.descripcionPublicacion,c.nombreCurso,pro.nombreProfesion from publicaciones p JOIN cursos c ON p.idCurso=c.idCursos JOIN categorias_has_profesiones cp ON c.idCategorias_Has_Profesiones=cp.categoria_id JOIN profesiones pro ON (cp.profesion_id=pro.idProfesion) WHERE pro.idProfesion = ? AND p.Estado = 'Activo' and c.estadoCurso='Activo' GROUP BY p.tituloPublicacion";    
        $query = $this->db->prepare($sql);  
        $query->bindParam(1, $this->profesionPersona);
        $query->execute();
        return $query->fetchAll();
     
    }

    Public function publicaranucios()
    {
        $sql = "UPDATE publicaciones SET Estado= ? WHERE idPublicacion = ? ";
        $sml = $this->db->prepare($sql);
        $sml->bindParam(1, $this->Estado);
        $sml->bindParam(2, $this->idPublicacion);

        return $sml->execute();
    }

    public function eliminarPublicacion(){

    $sql ="SELECT COUNT(*) as cantidad FROM cursos_has_personas cp JOIN cursos c ON (cp.Cursos_idCursos=c.idCursos) JOIN publicaciones p ON (p.idCurso=c.idCursos) WHERE p.idPublicacion=? ";
    $sml=$this->db->prepare($sql);
    $sml->bindParam(1,$this->idPublicacion);
    $sml->execute();
    return $sml->fetch();
    }
    
    public function consultarEstado(){
        $sql="SELECT estado_persona as estado from personas where cod_personas= ?";
        $sml=$this->db->prepare($sql);
        $sml->bindParam(1,$this->codPersona);
        $sml->execute();
        
        return $sml->fetch();

    }
}


    