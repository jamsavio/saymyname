<html>
<head>
<title>NAE</title>
</head>

<h3>Converter pdf para csv e extrair nomes</h3>
<form action="#" method="POST" enctype="multipart/form-data">
<input type="file" name="arquivo">
<input type="submit" value="Enviar">
</form>

<?php
   ini_set('max_execution_time', 0);
   if(isset($_FILES['arquivo']))
   {
      $ext = strtolower(substr($_FILES['arquivo']['name'],-4));
      if($ext==".pdf"){
      		$new_name = "arquivo_nao_tratado" . $ext; //Definindo um novo nome para o arquivo
     	 	$dir = 'uploads/'; //Diretório para uploads

      		move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

		$resultado = system("/var/www/html/nae/Programa_feito/main.py /var/www/html/nae/uploads/arquivo_nao_tratado.pdf");
		//$test = system("whoami");
		//echo $test;
		if(isset($resultado)){
			echo "<a href='/nomes_extraidos.csv'>Clique aqui para baixar o csv</a>";
		}else{
			echo "Não foi possível converter o arquivo.";
		}
      }else{
	echo "<script>javascript:alert('Somente arquivo pdf é permitido.')</script>";
      }
   }
?>
<br><br><br>
<a href="nae/compare.php">Comparar planilhas</a>
</html>
