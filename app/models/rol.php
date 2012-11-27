<?php
	class Rol extends ActiveRecord{
		public static function registrar($nombre, $activo = "SI"){
			$rol = new Rol();
			
			$usuario -> nombre = $nombre;
			$usuario -> activo = $activo;
			$usuario -> fecha_registro = date("Y-m-d H:i:s");
			
			$usuario -> cuenta_id = Session::get("cuenta_id");
			
			$usuario -> save();
			
			return $usuario;
		}
	}
?>