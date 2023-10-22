<?php
include_once('conexao.php');

	if(isset($_POST['submit'])){
		$data = $_POST['datahora'];
		$reportado = $_POST['report'];
		$empresa = $_POST['empresa'];
		$setor = $_POST['setor'];
		$projeto = $_POST['project'];
		$situacao = $_POST['situacao'];
		$sugestao = $_POST['sugestao'];
		$anexo1 = $_POST['anx1'];
		$anexo2 = $_POST['anx2'];
		$anexo3 = $_POST['anx3'];
	}


	$sql = "INSERT INTO relatorio (data, reportado, empresa, setor, projeto, situacao, sugestao, anexo1, anexo2, anexo3) VALUES ('$data', '$reportado', '$empresa', '$setor', '$projeto', '$situacao', '$sugestao', '$anexo1', '$anexo2', '$anexo3')";

	if(mysqli_query($con, $sql)){
		echo "  Cadastro feito";
		}
	
	mysqli_close($con);

?>