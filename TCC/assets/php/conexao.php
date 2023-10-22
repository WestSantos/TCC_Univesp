<?php
// 	$dbHost = "localhost";
// 	$dbName = "bd_relatorio";
// 	$dbUsername = "root";
// 	$dbPassword = "";
	
	
// 	$con = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);



// if(!$con){
// 	die("ERRO: ".mysqli_connect_error());
// }
$con= new MySQLi('localhost', 'root', '', 'bd_relatorio');
if($con->connect_error){
	echo "Desconectado! Erro: " . $con->connect_error;
}else{
	echo "Conectado!";
}

// $sql = "INSERT INTO relatorio(datahora, report, empresa, setor, project, situacao, sugestao, anx1, anx2, anx3) VALUES ('$data', '$reportado', '$empresa', '$setor', '$projeto', '$situacao', '$sugestao', '$anexo1', '$anexo2', '$anexo3')";




?>
