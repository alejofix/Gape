<?php
	class Ajax_AdminContenido extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {}
			else { header("Location: ".NeuralRutasApp::RutaURL('Central')); exit(); }
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			exit("Asignacion Erronea");
		}
		
		public function CargarListadoSintomas() {
			if(AyudasPost::DatosVacios($_POST) == false) {
				$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
				$Matriz = array(
					'TELEVISION' => 'Sintoma de Televisión', 
					'INTERNET' =>  'Sintoma de Internet',
					'TELEFONIA' => 'Sintoma de Telefonia',
					'MICLARO' => 'Sintoma de Mi Claro',
					'MASIVOS' => 'Sintoma de Reportes Masivos',
					'LLS' => 'Sintoma de Llamadas de Servicio',
					'LLS_SA' => 'Servicio Afectado Llamadas de Servicio',
					'IIMS' => 'Sintoma de Pasos IIMS',
                    'CORREO' => 'Sintoma de Pasos Correo'
				);
				
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->CargarListadoSintomas($DatosPost['Proceso']));
				$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION'))));
				$Plantilla->ParametrosEtiquetas('Proceso', $Matriz[$DatosPost['Proceso']]);
				echo $Plantilla->MostrarPlantilla('Ajax/AdminContenido/ListadoSintomas.html', 'GESTION');
			}
		}
		
		public function AgregarSintomaTelevision($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarSintomaBase($DatosPost['Sintoma'], 'TELEVISION');
				}
			}
		}
		
		public function AgregarSintomaInternet($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarSintomaBase($DatosPost['Sintoma'], 'INTERNET');
				}
			}
		}
		
		public function AgregarSintomaTelefonia($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarSintomaBase($DatosPost['Sintoma'], 'TELEFONIA');
				}
			}
		}
		
		public function AgregarSintomaMiClaro($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarSintomaBase($DatosPost['Sintoma'], 'MICLARO');
				}
			}
		}
		
		public function AgregarSintomaMasivos($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarSintomaBase($DatosPost['Sintoma'], 'MASIVOS');
				}
			}
		}
		
		public function AgregarSintomaLLS($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarSintomaBase($DatosPost['Sintoma'], 'LLS');
				}
			}
		}
		
		public function AgregarSintomaIIMS($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarSintomaBase($DatosPost['Sintoma'], 'IIMS');
				}
			}
		}
		//fix
        public function AgregarSintomaCorreo($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarSintomaBase($DatosPost['Sintoma'], 'CORREO');
				}
			}
		}
        //end fix
		public function EliminarSintoma($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					$this->Modelo->EliminarSintoma($DatosPost['Id']);
				}
			}
		}
		
		public function ActualizarSintoma($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->ActualizarSintoma($DatosPost['Id'], $DatosPost['Sintoma']);
				}
			}
		}
		
		public function ListarPaqueteTelevision() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListarPaqueteTelevision(true));
			echo $Plantilla->MostrarPlantilla('Ajax/AdminContenido/PaqueteTelevision/SelectPaquete.html', 'GESTION');
		}
		
		public function ListarPaqueteTelevisionTabla() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListarPaqueteTelevisionTabla(true));
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('Ajax/AdminContenido/PaqueteTelevision/ListadoPaquetesTelevision.html', 'GESTION');
		}
		
		public function AgregarPaqueteTelevision($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarPaqueteTelevision($DatosPost);
				}
			}
		}
		
		public function EditarModeloTelevision($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->EditarModeloTelevision($DatosPost);
				}
			}
		}
		
		public function EliminarModeloTelevision($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					$this->Modelo->EliminarModeloTelevision($DatosPost['Id']);
				}
			}
		}
		
		public function ListarMarCablemodems() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListarMarCablemodems(true));
			echo $Plantilla->MostrarPlantilla('Ajax/AdminContenido/Internet/Select.html', 'GESTION');
		}
		
		public function InternetAgregarMarcaModelo($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->InternetAgregarMarcaModelo($DatosPost);
				}
			}
		}
		
		public function ListarModelosCablemodemInternet() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListarModelosCablemodemInternet(true));
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('Ajax/AdminContenido/Internet/ListadoModelos.html', 'GESTION');
		}
		
		public function InternetEditarModelo($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->InternetEditarModelo($DatosPost);
				}
			}
		}
		
		public function InternetEliminarModelo($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->InternetEliminarModelo($DatosPost['Id']);
				}
			}
		}
		
		public function InternetAgregarFirmware($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->InternetAgregarFirmware($DatosPost);
				}
			}
		}
		
		public function InternetListadoFirmware() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->InternetListadoFirmware(true));
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('Ajax/AdminContenido/Internet/ListadoFirmware.html', 'GESTION');
		}
		
		public function InternetEliminarFirmware($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->InternetEliminarFirmware($DatosPost['Id']);
				}
			}
		}
		
		public function InternetEditarFirmware($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->InternetEditarFirmware($DatosPost);
				}
			}
		}
		
		public function LLSagregarServicioAfectado($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->LLSagregarServicioAfectado($DatosPost['Sintoma']);
				}
			}
		}
		
		public function LLSListadoServicioAfectado() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->LLSListadoServicioAfectado(true));
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('Ajax/AdminContenido/LLS/ListadoServcioAfectado.html', 'GESTION');
		}
		
		public function LLSeliminarServicioAfectado($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->LLSeliminarServicioAfectado($DatosPost['Id']);
				}
			}
		}
		
		public function LLSeditarServicioAfectado($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->LLSeditarServicioAfectado($DatosPost);
				}
			}
		}
		
		public function ListarSoftswitchTelefoniaTabla() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListarSoftswitchTelefoniaTabla(true));
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('Ajax/AdminContenido/Telefonia/ListarSoftswitchTelefoniaTabla.html', 'GESTION');
		}
		
		public function AgregarSoftswitchTelefonia($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->AgregarSoftswitchTelefonia($DatosPost['Softswitch']);
				}
			}
		}
		
		public function TelefoniaSoftswitchEliminar($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->TelefoniaSoftswitchEliminar($DatosPost['Id']);
				}
			}
		}
		
		public function TelefoniaSoftswitchEditar($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$this->Modelo->TelefoniaSoftswitchEditar($DatosPost);
				}
			}
		}
	}