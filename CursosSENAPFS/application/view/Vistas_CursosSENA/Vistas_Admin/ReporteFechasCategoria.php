<?php 
$html='
<!DOCTYPE html>
<html>
<head>
<header>
  <img src="'.URL.'img/informeAbajo.png">
</header>
<title></title>
</head>
<body>

<h1>Informe de categoría por fechas </h1>
<div class="contable">
  <table class="table table-hover table-bordered" id="sampleTable">
  <thead>
    <tr>
      <th>Curso</th>
      <th>Cupos</th>
      <th>Ofertados</th>
      <th>Sobrantes</th>
      <th>FechaInico</th>
      <th>Fecha fin</th>
      <th>Nombre Categoria</th>
    </tr>
  </thead>
  <tbody>';
  foreach ($uesta as $key => $value): 
      $html.='<tr>
      <td>'.$value->nombreCurso.'</td>
      <td>'.$value->cupos.'</td>
      <td>'.$value->cupos1.'</td>
      <td>'.$value->sobrantes.'</td>
      <td>'.$value->fechaInicio.'</td>
      <td>'.$value->fechaFin.'</td>
      <td>'.$value->nombreCategoria.'</td>
      </tr>';
  endforeach; 
  $html.='</tbody>            
  </table>
</div>

</body>
<br><br><br><br>

<footer>
   <img src="'.URL.'img/informeArriba.png">
</footer>
</html>
';

$stylesheet='
table{
  margin: 0 auto;
  display:block;
}
#sampleTable {
  width: 100px;
}
th, td {
  width: 100%;
  text-align:center;
}
caption {
  padding: 0.3em;
  color: #fff;
   background: #000;
}
th {
  background: #eee;
}
h1{
  text-align:center
}

';


 
                                                     
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8'], ['format' => 'utf-8'], [123300, 123300]);
$mpdf->SetTitle('Reporte cursos');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output();
// $mpdf->Output('filename.pdf','D');

?>