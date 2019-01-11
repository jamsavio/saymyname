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
<h3>Converter pdf para csv e extrair o nome dos discentes</h3>
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
			echo '<div class="uk-alert-primary" uk-alert><a href="nae/nomes_extraidos.csv"><span uk-icon="download">Baixar o arquivo gerado</span></a></div>';
		}else{
			echo '<div class="uk-alert-danger" uk-alert>Não foi possível converter o arquivo.</div>';
		}
      }else{
	echo '<div class="uk-alert-danger" uk-alert>Somente arquivo pdf é permitido.</div>';
      }
   }
?>
<br><br><br>
<a href="nae/compare.php">Comparar planilhas</a>
</div>
</body>
</html>
