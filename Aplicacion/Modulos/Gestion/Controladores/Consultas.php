<?php
	class Consultas extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			
			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('Registro', 'Ingrese el Número de Registro');
			$Validacion->Numero('Registro', ucwords('solo se aceptan datos númericos'));
			$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form', 'CargarContenido', NeuralRutasApp::RutaURL('Ajax_Consultas/BuscarRegistro/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
			$Script[] = $Validacion->MostrarValidacion('Form');
			
			$Parametros = AyudasSessiones::InformacionSessionControlador(true);
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
			$Plantilla->ParametrosEtiquetas('Titulo', 'Consulta de Registro');
			$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
			echo $Plantilla->MostrarPlantilla('Consultas/Formulario.html', 'GESTION');
		}
	}