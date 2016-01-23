<?php
	class Ajax_AsignacionAsesores extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			exit('Gestion No Permitida');
		}
		
		public function GestionAsignacionUsuario($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == true) {
				$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
				$Parametros = AyudasSessiones::InformacionSessionControlador(true);
				$this->Modelo->GestionAsignacionUsuario($DatosPost['Id'], 'ACTIVO', $Parametros['Usuario']);
				echo 'ASIGNADO';
			}
		}
		
		public function GestionNoAsignacionUsuario($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == true) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$Parametros = AyudasSessiones::InformacionSessionControlador(true);
					$this->Modelo->GestionAsignacionUsuario($DatosPost['Id'], 'INACTIVO', $Parametros['Usuario']);
					echo 'NO ASIGNADO';
				}
			}
		}
	}