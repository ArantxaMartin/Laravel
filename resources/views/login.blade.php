<!DOCTYPE html>
<html>
<head>
	<title>WebCoches</title>
	
	
</head>
<body>
	<div id="divLogin">
		<form method="post" action="index">
			{{ csrf_field() }}
			
			<table >
				<tr>
					<td >Usuario:</td><td><input name="usuario" type="text" value="" required></td></tr>
				<tr><td >Clave:</td><td><input name="clave" type="password" value="" required></td></tr>
				<tr height="60"><td></td><td><input class="boton" name="acceder" type="submit" value="ACCEDER"></td></tr>
			</table>
		</form>
		<p class="error"> 
			<?php 
				if(isset($mensaje)){
					echo $mensaje;
				}
			?>
		</p>
	</div>
</body>
</html>