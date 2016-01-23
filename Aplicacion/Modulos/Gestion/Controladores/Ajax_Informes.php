<?php
	class Ajax_Informes extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			exit('Gestion No Permitida');
		}
		
		public function Dia($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ConsolidadoDia($DatosPost['Fecha']));
					$Plantilla->AgregarFuncion('PieFormatoTipoReporte', function($Array) {
						for ($i=0; $i<$Array['Cantidad']; $i++) {
							$Columna = $Array[$i]['Tipo_Reporte'];
							$Valor = $Array[$i]['Cantidad'];
							$Lista[] = "['$Columna', $Valor]";
						}
						return implode(', ', $Lista);
					});
					$Plantilla->AgregarFuncion('PieFormatoSintomas', function($Array) {
						$Cantidad = count($Array);
						for ($i=0; $i<$Cantidad; $i++) {
							$Columna = $Array[$i]['Sintoma'];
							$Valor = $Array[$i]['Cantidad'];
							$Lista[] = "['$Columna', $Valor]";
						}
						return implode(', ', $Lista);
					});
					echo $Plantilla->MostrarPlantilla('Ajax/Informes/Dia/Informe.html', 'GESTION');
				}
			}
		}
		
		public function Mes($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ConsolidadoMes($DatosPost['Fecha']));
					$Plantilla->AgregarFuncion('OrdenarFecha', function($Array) {
						for($i=0; $i<$Array['Cantidad']; $i++) {
							$Texto[] = "'".$Array[$i]['Fecha']."'";
						}
						return implode(', ', $Texto);
					});
					$Plantilla->AgregarFuncion('OrdenarFechaCantidad', function($Array) {
						for($i=0; $i<$Array['Cantidad']; $i++) {
							$Texto[] = $Array[$i]['Cantidad'];
						}
						return implode(', ', $Texto);
					});
					$Plantilla->AgregarFuncion('PieFormatoTipoReporte', function($Array) {
						for ($i=0; $i<$Array['Cantidad']; $i++) {
							$Columna = $Array[$i]['Tipo_Reporte'];
							$Valor = $Array[$i]['Cantidad'];
							$Lista[] = "['$Columna', $Valor]";
						}
						return implode(', ', $Lista);
					});
					$Plantilla->AgregarFuncion('PieFormatoSintomas', function($Array) {
						$Cantidad = count($Array);
						for ($i=0; $i<$Cantidad; $i++) {
							$Columna = $Array[$i]['Sintoma'];
							$Valor = $Array[$i]['Cantidad'];
							$Lista[] = "['$Columna', $Valor]";
						}
						return implode(', ', $Lista);
					});
					echo $Plantilla->MostrarPlantilla('Ajax/Informes/Mes/Informe.html', 'GESTION');
					
				}
			}
		}
	}