<?php
namespace Mini\Model;

use Mini\Core\Model;

class Preguntas extends Model
{  
    private $idPregunta;
    private $descripcionPregunta;
    private $respuestaPregunta;
    private $idUser;
    private $Estado;

    public function __SET($attr, $value)
    {
        $this->$attr = $value;
    }

    public function __GET($attr)
    {
        return $this->$attr;
    }

    public function addQuestions()
    {
        $sql = "INSERT INTO preguntas (descripcionPregunta, respuestaPregunta, idUser) VALUES (?,?,?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->descripcionPregunta);
        $query->bindParam(2, $this->respuestaPregunta);
        $query->bindParam(3, $this->idUser);

        $query->execute();
    }

    public function getQuestion()
    {
        $sql = "SELECT idPregunta, descripcionPregunta, respuestaPregunta, idUser FROM preguntas WHERE idPregunta = ? ORDER BY idPregunta DESC ";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idPregunta);
        $query->execute();

        return $query->fetch();
    }

    // método de preguntas frecuentes y responder
    public function updateQuestions()
    {
        $sql = "UPDATE preguntas SET descripcionPregunta = ?, respuestaPregunta = ? , Estado= ? WHERE idPregunta = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->descripcionPregunta);
        $query->bindParam(2, $this->respuestaPregunta);
        $query->bindParam(3, $this->Estado);
        $query->bindParam(4, $this->idPregunta);

        return $query->execute();
    }


    public function deleteQuestion()
    {
        $sql = "DELETE FROM preguntas WHERE idPregunta = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idPregunta);

        return $query->execute();
    }

    public function showQuestions()
    {
        $sql = "SELECT P.idPregunta, P.descripcionPregunta, P.respuestaPregunta, P.idUser FROM preguntas AS P INNER JOIN personas AS PER ON P.idUser = PER.cod_personas INNER JOIN roles AS R ON PER.rol = R.id WHERE R.id=1 ORDER BY idPregunta DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function showQuestion()
    {
        $sql = "SELECT P.idPregunta, P.descripcionPregunta, T.nombreTipoDocumento, PER.documentoPersona, PER.nombrePersona, PER.apellidoPersona, P.idUser, NOW() AS Fecha FROM preguntas AS P INNER JOIN personas AS PER ON P.idUser = PER.cod_personas INNER JOIN roles AS R ON PER.rol = R.id INNER JOIN tipodocumento AS T ON PER.tipoDocumento = T.idtipoDocumento WHERE R.id=2 AND P.Estado= 'Activo' ORDER BY idPregunta DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


    public function doQuestionA()
    {
        $sql= "INSERT INTO preguntas(descripcionPregunta, idUser) VALUES (?, ?)";
        $sml= $this->db->prepare($sql);
        $sml->bindParam(1, $this->descripcionPregunta);
        $sml->bindParam(2, $this->idUser);

        $sml-> execute();

    }

    public function MyAnswer()
    {
        $sql= "SELECT idPregunta, descripcionPregunta, respuestaPregunta, Estado FROM preguntas WHERE idUser=? AND respuestaPregunta <>''  AND Estado = 'Inactivo' ORDER BY idPregunta DESC";
        $sml= $this->db->prepare($sql);
        $sml->bindParam(1, $this->idUser);
        $sml->execute();

        return $sml->fetchAll();
    }

    public function deleteAnswers()
    {
        $sql= "DELETE FROM preguntas WHERE idPregunta= ?";
        $sml= $this->db->prepare($sql);
        $sml->bindParam(1, $this->idPregunta);

        return $sml->execute();

    }

}