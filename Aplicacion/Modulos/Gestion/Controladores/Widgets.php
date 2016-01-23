<?php
	class Widgets extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {}
			else { header("Location: ".NeuralRutasApp::RutaURL('Central')); exit(); }
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			
			$Informacion = AyudasSessiones::InformacionSessionControlador(true);
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('Seguimientos', $this->Modelo->ConsultaSeguimientos($Informacion['Usuario']));
			$Plantilla->ParametrosEtiquetas('GestionesGlobales', $this->Modelo->GestionesGlobales(true));
			$Plantilla->ParametrosEtiquetas('GestionesUsuario', $this->Modelo->ConsultaGestionUsuario($Informacion['Usuario']));
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			echo $Plantilla->MostrarPlantilla('Widgets/Widgets.html', 'GESTION', true);
		}
	}