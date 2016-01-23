<?php
	class AdminContenido extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Gestión Sintomas');
			echo $Plantilla->MostrarPlantilla('AdminContenido/Index.html', 'GESTION');
		}
		
		public function SintomaTelevision() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Sintomas Televisión');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/SintomaTelevision.html', 'GESTION');
		}
		
		public function SintomaInternet() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Sintomas Internet');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/SintomaInternet.html', 'GESTION');
		}
		
		public function SintomaTelefonia() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Sintomas Telefonia');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/SintomaTelefonia.html', 'GESTION');
		}
		
		public function SintomaMiClaro() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Sintomas Mi Claro');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/SintomaMiClaro.html', 'GESTION');
		}
		
		public function SintomaMasivos() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Sintomas Masivos');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/SintomaMasivos.html', 'GESTION');
		}
		
		public function SintomaLLS() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Sintomas LLS');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/SintomaLLS.html', 'GESTION');
		}
		
		public function SintomaIIMS() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Sintomas IIMS');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/SintomaIIMS.html', 'GESTION');
		}
        //fix
      	public function SintomaCorreo() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Sintomas Correo');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/SintomaCorreo.html', 'GESTION');
		}  
 		//end fix
		public function PaqueteTelevision() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Paquete Televisión');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/Dependiente/PaqueteTelevision.html', 'GESTION');
		}
		
		public function InternetMarcaModelo() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Cablemodems');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/Dependiente/Cablemodem.html', 'GESTION');
		}
		
		public function InternetFirmware() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Firmware');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/Dependiente/Firmware.html', 'GESTION');
		}
		
		public function LLServicioAfectado() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Servicio Afectado');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/Dependiente/LLServicioAfectado.html', 'GESTION');
		}
		
		public function TelefoniaSoftswitch() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Softswitch Telefonia');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminContenido/Dependiente/TelefoniaSoftswitch.html', 'GESTION');
		}
	}