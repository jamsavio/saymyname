<html>
<head>
<title>NAE</title>
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.26/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.26/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.26/js/uikit-icons.min.js"></script>
</head>

<body>
<div class="uk-position-center">
<h1 class="uk-heading-bullet"><span uk-icon="icon: info; ratio: 2; font-width: 5px"></span>&nbsp;<span style="font-family: Segoe UI">saymy</span><b>name</b></h1>
<h3>Comparar planilhas</h3>
<form action="#" method="POST" enctype="multipart/form-data">
<table class="uk-table uk-table-small">
<tbody>
<tr><td><b>Planilha do NAE:</b></td><td><input type="file" name="planilha_nae"></td></tr>
<tr><td><b>Planilha do NTI:</b></td><td><input type="file" name="planilha_nti"></td></tr>
<tr>
<td>
<select name="aba">
    <option value="BPG">BPG</option>
    <option value="Moradia">Moradia</option>
    <option value="Alimentação">Alimentação</option>
    <option value="Outro">Outro</option>
</select>
</td>
<td>
<input type="text" name="aba_esp" placeholder="Especifique">
</td>
</tr>
</tbody>
<tr><td><br><input type="submit" value="Enviar"></td></tr>
</table>
</form>

<?php
   $resultado0 = shell_exec('rm /var/www/html/nae/uploads/*');
   ini_set('max_execution_time', 0);
   if(isset($_FILES['planilha_nae']))
   {
      $ext = strtolower(substr($_FILES['planilha_nae']['name'],-5));
      if($ext==".xlsx"){
      		$new_name = "planilha_nae" . $ext; //Definindo um novo nome para o arquivo
     	 	$dir = 'uploads/'; //Diretório para uploads

      		move_uploaded_file($_FILES['planilha_nae']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
      }else{
	echo '<div class="uk-alert-danger" uk-alert>Para a lista do nae somente arquivo xlsx é permitido.</div>';
      }
   }

  if(isset($_FILES['planilha_nti']))
   {
     $ext = strtolower(substr($_FILES['planilha_nti']['name'],-4));
     if($ext==".csv"){
      		$new_name = "planilha_nti" . $ext; //Definindo um novo nome para o arquivo
     	 	$dir = 'uploads/'; //Diretório para uploads
      		move_uploaded_file($_FILES['planilha_nti']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
     }else{
		echo '<div class="uk-alert-danger" uk-alert>Para a lista do nti somente arquivo csv é permitido.</div>';
     }
   }

   $aba = "";
   if($_POST['aba']=="Outro"){
	if($_POST['aba_esp']!=""){
   		$aba=$_POST['aba_esp'];
	}else{
		echo '<div class="uk-alert-danger" uk-alert>Especifique o tipo da bolsa.</div>';
	}
   }else{
   	$aba=$_POST['aba'];
   }

//echo "entrou aqui";
$resultado1 = shell_exec("/var/www/html/nae/Programa_feito/compare.py /var/www/html/nae/uploads/planilha_nae.xlsx /var/www/html/nae/uploads/planilha_nti.csv ".$aba);
echo $resultado1;
?>
<br><br>

<a href="/nae">Converter pdf para csv</a>
</div>
</body>
</html>
