<form method="post" action="modificarCoche" enctype="multipart/form-data">
	{{ csrf_field() }}
	@foreach ($coche as $coche)
	<input type="hidden" name="marcaYModelo" value="{{$coche->marcaYModelo}}">

<table>

		
		<tr>
			<td>Año:</td><td><input type="text"  name="anhoMod"  id="anhoMod" value="{{$coche->anho}}"></td>
		</tr>
		<tr>
			<td>Precio:</td><td><input type="text" name="precioMod" id="precioMod" value="{{$coche->precio}}"></td>
		</tr>
	
		
		<tr>
			<td>Imagen:</td>	
			<td> <input type="file" name="imagen" value=""/></td>
		</tr>
		<tr>
			<td colspan="2"> <input class="boton" type="submit" id="modificar" value="MODIFICAR" onMouseEnter="activar(this);" onMouseLeave="desactivar('modificar');" /></td>
		</tr>
		
</table>
	@endforeach
</form>	