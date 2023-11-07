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
    $anexo1 = mysqli_real_escape_string($con, file_get_contents($_FILES['anx1']['tmp_name']));
    $anexo2 = mysqli_real_escape_string($con, file_get_contents($_FILES['anx2']['tmp_name']));
    $anexo3 = mysqli_real_escape_string($con, file_get_contents($_FILES['anx3']['tmp_name']));


    $sql = "INSERT INTO relatorio (datah, reportado, empresa, setor, projeto, situacao, sugestao, anexo1, anexo2, anexo3) VALUES ('$data', '$reportado', '$empresa', '$setor', '$projeto', '$situacao', '$sugestao', '$anexo1', '$anexo2', '$anexo3')";

    if(mysqli_query($con, $sql)){
        echo "Cadastro feito";
    } else {
        echo "Erro ao inserir dados: " . mysqli_error($con);
    }

    

	$sqlpdf ="SELECT * FROM relatorio ORDER BY id DESC LIMIT 1";
    $res = $con->query($sqlpdf);

    if($res->num_rows > 0){
        $row = $res->fetch_object();

    
        $anexo1_base64 = base64_encode($row->anexo1);
        $anexo2_base64 = base64_encode($row->anexo2);
        $anexo3_base64 = base64_encode($row->anexo3);

        $html = "<style>" . file_get_contents('../CSS/style.css') . "</style>";
        
      
        $html .= "<h3 class='titlerel'>Relatorio Segurança do Trabalho</h3>";
        $html .= "<br>";
        $html .= "<div class='dv1'>";

        $html .= "<p><b>Reportado por: </b>".$row->reportado."</p>";
        $html .= "</div><div class='espaco'></div><div class='dv2'>";
        $html .= "<p><b>Data e Hora: </b>".$row->datah."</p>";
        $html .= "</div>";

        $html .= "<p><b>Empresa: </b>".$row->empresa."</p>";
        $html .= "<p><b>Setor: </b>".$row->setor."</p>";
        $html .= "<p><b>Nome do Projeto: </b>".$row->projeto."</p>";

      
       
        $html .= "<p><b>Descreva a situação: </b></p><p>".$row->situacao."</p>";
       
        $html .= "<p><b>Sugestão: </b></p><p>".$row->sugestao."</p>";

        $html .="<br>";
       
        $html .="<div class='acao'>";
        $html .="<p><b>Ação Necessária: </b></p>";
        $html .="<br>";
        $html .="<br>";
        $html .="<br>";
        $html .="<br>";
        $html .="<br>";
        $html .="</div>";
        $html .="<br>";

        $html .="<div class='divresp'>";
        $html .="<p class='resp1'><b>Responsáveis pelas medidas: </b>";
        $html .="<br>";
        $html .="<br>";
        $html .="<br>";
        $html .="</div><div class='divresp'>";
        $html .="<p class='resp1'><b>Prazos para as medidas: </b>";
        $html .="<br>";
        $html .="<br>";
        $html .="<br>";
        $html .="</div>";
        $html .="<p><b>Verificação do êxito da implementação: 
        </b><br><br><br><br><br>
        </p>";
        $html .="<br>";
        $html .="<p class='resp2'><b>Número do Relatório: </b></p>";
        $html .="<p class='resp2'><b>Data do Fechamento: </b></p>";
        $html .="<br>";
        $html .="<br>";
        $html .="<p class='resp2'><b>Fechado por: <br><br></b></p>";
        $html .="<p class='resp2'><b>Assinatura: <br><br></b></p>";
      
        

        $html .="<br>";
        $html .="<br>";
        $html .="<br>";
        $html .="<h3>Imagens tiradas no Local</h3>";
        $html .= "<h4>Anexo 01:</h4>";
        $html .= "<img src='data:image/jpeg;base64," . $anexo1_base64 . "' width='45%'>";
        $html .="<br>";
        $html .= "<h4>Anexo 02:</h4>";
        $html .= "<img src='data:image/jpeg;base64," . $anexo2_base64 . "' width='45%'>";
        $html .="<br>";
        $html .= "<h4>Anexo 03:</h4>";
        $html .= "<img src='data:image/jpeg;base64," . $anexo3_base64 . "' width='45%'>";

     
        include_once('dompdf/autoload.inc.php');
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->set_option('defaultFont', 'sans');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    } else {
        print 'Nenhum Dado Registrado';
    }

    mysqli_close($con);
}

?>