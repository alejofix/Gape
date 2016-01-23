<?php

	class Index extends Controlador {
		
		function __Construct() {
			parent::__Construct();
		}
		
		public function Index($Error = false) {

			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('Usuario', 'Ingrese el Usuario Correspondiente');
			$Validacion->Requerido('Password', 'Ingrese la Contraseña Correspondiente');
			$Script[] = $Validacion->MostrarValidacion('Form');
			
			$Plantilla = new NeuralPlantillasTwig;
			if($Error == true AND AyudasConversorHexAscii::HEX_ASCII($Error) == 'NOAUTORIZADO') { $Plantilla->ParametrosEtiquetas('NoAutorizado', 'NOAUTORIZADO'); }
			if($Error == true AND AyudasConversorHexAscii::HEX_ASCII($Error) == 'DATOSVACIOS') { $Plantilla->ParametrosEtiquetas('DatosVacios', 'DATOSVACIOS'); }
			$Plantilla->ParametrosEtiquetas('Validacion', NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), 'GESTION'));
			$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
            echo $Plantilla->MostrarPlantilla('Login/more-login.html', 'GESTION');
		}
		
		/**
		 * Index::Autenticacion()
		 * 
		 * Genera el proceso de la autenticacion
		 * @return void
		 */
		public function Autenticacion() {
			if(isset($_POST) == true AND isset($_POST['Proceso']) == true) {
				$this->envioFormulario();
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('Index'));
				exit();
			}
		}
		
		/**
		 * Index::envioFormulario()
		 * 
		 * Valida la existencia del campo especial del formulario correspondiente
		 * @return void
		 */
		private function envioFormulario() {
			if(NeuralEncriptacion::DesencriptarDatos($_POST['Proceso'], 'GESTION') == date("Y-m-d")) {
				$this->validarDatosVacios();
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('Index/Index/').AyudasConversorHexAscii::ASCII_HEX('NOAUTORIZADO'));
				exit();
			}
		}
		
		/**
		 * Index::validarDatosVacios()
		 * 
		 * Valida si todos los campos del formuilario fue ingresado valor
		 * @return void
		 */
		private function validarDatosVacios() {
			if(AyudasPost::DatosVacios($_POST) == false) {
				$this->ConsultarUsuario();
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('Index/Index/').AyudasConversorHexAscii::ASCII_HEX('DATOSVACIOS'));
				exit();
			}
		}
		
		/**
		 * Index::ConsultarUsuario()
		 * 
		 * Genera la consulta de los datos del usuario
		 * @return void
		 */
		private function ConsultarUsuario() {
			$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
			$DatosPost['Password'] = sha1($DatosPost['Password']);
			$ConsultaUsuario = $this->Modelo->ConsultarUsuario($DatosPost['Usuario'], $DatosPost['Password']);
			if($ConsultaUsuario['Cantidad'] == 1) {
				$ConsultaPermisos = $this->Modelo->ConsultarPermisos($ConsultaUsuario[0]['Permisos']);
				if($ConsultaPermisos['Cantidad'] == 1) {
					AyudasSessiones::RegistrarSession($ConsultaUsuario[0], $ConsultaPermisos[0]);
					header("Location: ".NeuralRutasApp::RutaURL('Central'));
					exit();
				}
				else {
					header("Location: ".NeuralRutasApp::RutaURL('Index/Index/').AyudasConversorHexAscii::ASCII_HEX('DATOSINCORRECTOS'));
					exit();
				}
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('Index/Index/').AyudasConversorHexAscii::ASCII_HEX('DATOSINCORRECTOS'));
				exit();
			}
		}
	}