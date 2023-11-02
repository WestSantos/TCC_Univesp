<?php

$con= new MySQLi('localhost', 'root', '', 'bd_relatorio');
if($con->connect_error){
	echo "Desconectado! Erro: " . $con->connect_error;
}else{
	echo "Conectado!";
}

?>
