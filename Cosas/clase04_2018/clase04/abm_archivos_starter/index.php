<?php
require_once("clases\producto.php");
$tituloVentana = "PRODUCTOS - con archivos y AJAX -";
?>
<!doctype html>
<html>
<head>
	<title> <?php echo $tituloVentana; ?> </title>
	  
	<link href="./img/utnLogo.png" rel="icon" type="image/png" />

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="animacion.css">		
	<link rel="stylesheet" type="text/css" href="estilo.css">

	<script type="text/javascript" src="./JavaScript/ajax.js"></script>
	<script type="text/javascript" src="./JavaScript/app.js"></script>
		
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1>PRODUCTOS</h1>      
		</div>
		<div class="CajaInicio animated bounceInRight" style="width:1100px">
			<h1>Ejemplo ABM-LISTADO - con archivos y AJAX - </h1>
			<table>
				<tbody>
					<tr>
						<td width="50%">
							<div id="divFrm" style="height:350px;overflow:auto;margin-top:20px">
								<form id="frm" enctype="multipart/form-data" >
									<input type="text" name="codBarra" id="codBarra" placeholder="Ingrese c&oacute;digo de barras" />
									<input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre" />
									<input type="file" name="archivo" id="archivo" /> 
									
									<input type="button" class="MiBotonUTN" onclick="Main.AgregarProducto()" value="Guardar"  />
									<input type="hidden" id="hdnQueHago" name="queHago" value="agregar" />
								</form>
							</div>
						</td>
						<td rowspan="2">
							<div id="divGrilla" style="height:610px;overflow:auto;border-style:solid">
							
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>