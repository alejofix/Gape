<?php
	
	class Error extends Controlador {
		
		function __Construct() {
			parent::__Construct();
		}
		
		public function Index() {
			
			$Plantilla = new NeuralPlantillasTwig;
			echo $Plantilla->MostrarPlantilla('Errores/Personalizado/404.html');
		}
		
		public function NoPermiso() {
			$Plantilla = new NeuralPlantillasTwig;
			echo $Plantilla->MostrarPlantilla('Errores/Personalizado/NoPermisos.html');
		}
	}