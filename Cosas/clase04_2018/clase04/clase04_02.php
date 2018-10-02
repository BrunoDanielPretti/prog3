<?php
	$path = "test.php";
	//$path = "upload_multiple.php";
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="img/utnLogo.png" rel="icon" type="image/png" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Subir archivos múltiples con PHP</title>

	</head>
	<body>
		<form action="<?php echo $path; ?>" method="post" enctype="multipart/form-data" >
			<input type="file" name="archivo[]" multiple accept="image/*"/> 
			<br/>
			<input type="submit" value="Subir" />
		</form>
	</body>
</html>