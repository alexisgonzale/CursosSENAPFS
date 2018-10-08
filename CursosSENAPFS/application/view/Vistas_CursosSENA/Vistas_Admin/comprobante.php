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
      <div id="ex1">
      <p id="text">Este documento hace constar que <b>'.$respuestaInforme->nombrePersona.'  '.$respuestaInforme->apellidoPersona.'</b> identificado(a) con 
      <b>'.$respuestaInforme->nombreTipoDocumento.'</b> n° <b>'.$respuestaInforme->documentoPersona.'</b> se encuentra preinscrito en el curso mencionado,el cupo asignado es (<b>'.$respuestaInforme->cupos.'</b>). La fecha de inicio <b>'.$respuestaInforme->fechaInicio.'</b> y fecha de finalización  <b>'.$respuestaInforme->fechaFin.'</b>. Al realizar la preinscripción debe revisar el correo electrónico para culminar la inscripción. Debe presentar este certificado, en formato físico o dígital, el día que se presente en el SENA para finalizar su proceso de inscripción.</p>
      </div>
      </div>
      <div id="imagen">
        <div class="date">Fecha y hora de descarga:  '. date("Y-m-d / H:i:s ",time()-25200).'</div>
          </div>
            </div>
            <table style=" margin-top: 50px;"> 
                                      <tbody>';
    $html.='</main>
  <footer>
    <img src="'.URL.'img/Logo2.png">
  </footer>
  </body>
</html>  
';

$stylesheet= '@font-face {
    font-family: SourceSansPro;
    src: url(SourceSansPro-Regular.ttf);
  }
  #ex1{
    padding: 35px;
  }
  #text{
    text-align: justify;
    text-justify: inter-word;
  }
  #curso{
    text-align: center;
  }
  #example1 {
    width: 100%;
    height: 485px;
    padding: 25px;
    background: url('.URL.'img/Certificado.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
}
  ';
  
$dateDownload = date('Y-m-d-i');
// var_dump($dateDownload); 
// exit;

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
$mpdf->SetTitle('Comprobante de inscripciòn');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output('C:/Users/FS_2017/Downloads/comprobante'.$dateDownload.'.pdf' , F);// cambiar ruta

?>
