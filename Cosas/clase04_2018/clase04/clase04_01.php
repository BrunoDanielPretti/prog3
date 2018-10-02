<?php
	$path = "test.php";
	//$path = "upload.php";
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="img/utnLogo.png" rel="icon" type="image/png" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Subir archivos con PHP</title>
	</head>
	<body>
		<form action="<?php echo $path; ?>" method="post" enctype="multipart/form-data" >
			<input type="file" name="archivo" /> 
			<br/>
			<input type="submit" value="Subir" />
		</form>
	</body>
</html>