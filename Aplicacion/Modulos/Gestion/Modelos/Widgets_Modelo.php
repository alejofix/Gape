<?php
	class Widgets_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		public function ConsultaSeguimientos($Usuario = false) {
			if($Usuario == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_general');
				$Consulta->AgregarColumnas('Id');
				$Consulta->AgregarCondicion("Usuario = '$Usuario'");
				$Consulta->AgregarCondicion("Seguimiento = 'SEGUIMIENTO'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function GestionesGlobales($Gestion = false) {
			if($Gestion == true) {
				$Fecha = date("Y-m-d");
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_general');
				$Consulta->AgregarColumnas('Id');
				$Consulta->AgregarCondicion("Fecha = '$Fecha'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ConsultaGestionUsuario($Usuario = false) {
			if($Usuario == true) {
				$Fecha = date("Y-m-d");
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_general');
				$Consulta->AgregarColumnas('Id');
				$Consulta->AgregarCondicion("Fecha = '$Fecha'");
				$Consulta->AgregarCondicion("Usuario = '$Usuario'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
	}