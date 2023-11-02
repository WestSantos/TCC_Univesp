<?php

include_once('conexao.php');


if(isset($_POST['submit'])){
    $data = mysqli_real_escape_string($con, $_POST['datahora']);
	$reportado = mysqli_real_escape_string($con, $_POST['report']);
	$empresa = mysqli_real_escape_string($con, $_POST['empresa']);
	$setor = mysqli_real_escape_string($con, $_POST['setor']);
	$projeto = mysqli_real_escape_string($con, $_POST['project']);
	$situacao = mysqli_real_escape_string($con, $_POST['situacao']);
	$sugestao = mysqli_real_escape_string($con, $_POST['sugestao']);
	$anexo1 = mysqli_real_escape_string($con, $_POST['anx1']);
	$anexo2 = mysqli_real_escape_string($con, $_POST['anx2']);
	$anexo3 = mysqli_real_escape_string($con, $_POST['anx3']);

    $sql = "INSERT INTO relatorio (datah, reportado, empresa, setor, projeto, situacao, sugestao, anexo1, anexo2, anexo3) VALUES ('$data', '$reportado', '$empresa', '$setor', '$projeto', '$situacao', '$sugestao', '$anexo1', '$anexo2', '$anexo3')";

    if(mysqli_query($con, $sql)){
        echo "Cadastro feito";
    } else {
        echo "Erro ao inserir dados: " . mysqli_error($con);
    }

    


$sqlpdf ="SELECT * FROM relatorio";

$res = $con->query($sqlpdf);



if($res->num_rows > 0){

	$html = "<table>";
	while($row = $res->fetch_object()){

		$html .= "<tr>";
		$html .= "<td>".$row->datah."</td>";
		$html .= "<td>".$row->reportado."</td>";
		$html .= "<td>".$row->empresa."</td>";
		$html .= "<td>".$row->setor."</td>";
		$html .= "<td>".$row->projeto."</td>";
		$html .= "<td>".$row->situacao."</td>";
		$html .= "<td>".$row->sugestao."</td>";
		$html .= "<td>".$row->anexo1."</td>";
		$html .= "<td>".$row->anexo2."</td>";
		$html .= "<td>".$row->anexo3."</td>";
		$html .= "</tr>";

	}
	$html .= "</table>";

}else{
	print 'Nenhum Dado Registrado';
}



	include_once ('dompdf/autoload.inc.php');

  
	$dompdf = new Dompdf\Dompdf();

    $dompdf->loadHtml($html);

    $dompdf->set_option('defaultFont', 'sans');

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream();

	mysqli_close($con);
}

?>
