<?php
	class Seguimiento extends Controlador {
	
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
	
		public function Index() {
	
			$Parametros = AyudasSessiones::InformacionSessionControlador(true);
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
			$Plantilla->ParametrosEtiquetas('Titulo', 'Seguimientos');
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListarSeguimientosActivos($Parametros['Usuario']));
			$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
			$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto = false){
				if($Texto == true) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, array(date("Y-m-d"), 'GESTION')));
			}});
			echo $Plantilla->MostrarPlantilla('Seguimiento/Listado.html', 'GESTION');
		}
	
		public function GestionSeguimiento($Registro = false, $Fecha = false) {
			if($Registro == true AND $Fecha == true) {
				$Id = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Registro), array(date("Y-m-d"), 'GESTION'));
				$Date = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Fecha), array(date("Y-m-d"), 'GESTION'));
				if(is_numeric($Id) == true AND $Date == date("Y-m-d")) {
					
					$Validacion = new NeuralJQueryValidacionFormulario;
					$Validacion->Requerido('Notas', 'Ingrese las Observaciones del Caso');
					$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form', 'CargarNotas', NeuralRutasApp::RutaURL('Ajax/AgregarNuevaNotaSeguimiento/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
					$Script[] = $Validacion->MostrarValidacion('Form');
					
					$Parametros = AyudasSessiones::InformacionSessionControlador(true);
					$Consulta = $this->Modelo->ConsultarSeguimiento($Id, $Parametros['Usuario']);
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
					$Plantilla->ParametrosEtiquetas('Titulo', 'Seguimientos');
					$Plantilla->ParametrosEtiquetas('Consulta', $Consulta);
					$Plantilla->ParametrosEtiquetas('Notas', $this->Modelo->ListarNotas($Consulta[0]['Registro']));
					$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
					$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto){
						return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, array(date("Y-m-d"), 'GESTION')));
					});
					$Plantilla->AgregarFuncionAnonima('CambiarTexto', function ($Columna) {
						$Matriz = array('Tipo_Reporte' => 'Tipo de Reporte', 'Fecha_Inicio' => 'Fecha Inicio', 'Registro' => 'Consecutivo');
						return (array_key_exists($Columna, $Matriz) == true) ? $Matriz[$Columna] : $Columna;
					});
					echo $Plantilla->MostrarPlantilla('Seguimiento/Gestion.html', 'GESTION');
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
		
		public function SeguimientosGenerales() {
			
			$Parametros = AyudasSessiones::InformacionSessionControlador(true);
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
			$Plantilla->ParametrosEtiquetas('Titulo', 'Seguimiento General');
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListadoSeguimientoGeneral(true));
			$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
			$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto = false){
				if($Texto == true) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, array(date("Y-m-d"), 'GESTION')));
			}});
			echo $Plantilla->MostrarPlantilla('Seguimiento/Listado.html', 'GESTION');
		}
	}