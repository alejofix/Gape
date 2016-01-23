<?php
	class ChangePass_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		public function InformacionUsuario ($Usuario) {
			$ConsultaSQL = new NeuralBDConsultas;
			$ConsultaSQL->CrearConsulta('tbl_sistema_usuarios');
			$ConsultaSQL->AgregarColumnas('Id');   		      		
			$ConsultaSQL->AgregarCondicion("Usuario ='$Usuario'");
			$ConsultaSQL->AgregarCondicion("Estado = 'ACTIVO'");
			$ConsultaSQL->PrepararQuery();
			return $ConsultaSQL->ExecuteConsulta('GESTION');			  
		}
	}