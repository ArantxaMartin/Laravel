<!DOCTYPE html>
<html>
	<head>
		<title> Cat&aacute;logo de coches </title>
		<link href="../public/css/estilos.css" rel="stylesheet">
		<!-- <script type="text/javascript" src="/js/eventos.js"></script> --> 

		<script type="text/javascript">
						
			function activar (elemento) {
				elemento.style.backgroundColor = '#2DA2BF';
			}
				
			function desactivar (id) {
				document.getElementById(id).style.backgroundColor = '#1090A2';		
			}
					
			function abrir (pagina) {
				window.location.assign(pagina);
			}
			

			function vistas(vista) {
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("divContenido").innerHTML=this.responseText;
					}
				}
				xhr.open("POST", vista , true); 
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				var parametros ="_token={{ csrf_token() }}";
				xhr.send(parametros);
			}

			function vaciarMensaje() {
				document.getElementById('divMensaje').innerHTML="";
			}

			function cargarSelect(tipo){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("selectCoche"+tipo).innerHTML=this.responseText;
					}
				}
				xhr.open("POST", "selectCoche"+tipo , true); 
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				var anho="---";
				var parametros ="_token={{ csrf_token() }}"+"&anho="+anho;
				xhr.send(parametros);	
			}
			
			function filtrarSelect(){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("selectCocheMarca").innerHTML=this.responseText;
					}
				}
				xhr.open("POST", "selectCocheMarca", true); 
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

				var anho=document.getElementById('selectYear').value;
				var parametros ="_token={{ csrf_token() }}"+"&anho="+anho;
				xhr.send(parametros);	
			}

			function mostrarCoche(){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("mostrarCoche").innerHTML=this.responseText;
					}
				}
				xhr.open("POST", "mostrarCoche", true); 
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

				var marcaYModelo=document.getElementById("selectMarca").value;
				var parametros ="_token={{ csrf_token() }}"+"&marcaYModelo="+marcaYModelo;
				xhr.send(parametros);	
			}
			function mostrarDatosCoche(){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("datosCoche").innerHTML=this.responseText;
					}
				}
				xhr.open("POST", "mostrarDatosCoche", true); 
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

				var marcaYModelo=document.getElementById("selectMarca").value;
				var parametros ="_token={{ csrf_token() }}"+"&marcaYModelo="+marcaYModelo;
				xhr.send(parametros);	
			}


			function listarCoches(){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("listaCoches").innerHTML=this.responseText;
					}
				}
				xhr.open("POST", "listarCoches", true); 
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

				
				var parametros ="_token={{ csrf_token() }}";
				xhr.send(parametros);	
			}
			function eliminarCoches(){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("divMensaje").innerHTML=this.responseText;
					}
				}
				var coches = document.getElementsByName('check');
				var cochesSeleccionados = "";
				for(var i = 0; i < coches.length;i++){
					if(coches[i].checked == true){
						cochesSeleccionados += coches[i].id+",";
					}
				}
				xhr.open("POST", "eliminarCoches", true); 
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

				var parametros ="_token={{ csrf_token() }}"+"&cochesSeleccionados="+cochesSeleccionados;
				xhr.send(parametros);	
			}

		</script>

	</head>
	<body id="web">
	{{ csrf_field() }}


	<div id="divCabecera">
		<table>
			<tr>
				<td><img src="../public/images/coches.jpg" height="100" width="640"></td>
			</tr>
		</table>
	</div>

	<div id="divMenu">
			<div id="divTitulo">
				<p>CATALOGO DE COCHES<p/>
			</div>
			<div id="divAgregarItem" onClick="vistas('agregar');" onMouseEnter="activar(this);" onMouseLeave="desactivar('divAgregarItem');">
				<p>AGREGAR</p>			
			</div>
			<div id="divVerItem" onClick="vistas('ver');  cargarSelect('Year');cargarSelect('Marca');"  onMouseEnter="activar(this);" onMouseLeave="desactivar('divVerItem');">
				<p>VER</p>
			</div>
			<div id="divModificarItem" onClick="vistas('modificar'); cargarSelect('Modificar');"  onMouseEnter="activar(this);" onMouseLeave="desactivar('divModificarItem');">
				<p>MODIFICAR</p>
			</div>
			<div id="divEliminarItem" onClick="vistas('eliminar'); listarCoches();"  onMouseEnter="activar(this);" onMouseLeave="desactivar('divEliminarItem');">
				<p>ELIMINAR</p>			
			</div>
				<form id="logout" method="post" action="logout">
					{{ csrf_field() }}
					<div id="divLogout">
						<input type="submit" id="botonLogout" value="CERRAR SESION"/>
					</div>
				</form>
			</div>
	</div>

	
	<div id="divContenido">
				<form method="post" action="agregarCoche" enctype="multipart/form-data">
	{{ csrf_field() }}
	<table id="tablaAgregar">
		<tr>
			<td><h3>Agregar Coche:</h3></td>
		</tr>
		<tr>
			<td> Marca y Modelo: </td><td> <input id="marcaYModeloAdd" type="text" name="marca" onClick="vaciarMensaje();"/> </td>
		</tr>
		<tr>
		    <td> Año: </td><td><input id="anhoAdd" type="text" name="anyo" onClick="vaciarMensaje();"/></td>
		</tr>
		<tr>
		    <td> Precio: </td><td> <input id="precioAdd" type="text" name="precio" onClick="vaciarMensaje();"/></td>
		</tr>
		<tr>
		    <td> Imagen: </td><td> <input name="imagen" type="file" /></td>
		</tr>
		<tr>
		    <td colspan="2" align="center"> <input class="boton" type="submit" id='agregar' class="boton" value="Agregar" onClick="agregarCoche();" onMouseEnter="activar(this);" onMouseLeave="desactivar('agregar');"/></td>
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

	</div>

</body>
</html>

