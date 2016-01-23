<?php
	class Ajax extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {}
			else { header("Location: ".NeuralRutasApp::RutaURL('Central')); exit(); }
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			exit("Asignacion Erronea");
		}
		
		// -- Inicio de AsignacionAsesores
		public function AsignacionAsesores($Metodo = false, $Parametro_1 = false) {
			if($Metodo == true AND $Parametro_1 == true) {
				$Metodo = ($Metodo == true) ? trim(NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Metodo), array(date("Y-m-d"), 'GESTION'))) : '';
				$Parametro_1 = ($Parametro_1 == true) ? trim(NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Parametro_1), array(date("Y-m-d"), 'GESTION'))) : '';
				$Informacion = AyudasSessiones::InformacionSessionControlador(true);
				if($Metodo == 'Index' AND $Parametro_1 == date("Y-m-d")) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					if(AyudasPost::DatosVacios($DatosPost) == false) {
						if(NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Validacion']), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
							if($DatosPost['Estado'] == 'NO EXISTE') {
								$Asesor = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), array(date("Y-m-d"), 'GESTION'));
								$this->Modelo->AgregarAsesorAsignado($Asesor, $Informacion['Usuario']);
							}
							else {
								$Asesor = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), array(date("Y-m-d"), 'GESTION'));
								$Estado = ($DatosPost['Estado'] == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';
								$this->Modelo->ActualizarAgregarAsesorAsignado($Asesor, $Informacion['Usuario'], $Estado);
							}
						}
						else {
							header("Location: ".NeuralRutasApp::RutaURL('Central'));
							exit();
						}
					}
					else {
						header("Location: ".NeuralRutasApp::RutaURL('Central'));
						exit();
					}
				}
				else {
					header("Location: ".NeuralRutasApp::RutaURL('Central'));
					exit();
				}
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('Central'));
				exit();
			}
		}
		
		public function AsiganarAsesoresExcel($Parametro = false) {
			if($Parametro == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Parametro), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
				if(AyudasPost::DatosVacios($DatosPost) == false) {
					$DatosPost['Usuario'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), array(date("Y-m-d"), 'GESTION'));
					$DatosPost['Listado'] = AyudasCopyPasteExcelArray::ConvertirExcelArrayColumnas($DatosPost['Listado'], array('Asesor'));
					$this->Modelo->AsignarAsesoresDesdeExcel($DatosPost['Listado'], $DatosPost['Usuario']);
					$Plantilla = new NeuralPlantillasTwig;
					echo $Plantilla->MostrarPlantilla('Ajax/AsignacionAsesores/ResultadoExcel.html', 'GESTION');
				}
				else {
					header("Location: ".NeuralRutasApp::RutaURL('Central'));
					exit();
				}
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('Central'));
				exit();
			}
		}
		
		// -- Fin AsignacionAsesores
		
		// -- Inicio de Base Gestion
		
		public function SelectDependienteListaModelo($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$Marca = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('Modelo', $this->Modelo->ListadoModelos($Marca['Marca']));
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ListadoModelos.html', 'GESTION');
				}
			}
		}
		
		public function SelectDependienteListaFirmware($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$Marca = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('Firmware', $this->Modelo->ListadoFirmware($Marca['Marca']));
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ListadoFirmware.html', 'GESTION');
				}
			}
		}
		
		public function SelectDependienteListaPaqueteModelo($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$Paquete = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('Modelo', $this->Modelo->ListadoPaqueteModelo($Paquete['Paquete']));
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ListadoPaqueteModeloTv.html', 'GESTION');
				}
			}
		}
		
		public function BaseGestionInternet($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoMayusOmitido(AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST)), array('Usuario', 'Asesor'));
				if(AyudasPost::DatosVaciosOmitidos($DatosPost, array('MAC', 'CMTS', 'Observaciones')) == false) {
					$DatosPost['Fecha'] = date("Y-m-d");
					$DatosPost['Hora'] = date("H:i:s");
					$DatosPost['Usuario'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), 'GESTION');
					$DatosPost['Asesor'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Asesor']), 'GESTION');
					$DatosPost['Seguimiento'] = (isset($DatosPost['Seguimiento']) == true) ? $DatosPost['Seguimiento'] : 'FINALIZADO';
					$this->Modelo->GuardarGestionInternet($DatosPost);
					$Datos = $this->Modelo->BuscarConsecutivoGestion($DatosPost['Fecha'], $DatosPost['Hora'], $DatosPost['Usuario'], 'INTERNET');
					$Seguimiento = ($DatosPost['Seguimiento'] == 'SEGUIMIENTO') ? self::AgregarSeguimiento(array('Registro' => $Datos[0]['Id'], 'Fecha_Inicio' => date("Y-m-d H:i:s"), 'Usuario' => $DatosPost['Usuario'], 'Observaciones' => $DatosPost['Observaciones'], 'TipoReporte' => 'INTERNET')) : '';
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('IdGestion', substr($DatosPost['Usuario'], 0, 2).$Datos[0]['Id']);
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Internet');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ConsecutivoGestion.html', 'GESTION');
				}
				else {
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Internet');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/DatosVacios.html', 'GESTION');
				}
			}
		}
		
		public function BaseGestionTelefonia($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoMayusOmitido(AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST)), array('Usuario', 'Asesor'));
				if(AyudasPost::DatosVaciosOmitidos($DatosPost, array('MAC', 'CMTS', 'Observaciones')) == false) {
					$DatosPost['Fecha'] = date("Y-m-d");
					$DatosPost['Hora'] = date("H:i:s");
					$DatosPost['Usuario'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), 'GESTION');
					$DatosPost['Asesor'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Asesor']), 'GESTION');
					$DatosPost['Seguimiento'] = (isset($DatosPost['Seguimiento']) == true) ? $DatosPost['Seguimiento'] : 'FINALIZADO';
					$this->Modelo->GuardarGestionTelefonia($DatosPost);
					$Datos = $this->Modelo->BuscarConsecutivoGestion($DatosPost['Fecha'], $DatosPost['Hora'], $DatosPost['Usuario'], 'TELEFONIA');
					$Seguimiento = ($DatosPost['Seguimiento'] == 'SEGUIMIENTO') ? self::AgregarSeguimiento(array('Registro' => $Datos[0]['Id'], 'Fecha_Inicio' => date("Y-m-d H:i:s"), 'Usuario' => $DatosPost['Usuario'], 'Observaciones' => $DatosPost['Observaciones'], 'TipoReporte' => 'TELEFONIA')) : '';
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('IdGestion', substr($DatosPost['Usuario'], 0, 2).$Datos[0]['Id']);
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Telefonia');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ConsecutivoGestion.html', 'GESTION');
				}
				else {
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Telefonia');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/DatosVacios.html', 'GESTION');
				}
			}
		}
		
		public function BaseGestionTelevision($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoMayusOmitido(AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST)), array('Usuario', 'Asesor'));
				if(AyudasPost::DatosVaciosOmitidos($DatosPost, array('Observaciones', 'CMTS')) == false) {
					$DatosPost['Fecha'] = date("Y-m-d");
					$DatosPost['Hora'] = date("H:i:s");
					$DatosPost['Usuario'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), 'GESTION');
					$DatosPost['Asesor'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Asesor']), 'GESTION');
					$DatosPost['Seguimiento'] = (isset($DatosPost['Seguimiento']) == true) ? $DatosPost['Seguimiento'] : 'FINALIZADO';
					$this->Modelo->GuardarGestionTelevision($DatosPost);
					$Datos = $this->Modelo->BuscarConsecutivoGestion($DatosPost['Fecha'], $DatosPost['Hora'], $DatosPost['Usuario'], 'TELEVISION');
					$Seguimiento = ($DatosPost['Seguimiento'] == 'SEGUIMIENTO') ? self::AgregarSeguimiento(array('Registro' => $Datos[0]['Id'], 'Fecha_Inicio' => date("Y-m-d H:i:s"), 'Usuario' => $DatosPost['Usuario'], 'Observaciones' => $DatosPost['Observaciones'], 'TipoReporte' => 'TELEVISION')) : '';
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('IdGestion', substr($DatosPost['Usuario'], 0, 2).$Datos[0]['Id']);
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Televisión');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ConsecutivoGestion.html', 'GESTION');
				}
				else {
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Televisión');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/DatosVacios.html', 'GESTION');
				}
			}
		}
		
		public function BaseGestionMiClaro($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoMayusOmitido(AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST)), array('Usuario', 'Asesor'));
				if(AyudasPost::DatosVaciosOmitidos($DatosPost, array('Observaciones')) == false) {
					$DatosPost['Fecha'] = date("Y-m-d");
					$DatosPost['Hora'] = date("H:i:s");
					$DatosPost['Usuario'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), 'GESTION');
					$DatosPost['Asesor'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Asesor']), 'GESTION');
					$DatosPost['Seguimiento'] = (isset($DatosPost['Seguimiento']) == true) ? $DatosPost['Seguimiento'] : 'FINALIZADO';
					$this->Modelo->GuardarGestionMiClaro($DatosPost);
					$Datos = $this->Modelo->BuscarConsecutivoGestion($DatosPost['Fecha'], $DatosPost['Hora'], $DatosPost['Usuario'], 'MICLARO');
					$Seguimiento = ($DatosPost['Seguimiento'] == 'SEGUIMIENTO') ? self::AgregarSeguimiento(array('Registro' => $Datos[0]['Id'], 'Fecha_Inicio' => date("Y-m-d H:i:s"), 'Usuario' => $DatosPost['Usuario'], 'Observaciones' => $DatosPost['Observaciones'], 'TipoReporte' => 'MICLARO')) : '';
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('IdGestion', substr($DatosPost['Usuario'], 0, 2).$Datos[0]['Id']);
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Mi Claro');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ConsecutivoGestion.html', 'GESTION');
				}
				else {
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Mi Claro');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/DatosVacios.html', 'GESTION');
				}
			}
		}
		
		public function BaseGestionMasivos($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoMayusOmitido(AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST)), array('Usuario', 'Asesor'));
				if(AyudasPost::DatosVaciosOmitidos($DatosPost, array('Observaciones')) == false) {
					$DatosPost['Fecha'] = date("Y-m-d");
					$DatosPost['Hora'] = date("H:i:s");
					$DatosPost['Usuario'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), 'GESTION');
					$DatosPost['Asesor'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Asesor']), 'GESTION');
					$DatosPost['Seguimiento'] = (isset($DatosPost['Seguimiento']) == true) ? $DatosPost['Seguimiento'] : 'FINALIZADO';
					$this->Modelo->GuardarGestionMasivos($DatosPost);
					$Datos = $this->Modelo->BuscarConsecutivoGestion($DatosPost['Fecha'], $DatosPost['Hora'], $DatosPost['Usuario'], 'MASIVOS');
					$Seguimiento = ($DatosPost['Seguimiento'] == 'SEGUIMIENTO') ? self::AgregarSeguimiento(array('Registro' => $Datos[0]['Id'], 'Fecha_Inicio' => date("Y-m-d H:i:s"), 'Usuario' => $DatosPost['Usuario'], 'Observaciones' => $DatosPost['Observaciones'], 'TipoReporte' => 'MASIVOS')) : '';
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('IdGestion', substr($DatosPost['Usuario'], 0, 2).$Datos[0]['Id']);
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Masivos');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ConsecutivoGestion.html', 'GESTION');
				}
				else {
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Masivos');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/DatosVacios.html', 'GESTION');
				}
			}
		}
		
		private function AgregarSeguimiento($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$this->Modelo->GuardarSeguimiento($Array);
			}
		}
		
		public function BaseGestionLLS($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoMayusOmitido(AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST)), array('Usuario', 'Asesor'));
				if(AyudasPost::DatosVaciosOmitidos($DatosPost, array('Observaciones')) == false) {
					$DatosPost['Fecha'] = date("Y-m-d");
					$DatosPost['Hora'] = date("H:i:s");
					$DatosPost['Usuario'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), 'GESTION');
					$DatosPost['Asesor'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Asesor']), 'GESTION');
					$DatosPost['Seguimiento'] = (isset($DatosPost['Seguimiento']) == true) ? $DatosPost['Seguimiento'] : 'FINALIZADO';
					$this->Modelo->GuardarGestionLLS($DatosPost);
					$Datos = $this->Modelo->BuscarConsecutivoGestion($DatosPost['Fecha'], $DatosPost['Hora'], $DatosPost['Usuario'], 'LLS');
                    $Seguimiento = ($DatosPost['Seguimiento'] == 'SEGUIMIENTO') ? self::AgregarSeguimiento(array('Registro' => $Datos[0]['Id'], 'Fecha_Inicio' => date("Y-m-d H:i:s"), 'Usuario' => $DatosPost['Usuario'], 'Observaciones' => $DatosPost['Observaciones'], 'TipoReporte' => 'LLS')) : '';
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('IdGestion', substr($DatosPost['Usuario'], 0, 2).$Datos[0]['Id']);
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Llamadas de Servicio');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ConsecutivoGestion.html', 'GESTION');
				}
				else {
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Llamadas de Servicio');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/DatosVacios.html', 'GESTION');
				}
			}
		}
        
        // fix
        	public function BaseGestionCorreo($Validacion = false) {
        		
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoMayusOmitido(AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST)), array('Usuario', 'Asesor'));
				
				if(AyudasPost::DatosVaciosOmitidos($DatosPost, array('Observaciones')) == false) {
					$DatosPost['Fecha'] = date("Y-m-d");
					$DatosPost['Hora'] = date("H:i:s");
					$DatosPost['Usuario'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Usuario']), 'GESTION');
					$DatosPost['Asesor'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Asesor']), 'GESTION');
					$DatosPost['Seguimiento'] = (isset($DatosPost['Seguimiento']) == true) ? $DatosPost['Seguimiento'] : 'FINALIZADO';
					$data = $this->Modelo->GuardarCorreo($DatosPost);
					$Datos = $this->Modelo->BuscarConsecutivoGestion($DatosPost['Fecha'], $DatosPost['Hora'], $DatosPost['Usuario'], 'CORREO');
					$Seguimiento = ($DatosPost['Seguimiento'] == 'SEGUIMIENTO') ? self::AgregarSeguimiento(array('Registro' => $Datos[0]['Id'], 'Fecha_Inicio' => date("Y-m-d H:i:s"), 'Usuario' => $DatosPost['Usuario'], 'Observaciones' => $DatosPost['Observaciones'], 'TipoReporte' => 'CORREO')) : '';
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('IdGestion', substr($DatosPost['Usuario'], 0, 2).$Datos[0]['Id']);
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Correo');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/ConsecutivoGestion.html', 'GESTION');
				}
				else {
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('TipoReporte', 'Correo');
					echo $Plantilla->MostrarPlantilla('Ajax/BaseGestion/DatosVacios.html', 'GESTION');
				}
			}
			else 
			{
				echo 'Hay Un Error Validar';
			}
		}
        // fix end
        
        
        
		
		// -- FIN de Base Gestion
		
		// -- Inicio Seguimiento
		public function AgregarNuevaNotaSeguimiento($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$Parametros = AyudasSessiones::InformacionSessionControlador(true);
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL(AyudasPost::ConvertirTextoUcwordsOmitido($_POST, array('Seguimiento', 'Registro'))));
					$DatosPost['Registro'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Registro']), array(date("Y-m-d"), 'GESTION'));
					$this->Modelo->AgregarNuevaNotaSeguimiento(array('Usuario' => $Parametros['Usuario'], 'Fecha' => date("Y-m-d"), 'Hora' => date("H:i:s"), 'Registro' => $DatosPost['Registro'], 'Notas' => $DatosPost['Notas']));
					$Seguimiento = ($DatosPost['Seguimiento'] == 'SEGUIMIENTO') ? 'SEGUIMIENTO' : $this->Modelo->ActualizarEstadoRegistroNotas($DatosPost['Registro']);
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('Notas', $this->Modelo->ListaNotasSeguimiento($DatosPost['Registro']));
					echo $Plantilla->MostrarPlantilla('Ajax/Seguimiento/Notas.html', 'GESTION');
				}
				else {
					// -- Vista datos Vacios
					echo '<h3>Hay Datos Vacios en el Formulario</h3>';
				}
				
			}
		}
		// -- FIN de Seguimiento
		
	}