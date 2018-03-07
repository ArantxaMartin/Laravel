<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class controladorCoches extends Controller
{
   
	 public function login(Request $request)
	{
		$usuario=$request->usuario;
		$clave=$request->clave;
		if(DB::select('SELECT * FROM t_usuarios WHERE usuario=? AND clave=?', [$usuario,$clave])){
			$request->session()->put('usuario', $usuario);
			$request->session()->put('clave',$clave);
			return view('index',['request'=>$request]);
		}else{
			$mensaje="Error al iniciar sesión";
			return view('login',['mensaje'=>$mensaje]);
		}
	}
       function logout(Request $request){
        $request->session()->forget('usuario');
        $request->session()->forget('clave');
        $request->session()->flush();
        return redirect('/');
    }
	public function agregarCoche(Request $request){
		$marcaYModelo=$request->marcaYModeloAdd;
		$precio=$request->precioAdd;
		$anho=$request->anhoAdd;

        $coches=DB::select('SELECT * FROM t_coches WHERE marcaYModelo=?',[$marcaYModelo]);
        foreach ($coches as $coche) {
            if($marcaYModelo == $coche->marcaYModelo){
                $mensaje="Error: Coche duplicado.";
                return view('indexAgregar',['mensaje'=>$mensaje]);
            }
        }
        
            //var_dump($_FILES);
        $extension=explode(".",$_FILES['imagen']['name']);
        if(count($extension)>1){   
            if($extension[count($extension)-1]=="jpg"){
                if($_FILES["imagen"]["size"]<=16384*1024){
                            
                    $imagen_temporal = $_FILES['imagen']['tmp_name'];

                    $tipo = $_FILES['imagen']['type'];

                    $fp = fopen($imagen_temporal, 'r+b');
                    $data = fread($fp, filesize($imagen_temporal));
                    fclose($fp);

                    // $data=file_get_contents($imagen_temporal);

                    if(DB::insert('INSERT INTO t_coches (marcaYModelo, anho, precio, imagen) VALUES(?,?,?,?)',[$marcaYModelo,$anho,$precio,$data])==true){
                                
                        $mensaje="Exito al agregar coche";
                        return view('indexAgregar',['mensaje'=>$mensaje]);
                    }else{
                        $mensaje="Error al agregar coche";
                        return view('indexAgregar',['mensaje'=>$mensaje]);
                    }
                }else{
                    $mensaje="Error límite máximo 16mb.";
                    return view('indexAgregar',['mensaje'=>$mensaje]);
                }
            }else{
                $mensaje="Error formato compatible \".jpg\".";
                return view('indexAgregar',['mensaje'=>$mensaje]);
            }
        }else{
            $mensaje="Error, debe agregar una imagen.";
            return view('indexAgregar',['mensaje'=>$mensaje]);
        }
    }
	


	public function selectCocheYear(Request $request){

		$coches=DB::select('SELECT * FROM t_coches');
		return view('selectCocheYear', ['coches'=>$coches]);
	}

	public function selectCocheMarca(Request $request){
		if($request->anho!="---"){
			$coches=DB::select('SELECT * FROM t_coches WHERE anho=?',[$request->anho]);
		}else{
			$coches=DB::select('SELECT * FROM t_coches');
		}
		
		return view('selectCocheMarca', ['coches'=>$coches]);
	}

	public function mostrarCoche(Request $request){

		$coche=DB::select('SELECT * FROM t_coches WHERE marcaYModelo=?',[$request->marcaYModelo]);
		return view('mostrarCoche', ['coche'=>$coche]);
	}

	public function selectCocheModificar(Request $request){
		$coches=DB::select('SELECT * FROM t_coches');
				return view('selectModificar', ['coches'=>$coches]);

	}
	public function mostrarDatosCoche(Request $request){

		$coche=DB::select('SELECT * FROM t_coches WHERE marcaYModelo=?',[$request->marcaYModelo]);
		return view('mostrarDatosCoche', ['coche'=>$coche]);
	}

	function mostrarDatosCoche2(Request $request){
        $marcaYModelo=$request->marcaYModelo;
        $marcaYModelo=trim($marcaYModelo);

        $coche=DB::select('SELECT * FROM t_coches WHERE marcaYModelo=?',[$marcaYModelo]);
        return view('indexModificar',['coche'=>$coche]);
    }

	public function modificarCoche(Request $request){
		 $marcaYModelo=trim($request->marcaYModelo);
        $anho=trim($request->anhoMod);
        $precio=trim($request->precioMod);
        $mensaje= $marcaYModelo."-".$anho."-".$precio;

        $coches=DB::select('SELECT * FROM t_coches;');
        $datos=DB::select('SELECT * FROM t_coches WHERE marcaYModelo=?',[$marcaYModelo]);

        $extension=explode(".",$_FILES['imagen']['name']);
            if(count($extension)>1){   
                if($extension[count($extension)-1]=="jpg"){
                    if($_FILES["imagen"]["size"]<=16384*1024){
                            
                        $imagen_temporal = $_FILES['imagen']['tmp_name'];

                        $tipo = $_FILES['imagen']['type'];

                        $fp = fopen($imagen_temporal, 'r+b');
                        $data = fread($fp, filesize($imagen_temporal));
                        fclose($fp);

                        // $data=file_get_contents($imagen_temporal);

                        if(DB::update('UPDATE t_coches SET anho=?, precio=?, imagen=? WHERE marcaYModelo=?',[$anho, $precio, $data, $marcaYModelo])==true){
                                
                            $mensaje="Exito al modificar coche.";
                            return view('indexModificar',['mensaje'=>$mensaje, 'datos'=>$datos, 'coches'=>$coches]);
                        }else{
                            $mensaje="Error al modificar coche.";
                            return view('indexModificar',['mensaje'=>$mensaje, 'datos'=>$datos, 'coches'=>$coches]);
                        }
                    }else{
                        $mensaje="Error: límite de tamaño alcanzado, máximo 16mb.";
                        return view('indexModificar',['mensaje'=>$mensaje, 'datos'=>$datos, 'coches'=>$coches]);
                    }
                }else{
                    $mensaje="Error: formato único compatible \".jpg\".";
                    return view('indexModificar',['mensaje'=>$mensaje, 'datos'=>$datos, 'coches'=>$coches]);
                }
            }else{
                if(DB::update('UPDATE t_coches SET anho=?, precio=? WHERE marcaYModelo=?',[$anho, $precio, $marcaYModelo])==true){
                    $mensaje="Exito al modificar coche";
                    return view('indexModificar',['mensaje'=>$mensaje, 'datos'=>$datos, 'coches'=>$coches]);
                }else{
                    $mensaje="Error al modificar los datos.";
                    return view('indexModificar',['mensaje'=>$mensaje, 'datos'=>$datos, 'coches'=>$coches]);
                }
            }
	}

	public function listarCoches(){
		$coches=DB::select('SELECT * FROM t_coches');
		return view('listaCoches', ['coches'=>$coches]);
	}

	public function eliminarCoches(Request $request){
		$cochesSeleccionados=explode(",",$request->cochesSeleccionados);
		for ($i=0; $i < count($cochesSeleccionados); $i++) { 
			DB::delete('DELETE FROM t_coches WHERE idCoche=?',[$cochesSeleccionados[$i]]);
		}



	}
}	