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

/*RUTAS PASSWORD RESET*/

use Illuminate\Support\Facades\Route;

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Route::get('/', 'InicioController@index')->name('inicio');
Route::get('/', function () {
    return redirect('persona');
})->name('inicio');
Route::get('seguridad/login', 'Seguridad\LoginController@index')->name('login');
Route::post('seguridad/login', 'Seguridad\LoginController@login')->name('login_post');
Route::get('seguridad/logout', 'Seguridad\LoginController@logout')->name('logout');
Route::post('ajax-sesion', 'AjaxController@setSession')->name('ajax')->middleware('auth');

/*RUTAS DE PERSONA*/
Route::get('persona', 'PersonaController@index')->name('persona')->middleware('auth');
Route::get('persona/crear', 'PersonaController@crear')->name('crear_persona')->middleware('auth');
Route::post('persona', 'PersonaController@guardar')->name('guardar_persona')->middleware('auth');
Route::post('persona/{id_persona}', 'PersonaController@mostrar')->name('ver_vacaciones')->middleware('auth');
Route::get('persona/{id}/editar', 'PersonaController@editar')->name('editar_persona')->middleware('auth');
Route::put('persona/{id}', 'PersonaController@actualizar')->name('actualizar_persona')->middleware('auth');
Route::delete('persona/{id}', 'PersonaController@eliminar')->name('eliminar_persona')->middleware('auth');

/*RUTAS DE VACACION*/
Route::get('vacacion', 'VacacionController@index')->name('vacacion')->middleware('auth');
Route::get('vacacion/crear/{id_persona}', 'VacacionController@crear')->name('crear_vacacion')->middleware('auth');
Route::post('vacacion', 'VacacionController@guardar')->name('guardar_vacacion')->middleware('auth');
Route::get('vacacion/{id}/editar', 'VacacionController@editar')->name('editar_vacacion')->middleware('auth');
Route::put('vacacion/{id}', 'VacacionController@actualizar')->name('actualizar_vacacion')->middleware('auth');
Route::delete('vacacion/{id}', 'VacacionController@eliminar')->name('eliminar_vacacion')->middleware('auth');

/*RUTAS CON EL MIDDLEWARE ADMIN*/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'superadmin']], function () {
    Route::get('', 'AdminController@index');
    /*RUTAS DE USUARIO*/
    Route::get('usuario', 'UsuarioController@index')->name('usuario');
    Route::get('usuario/crear', 'UsuarioController@crear')->name('crear_usuario');
    Route::post('usuario', 'UsuarioController@guardar')->name('guardar_usuario');
    Route::get('usuario/{id}/editar', 'UsuarioController@editar')->name('editar_usuario');
    Route::put('usuario/{id}', 'UsuarioController@actualizar')->name('actualizar_usuario');
    Route::delete('usuario/{id}', 'UsuarioController@eliminar')->name('eliminar_usuario');
    /*RUTAS DE PERMISO*/
    Route::get('permiso', 'PermisoController@index')->name('permiso');
    Route::get('permiso/crear', 'PermisoController@crear')->name('crear_permiso');
    Route::post('permiso', 'PermisoController@guardar')->name('guardar_permiso');
    Route::get('permiso/{id}/editar', 'PermisoController@editar')->name('editar_permiso');
    Route::put('permiso/{id}', 'PermisoController@actualizar')->name('actualizar_permiso');
    Route::delete('permiso/{id}', 'PermisoController@eliminar')->name('eliminar_permiso');
    /*RUTAS DEL MENU*/
    Route::get('menu', 'MenuController@index')->name('menu');
    Route::get('menu/crear', 'MenuController@crear')->name('crear_menu');
    Route::post('menu', 'MenuController@guardar')->name('guardar_menu');
    Route::get('menu/{id}/editar', 'MenuController@editar')->name('editar_menu');
    Route::put('menu/{id}', 'MenuController@actualizar')->name('actualizar_menu');
    Route::get('menu/{id}/eliminar', 'MenuController@eliminar')->name('eliminar_menu');
    Route::post('menu/guardar-orden', 'MenuController@guardarOrden')->name('guardar_orden');
    /*RUTAS ROL*/
    Route::get('rol', 'RolController@index')->name('rol');
    Route::get('rol/crear', 'RolController@crear')->name('crear_rol');
    Route::post('rol', 'RolController@guardar')->name('guardar_rol');
    Route::get('rol/{id}/editar', 'RolController@editar')->name('editar_rol');
    Route::put('rol/{id}', 'RolController@actualizar')->name('actualizar_rol');
    Route::delete('rol/{id}', 'RolController@eliminar')->name('eliminar_rol');
    /*RUTAS MENU_ROL*/
    Route::get('menu-rol', 'MenuRolController@index')->name('menu_rol');
    Route::post('menu-rol', 'MenuRolController@guardar')->name('guardar_menu_rol');
    /*RUTAS PERMISO_ROL*/
    Route::get('permiso-rol', 'PermisoRolController@index')->name('permiso_rol');
    Route::post('permiso-rol', 'PermisoRolController@guardar')->name('guardar_permiso_rol');
});
Route::get('libro', 'LibroController@index')->name('libro')->middleware('auth');
Route::get('libro/crear', 'LibroController@crear')->name('crear_libro')->middleware('auth');
Route::post('libro', 'LibroController@guardar')->name('guardar_libro')->middleware('auth');
Route::post('libro/{libro}', 'LibroController@ver')->name('ver_libro')->middleware('auth');
Route::get('libro/{id}/editar', 'LibroController@editar')->name('editar_libro')->middleware('auth');
Route::put('libro/{id}', 'LibroController@actualizar')->name('actualizar_libro')->middleware('auth');
Route::delete('libro/{id}', 'LibroController@eliminar')->name('eliminar_libro')->middleware('auth');
/**
 * Rutas Libro Prestamo
 */
Route::get('libro-prestamo', 'LibroPrestamoController@index')->name('libro-prestamo')->middleware('auth');
Route::get('libro-prestamo/crear', 'LibroPrestamoController@crear')->name('libro-prestamo.crear')->middleware('auth');
Route::post('libro-prestamo', 'LibroPrestamoController@guardar')->name('libro-prestamo.guardar')->middleware('auth');
