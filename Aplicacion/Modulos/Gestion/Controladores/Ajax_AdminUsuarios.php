<?php
	class Ajax_AdminUsuarios extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			/*if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {}
			else { header("Location: ".NeuralRutasApp::RutaURL('Central')); exit(); }
			*/AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			exit("Asignacion Erronea");
		}
		
		public function GestionNuevoUsuario($Validacion = false) {
			if(NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
				if(AyudasPost::DatosVacios($DatosPost) == false AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Data']), 'GESTION') == date("Y-m-d")) {
					unset($_POST, $DatosPost['Data']);
					$DatosPost['Permisos'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Permisos']), 'GESTION');
					if($this->Modelo->ConsultarExistenciaUsuario($DatosPost['Usuario']) >= 1) {
						echo '<h4 style="color: red;">El Usuario Ya Existe En La Base De Datos</h4>';
						exit();
					}
					else {
						$this->Modelo->GuardarNuevoUsuario(AyudasPost::ConvertirTextoUcwords($DatosPost));
						$Plantilla = new NeuralPlantillasTwig;
						echo $Plantilla->MostrarPlantilla('AdminUsuarios/UsuarioAgregado.html', 'GESTION');
					}
				}
				else {
					exit("Asignacion Erronea");
				}
			}
		}
		
		public function ConsultarExistenciaUsuario() {
			$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
			if($this->Modelo->ConsultarExistenciaUsuario($DatosPost['Usuario']) >= 1) {
				echo 'false';
			}
			else {
				echo 'true';
			}
		}
		
		public function ProcesarUsuariosLoteExcel($Validacion = false) {
			if(NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::ConvertirTextoUcwordsOmitido(AyudasPost::LimpiarInyeccionSQL($_POST), array('Usuario')));
					$Excel = AyudasCopyPasteExcelArray::ConvertirExcelArrayColumnas($DatosPost['Excel'], array('Usuario', 'Nombres', 'Apellidos', 'Cedula', 'Cargo', 'Permisos'));
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('Excel', $Excel);
					$Plantilla->AgregarFuncion('MultiValidacion', function ($Columna, $Valor) {
						
					});
					echo $Plantilla->MostrarPlantilla('Ajax/AdminUsuarios/TablaUsuariosExcel.html', 'GESTION');
				}
				else {
					echo '<h3 style="color: red;">El Formulario Presenta Datos Vacios</h3>';
				}
			}
		}
		
		public function ActivacionUsuario($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$Estado = 'ACTIVO';
					$this->Modelo->ActivacionUsuario($DatosPost['Asesor'], $Estado);
					echo $Estado;
				}
			}
		}
		
		public function DesActivacionUsuario($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
					$Estado = 'INACTIVO';
					$this->Modelo->ActivacionUsuario($DatosPost['Asesor'], $Estado);
					echo $Estado;
				}
			}
		}
		
		public function ResetPassword($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
				if(is_numeric($DatosPost['ID']) == true) {
					$DatosPost['Datos'] = AyudasConversorHexAscii::HEX_ASCII($DatosPost['Datos']);
					$this->Modelo->ResetPassword($DatosPost['Datos']);
				}
			}
		}
		
		public function ActualizarDatosUsuarios($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::ConvertirTextoUcwordsOmitido(AyudasPost::FormatoMinOmitido(AyudasPost::LimpiarInyeccionSQL($_POST), array('Data')), array('Data')));
					$DatosPost['Data'] = NeuralEncriptacion::DesencriptarDatos($DatosPost['Data'], 'GESTION');
					$this->Modelo->ActualizarDatosUsuarios($DatosPost);
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('Nombre', $DatosPost['Nombres'].' '.$DatosPost['Apellidos']);
					echo $Plantilla->MostrarPlantilla('Ajax/AdminUsuarios/UsuarioActualizado.html', 'GESTION');
				}
			}
		}
		
		public function ConsultarExistenciaAsesorRemote($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::FormatoMayus(AyudasPost::LimpiarInyeccionSQL($_POST)));
				Ayudas::print_r($DatosPost);
				if(AyudasPost::DatosVacios($DatosPost) == false) {
					$Data = $this->Modelo->ConsultarExistenciaAsesorRemote($DatosPost['Usuario']);
					if($Data['Cantidad']>=1) {
						echo 'false';
					}
					else {
						echo 'true';
					}
				}
			}
		}
		
		public function AgregarAsesor($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::ConvertirTextoUcwords(AyudasPost::FormatoMin(AyudasPost::LimpiarInyeccionSQL($_POST))));
					if($this->Modelo->ConsultarExistenciaAsesorRemote($DatosPost['Usuario'])>=1) {
						$Plantilla = new NeuralPlantillasTwig;
						$Plantilla->ParametrosEtiquetas('Usuario', $DatosPost['Usuario']);
						echo $Plantilla->MostrarPlantilla('Ajax/AdminUsuarios/AsesorExiste.html', 'GESTION');
					}
					else {
						$this->Modelo->AgregarAsesor($DatosPost);
						$Plantilla = new NeuralPlantillasTwig;
						$Plantilla->ParametrosEtiquetas('Nombre', $DatosPost['Nombres'].' '.$DatosPost['Apellidos']);
						echo $Plantilla->MostrarPlantilla('Ajax/AdminUsuarios/AsesorInsertado.html', 'GESTION');
					}
				}
			}
		}
		
		public function AgregarAsesoresExcel($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					$Excel = AyudasCopyPasteExcelArray::ConvertirExcelArrayColumnas($DatosPost['Excel'], array('Usuario', 'Nombres', 'Apellidos', 'Cedula'));
					$Resultado = $this->Modelo->AgregarAsesoresExcel($Excel);
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('No_Guardados', $Resultado);
					echo $Plantilla->MostrarPlantilla('Ajax/AdminUsuarios/AsesoresExcel.html', 'GESTION');
				}
			}
		}
		
		public function EliminarUsuario($Fecha = false) {
			if($Fecha == true AND AyudasConversorHexAscii::HEX_ASCII($Fecha) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					$DatosPost['Datos'] = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($DatosPost['Datos']), array(date("Y-m-d"), 'GESTION'));
					if(is_numeric($DatosPost['Datos']) == true) {
						$this->Modelo->EliminarUsuario($DatosPost['Datos']);
					}
				}
			}
		}
	}