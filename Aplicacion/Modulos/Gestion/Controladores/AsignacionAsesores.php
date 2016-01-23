<?php
	class AsignacionAsesores extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			
			$Parametros = AyudasSessiones::InformacionSessionControlador(true);
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Listado de Asesores');
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListarAsesoresAsignacion($Parametros['Usuario']));
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AsignacionAsesores/ListadoActivos.html', 'GESTION');
		}
		
		public function AsiganarAsesoresExcel() {
			
			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('Listado', 'Ingrese los Datos Requeridos');
			$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form_Asesores', 'Form_Asesores', NeuralRutasApp::RutaURL('Ajax/AsiganarAsesoresExcel/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
			$Script[] = $Validacion->MostrarValidacion('Form_Asesores');
			
			$Parametros = AyudasSessiones::InformacionSessionControlador(true);
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
			$Plantilla->ParametrosEtiquetas('Titulo', 'Asignación de Asesores');
			$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
			$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Data){
				return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Data, array(date("Y-m-d"), 'GESTION')));
			});
			echo $Plantilla->MostrarPlantilla('AsignacionAsesores/AsiganarAsesoresExcel.html', 'GESTION');
		}
	}