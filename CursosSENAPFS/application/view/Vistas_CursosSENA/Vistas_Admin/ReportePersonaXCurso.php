
<?php 


$html ='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <main>
      <div id="example1">
      <h2 ></h2><br><br><br><br><br><br>
      <h2 id="curso">'.$respuestaInforme->nombreCurso.'</h2><br>
      <div id="ex1">';
      foreach($trae as $value):
        $html.='<p>
        El curso <b>'.$value->nombreCurso.'</b> tiene una duración de <b>'.$value->cantidadHoras.'</b> horas, este inicia <b>'. $value->fechaInicio.'</b> y finaliza <b>'. $value->fechaFin.'</b>
        es perteneciente a la categoría <b>'. $value->nombreCategoria.'</b>. La persona encargada del curso mencionado es el Sr (a) <b>'. $value->encargadoCurso .'</b>, a continuación podrá encontrar las personas pre-Inscritas en el curso:</p>';
     
      endforeach;
        $html.='<table>
        <thead>
        <tr>
          <th>Documento persona</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Teléfono</th>
          <th>Profesión</th>
          <th>Correo</th>
        </tr>
        </thead>
        <tbody>';
         foreach ($resultado as $key => $value):
            $html.='<tr>
            <td>'.$value->documentoPersona.'</td>
            <td>'.$value->nombrePersona.'</td>
            <td>'.$value->apellidoPersona.'</td>
            <td>'.$value->telefonoPersona.'</td>
            <td>'.$value->nombreProfesion.'</td>
            <td>'.$value->correoPersona.'</td>
            </tr>';
        endforeach;
        $html.='</tbody>
        </table>
       
        <br>
        <div class="date">Fecha y hora de descarga:  '. date("Y-m-d / H:i:s ",time()-25200).'</div>
       
        </body>
</html>  
';

$stylesheet= '@font-face {
    font-family: arial;
    font-size: medium;
    src: url(SourceSansPro-Regular.ttf);
  }
  #ex1{
    padding-top: -20%;
    text-align: justify;
  }
  #text{
    text-align: justify;
    text-justify: inter-word;
  }

  table{
    width:100%;
    padding-top: 20%;
    padding-bottom: 20%;
    border:20%;
    font
 
  }

  #example1 {
    width: 100%;
    height: 100%;
    padding: 25px;
    background: url('.URL.'img/HojaInforme.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
}
th, td {
  width: 25%;
  text-align: left;
  vertical-align: top;
  border: 1px solid #000;
  border-collapse: collapse;
}

th {
  background: #eee;
}
  ';
 
                                                     
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8'], ['format' => 'utf-8'], [123300, 123300]);
$mpdf->SetTitle('Reporte cursos');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output();
// $mpdf->Output('filename.pdf','D');

?>