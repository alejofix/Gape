<?php
	class Ajax_Consultas extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {}
			else { header("Location: ".NeuralRutasApp::RutaURL('Central')); exit(); }
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			exit("Asignacion Erronea");
		}
		
		public function BuscarRegistro($Validacion = false) {
			if($Validacion == true AND NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Validacion), array(date("Y-m-d"), 'GESTION')) == date("Y-m-d")) {
				$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
				if(AyudasPost::DatosVacios($DatosPost) == false) {
					if(is_numeric($DatosPost['Registro']) == true) {
						$Plantilla = new NeuralPlantillasTwig;
						$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ConsultarRegistro($DatosPost['Registro']));
						$Plantilla->ParametrosEtiquetas('Seguimiento', $this->Modelo->ConsultarSeguimiento($DatosPost['Registro']));
						$Plantilla->ParametrosEtiquetas('Notas', $this->Modelo->ListadoNotas($DatosPost['Registro']));
						$Plantilla->AgregarFuncionAnonima('FormatoSeguimiento', function ($Texto) {
							return ($Texto == 'SEGUIMIENTO') ? '<b style="color: red;">'.$Texto.'</b>': $Texto;
						});
						$Plantilla->AgregarFuncionAnonima('CambioSeguimiento', function ($Texto) {
							$Matriz = array('Fecha_Inicio' => 'Fecha de Inicio', 'Fecha_Fin' => 'Fecha de Fin', 'TipoReporte' => 'Tipo de Reporte');
							return (array_key_exists($Texto, $Matriz) == true) ? $Matriz[$Texto] : $Texto;
						});
						echo $Plantilla->MostrarPlantilla('Ajax/Consultas/Consulta.html', 'GESTION');
					}
					else {
						$Plantilla = new NeuralPlantillasTwig;
						echo $Plantilla->MostrarPlantilla('Ajax/Consultas/DatosNumericos.html', 'GESTION');
					}
				}
				else {
					$Plantilla = new NeuralPlantillasTwig;
					echo $Plantilla->MostrarPlantilla('Ajax/Consultas/DatosVacios.html', 'GESTION');
				}
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('Central'));
				exit();
			}
		}
	}