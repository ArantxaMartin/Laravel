			
	function activar (elemento) {
		elemento.style.backgroundColor = '#2DA2BF';
	}
		
	function desactivar (id) {
		document.getElementById(id).style.backgroundColor = '#1090A2';		
	}
			
	function abrir (pagina) {
		window.location.assign(pagina);
	}
	
			function mostrarVista(menu){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('divContenido').innerHTML = this.responseText;
						}
					};
				xhr.open("POST", menu, true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token={{ csrf_token() }}";
				xhr.send(parametros);	
			}
