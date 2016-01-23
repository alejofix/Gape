<?php
	class Ajax_BaseGestion extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			exit('Gestion No Valida');
		}
		
		public function GuardarIIMS($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoMayusOmitido(AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST)), array('Usuario', 'Asesor'));
					$DatosPost['Fecha'] = date("Y-m-d");
					$DatosPost['Hora'] = date("H:i:s");
					$DatosPost['Usuario'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), 'GESTION');
					$DatosPost['Asesor'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Asesor']), 'GESTION');
					$this->Modelo->GuardarIIMS($DatosPost);
					
					$Plantilla = new NeuralPlantillasTwig;
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/IIMS.html', 'GESTION');
				}
			}
		}
	}