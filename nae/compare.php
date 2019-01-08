<html>
<head>
<title>NAE</title>
</head>

<h3>Comparar planilhas</h3>
<form action="#" method="POST" enctype="multipart/form-data">
<table>
<tr><td><b>Planilha do nae:</b></td><td><input type="file" name="planilha_nae"></td></tr>
<tr><td><b>Planilha do nti:</b></td><td><input type="file" name="planilha_nti"></td></tr>
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
	echo "<script>javascript:alert('Para a lista  do nae somente arquivo xlsx é permitido.')</script>";
      }
   }

  if(isset($_FILES['planilha_nti']))
   {
     $ext = strtolower(substr($_FILES['planilha_nti']['name'],-4));
     if($ext==".csv" || $ext==""){
      		$new_name = "planilha_nti" . $ext; //Definindo um novo nome para o arquivo
     	 	$dir = 'uploads/'; //Diretório para uploads
      		move_uploaded_file($_FILES['planilha_nti']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
     }else{
		echo "<script>javascript:alert('Para a lista do nti somente arquivo csv é permitido.')</script>";
     }
   }

   $aba = "";
   if($_POST['aba']=="Outro"){
   	$aba=$_POST['aba_esp'];
   }else{
   	$aba=$_POST['aba'];
   }

//echo "entrou aqui";
$resultado1 = system("/var/www/html/nae/Programa_feito/compare.py /var/www/html/nae/uploads/planilha_nae.xlsx /var/www/html/nae/uploads/planilha_nti.csv ".$aba);
?>
<br><br><br>
<a href="/nae">Converter pdf para csv</a>
</html>
