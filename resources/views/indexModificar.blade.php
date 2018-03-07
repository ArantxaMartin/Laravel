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
						document.getElementById("modificarCoche").innerHTML=this.responseText;
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
	<body onLoad="cargarSelect('Modificar');">
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
<table>
	<tr>
		<td><h3>MODIFICAR COCHE: </h3></td>
	</tr>
	 <tr>
	    <td>Elija un coche (Marca y Modelo):</td>   
	    <td>
			<div id="selectCocheModificar"><select id="selectMarca" onChange="mostrarDatosCoche();">
				<option>---</option>
			@foreach ($coches as $coche)
				<option>{{$coche->marcaYModelo}}</option>
			 @endforeach
			</select>
			</div>
		</td>
	</tr>
</table>
<div id="modificarCoche">
<table>
	<form method="post" action="modificarCoche" enctype="multipart/form-data">
			{{ csrf_field() }}
	@foreach ($datos as $datos)
		<input type="hidden" name="marcaYModelo" value="{{$datos->marcaYModelo}}">
		
		<tr>
			<td>Año:</td><td><input type="text"  name="precioMod"  id="anhoMod" value="{{$datos->anho}}"></td>
		</tr>
		<tr>
			<td>Precio:</td><td><input type="text" name="precioMod" id="precioMod" value="{{$datos->precio}}"></td>
		</tr>
		<tr>
			<td>Imagen:</td>	
			<td> <input type="file" name="imagen" value=""/></td>
		</tr>
		<tr>
			<td colspan="2"> <input class="boton" type="submit" id="modificar" value="MODIFICAR" onMouseEnter="activar(this);" onMouseLeave="desactivar('modificar');"/></td>
		</tr>
		@endforeach
	
			</form>	
</table>
</div>
<div id=divMensaje>
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

