<?php
require_once ("clases/producto.php");
require_once ("clases/archivo.php");

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

switch($queHago){

	case "mostrarGrilla":
	
		$ArrayDeProductos = Producto::TraerTodosLosProductos();

		$grilla = '<table class="table">
					<thead style="background:rgb(14, 26, 112);color:#fff;">
						<tr>
							<th>  COD. BARRA </th>
							<th>  NOMBRE     </th>
							<th>  FOTO       </th>
						</tr>  
					</thead>';   	
//AGREGAR COLUMNA 'ACCION'
		foreach ($ArrayDeProductos as $prod){
		
			$grilla .= "<tr>
							<td>".$prod->GetCodBarra()."</td>
							<td>".$prod->GetNombre()."</td>
							<td><img src='archivos/".$prod->GetPathFoto()."' width='100px' height='100px'/></td>
						</tr>";
//AGREGAR UNA COLUMNA CON DOS 'BUTTONS' (ELIMINAR Y MODIFICAR)						
		}
		
		$grilla .= '</table>';		
		
		echo $grilla;
		
		break;
		
	case "agregar":
	case "modificar":

		$res = Archivo::Subir();

		if(!$res["Exito"]){
			echo $res["Mensaje"];
			break;
		}

		$codBarra = isset($_POST['codBarra']) ? $_POST['codBarra'] : NULL;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
		$archivo = $res["PathTemporal"];

		$p = new Producto($codBarra, $nombre, $archivo);
		
		if($queHago === "agregar"){
			if(!Producto::Guardar($p)){
				echo "Error al generar archivo";
				break;
			}
		}

		if($queHago === "modificar"){
			if(!Producto::Modificar($p)){
				echo "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
				break;
			}
		}

		header("Location:./index.php");
		
		break;
	
	case "eliminar":
		$codBarra = isset($_POST['codBarra']) ? $_POST['codBarra'] : NULL;
	
		if(!Producto::Eliminar($codBarra)){
			$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$mensaje = "El archivo fue escrito correctamente. PRODUCTO eliminado CORRECTAMENTE!!!";
		}
	
		echo $mensaje;
		
		break;
		
	default:
		echo ":(";
}
?>