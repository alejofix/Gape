<?php
	class Ajax_ChangePass extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			exit('Gestion No Valida');
		}
		
		public function CambioPassword($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false AND isset($_POST['Cambiar']) == true) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					$DatosPost['Data'] = NeuralEncriptacion::DesencriptarDatos($DatosPost['Data'], array(date("Y-m-d"), 'GESTION'));
					if($DatosPost['PW_1'] == $DatosPost['PW_2'] AND is_numeric($DatosPost['Data']) == true) {
						$this->Modelo->CambioPassword($DatosPost['PW_1'], $DatosPost['Data']);
						$Plantilla = new NeuralPlantillasTwig;
						echo $Plantilla->MostrarPlantilla('Ajax/CambioPasswordUsuario/Mensaje.html', 'GESTION');
					}
					else {
						$Plantilla = new NeuralPlantillasTwig;
						echo $Plantilla->MostrarPlantilla('Ajax/CambioPasswordUsuario/NoCoinciden.html', 'GESTION');
					}
				}
				else {
					$Plantilla = new NeuralPlantillasTwig;
					echo $Plantilla->MostrarPlantilla('Ajax/CambioPasswordUsuario/DatosVacios.html', 'GESTION');
				}
			}
		}
	}