<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::post('agregar', function () {
    return view('agregar');
});
Route::post('ver', function () {
    return view('ver');
});
Route::post('modificar', function () {
    return view('modificar');
});
Route::post('eliminar', function () {
    return view('eliminar');
});

Route::post('login', 'controladorCoches@login');
Route::post('index', 'controladorCoches@login');


Route::post('agregarCoche', 'controladorCoches@agregarCoche' );

Route::post('selectCocheYear', 'controladorCoches@selectCocheYear');
Route::post('selectCocheMarca', 'controladorCoches@selectCocheMarca');
Route::post('selectCocheModificar', 'controladorCoches@selectCocheModificar');

Route::post('mostrarCoche', 'controladorCoches@mostrarCoche');
Route::post('mostrarDatosCoche', 'controladorCoches@mostrarDatosCoche');
Route::post('mostrarDatosCoche2', 'controladorCoches@mostrarDatosCoche2');

Route::post('modificarCoche', 'controladorCoches@modificarCoche');



Route::post('listarCoches', 'controladorCoches@listarCoches');

Route::post('eliminarCoches', 'controladorCoches@eliminarCoches');

Route::post('logout', 'controladorCoches@logout');


