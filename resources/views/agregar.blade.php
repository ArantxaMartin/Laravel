		<form method="post" action="agregarCoche" enctype="multipart/form-data">
	{{ csrf_field() }}
	<table id="tablaAgregar">
		<tr>
			<td><h3>Agregar Coche:</h3></td>
		</tr>
		<tr>
			<td> Marca y Modelo: </td><td> <input id="marcaYModeloAdd" type="text" name="marcaYModeloAdd" onClick="vaciarMensaje();"/> </td>
		</tr>
		<tr>
		    <td> Año: </td><td><input id="anhoAdd" type="text" name="anhoAdd" onClick="vaciarMensaje();"/></td>
		</tr>
		<tr>
		    <td> Precio: </td><td> <input id="precioAdd" type="text" name="precioAdd" onClick="vaciarMensaje();"/></td>
		</tr>
		<tr>
		    <td> Imagen: </td><td> <input name="imagen" type="file" /></td>
		</tr>
		<tr>
		    <td colspan="2" align="center"> <input class="boton" type="submit" id='agregar' value="Agregar" onClick="agregarCoche();" onMouseEnter="activar(this);" onMouseLeave="desactivar('agregar');"/></td>
		</tr>	      
    </table>
		
	<div id="divMensaje">
		<?php
		if(isset($mensaje)){
			if (strpos($mensaje, 'Error') !== false) {
		    	echo "<font color='red'>$mensaje</font>";
			}else{
				echo "<font color='green'>$mensaje</font>";
			}
		}
	?>
	</div>