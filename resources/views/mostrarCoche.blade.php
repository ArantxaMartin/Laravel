<table>
	@foreach ($coche as $coche)
		<tr>
			<td>Marca y modelo:{{$coche->marcaYModelo}}</td>
		</tr>
		<tr>
			<td>Año:{{$coche->anho}}</td>
		</tr>
		<tr>
			<td>Precio: {{$coche->precio}}</td>
		</tr>
		<tr>
		<?php	
			$imagen="data:image/jpeg;base64,".base64_encode($coche->imagen);
			echo "<td colspan=\"2\"><img src=\"$imagen\" width=\"400px\" height=\"200\"></td>";
		?>
		</tr>
		@endforeach
</table>