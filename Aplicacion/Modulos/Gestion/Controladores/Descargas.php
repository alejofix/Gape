<?php
	class Descargas extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
			ini_set('max_execution_time', 0);
		}
		
		public function Index() {
		
			header("Location: ".NeuralRutasApp::RutaURL('Descargas/Diaria'));
			exit();
		}
		
		public function Diaria() {
			
			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('Fecha', 'Seleccione La Fecha Correspondiente');
			$Validacion->Fecha('Fecha', 'El Formato de Fecha debe Ser Año-Mes-Dia Ej: '.date("Y-m-d"));
			$Script[] = $Validacion->MostrarValidacion('Form');
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Descarga Diaria');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
			echo $Plantilla->MostrarPlantilla('Descargas/Diaria.html', 'GESTION');
		}
		
		public function ProcesarDiaria($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					$InfoSession = AyudasSessiones::InformacionSessionControlador(true);
					$Consulta = $this->Modelo->Diario($DatosPost['Fecha']);
					if($Consulta['Cantidad']>=1) {
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator($InfoSession['Nombre'])
													->setLastModifiedBy($InfoSession['Nombre'])
													->setTitle("Descarga de La Base del Dia ".$DatosPost['Fecha'])
													->setSubject("Descarga de La Base del Dia ".$DatosPost['Fecha'])
													->setDescription("Descarga de La Base del Dia ".$DatosPost['Fecha'])
													->setKeywords("Base Diaria")
													->setCategory("Base Diaria");
													
						$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue('A1', 'Consecutivo')
									->setCellValue('B1', 'Fecha')
									->setCellValue('C1', 'Hora')
									->setCellValue('D1', 'Asesor')
									->setCellValue('E1', 'Nombres del Asesor')
									->setCellValue('F1', 'Apellidos del Asesor')
									->setCellValue('G1', 'Usuario Experto')
									->setCellValue('H1', 'Nombres del Experto')
									->setCellValue('I1', 'Apellidos del Experto')
									->setCellValue('J1', 'Tipo de Reporte')
									->setCellValue('K1', 'Cuenta')
									->setCellValue('L1', 'MAC')
									->setCellValue('M1', 'Marca')
									->setCellValue('N1', 'Modelo')
									->setCellValue('O1', 'Firmware')
									->setCellValue('P1', 'Sintoma')
									->setCellValue('Q1', 'Observaciones')
									->setCellValue('R1', 'Seguimiento')
									->setCellValue('S1', 'Softswitch')
									->setCellValue('T1', 'Nodo')
									->setCellValue('U1', 'Paquete')
									->setCellValue('V1', 'Aviso')
									->setCellValue('W1', 'CMTS')
									->setCellValue('X1', 'Paso del IIMS');
									
						for ($i=0; $i<$Consulta['Cantidad']; $i++) {
							$Contador = $i+2;
							$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A'.$Contador, self::FormatoDatos($Consulta[$i]['Consecutivo']))
										->setCellValue('B'.$Contador, self::FormatoDatos($Consulta[$i]['Fecha']))
										->setCellValue('C'.$Contador, self::FormatoDatos($Consulta[$i]['Hora']))
										->setCellValue('D'.$Contador, self::FormatoDatos($Consulta[$i]['Asesor']))
										->setCellValue('E'.$Contador, self::FormatoDatos($Consulta[$i]['Nombres_Asesor']))
										->setCellValue('F'.$Contador, self::FormatoDatos($Consulta[$i]['Apellidos_Asesor']))
										->setCellValue('G'.$Contador, self::FormatoDatos($Consulta[$i]['Usuario']))
										->setCellValue('H'.$Contador, self::FormatoDatos($Consulta[$i]['Nombres_Usuario']))
										->setCellValue('I'.$Contador, self::FormatoDatos($Consulta[$i]['Apellidos_Usuarios']))
										->setCellValue('J'.$Contador, self::FormatoDatos($Consulta[$i]['Tipo_Reporte']))
										->setCellValue('K'.$Contador, self::FormatoDatos($Consulta[$i]['Cuenta']))
										->setCellValue('L'.$Contador, self::FormatoDatos($Consulta[$i]['MAC']))
										->setCellValue('M'.$Contador, self::FormatoDatos($Consulta[$i]['Marca']))
										->setCellValue('N'.$Contador, self::FormatoDatos($Consulta[$i]['Modelo']))
										->setCellValue('O'.$Contador, self::FormatoDatos($Consulta[$i]['Firmware']))
										->setCellValue('P'.$Contador, self::FormatoDatos($Consulta[$i]['Sintoma']))
										->setCellValue('Q'.$Contador, self::FormatoDatos($Consulta[$i]['Observaciones']))
										->setCellValue('R'.$Contador, self::FormatoDatos($Consulta[$i]['Seguimiento']))
										->setCellValue('S'.$Contador, self::FormatoDatos($Consulta[$i]['Softswitch']))
										->setCellValue('T'.$Contador, self::FormatoDatos($Consulta[$i]['Nodo']))
										->setCellValue('U'.$Contador, self::FormatoDatos($Consulta[$i]['Paquete']))
										->setCellValue('V'.$Contador, self::FormatoDatos($Consulta[$i]['Aviso']))
										->setCellValue('W'.$Contador, self::FormatoDatos($Consulta[$i]['CMTS']))
										->setCellValue('X'.$Contador, self::FormatoDatos($Consulta[$i]['IIMS_Paso']));
						}
						
						$objPHPExcel->getActiveSheet()->setTitle('Base Dia '.$DatosPost['Fecha']);
						$objPHPExcel->setActiveSheetIndex(0);
						$NombreArchivo = $InfoSession['Usuario'].'_Dia_'.$InfoSession['Fecha']['wday'].'_'.$InfoSession['Fecha']['mday'].'_'.$InfoSession['Fecha']['mon'].'_'.$InfoSession['Fecha']['year'];
						header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
						header("Content-Disposition: attachment;filename=\"$NombreArchivo.xlsx\"");
						header('Cache-Control: max-age=0');
						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('php://output');
						exit();
					}
					else {
						$Plantilla = new NeuralPlantillasTwig;
						$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
						$Plantilla->ParametrosEtiquetas('Titulo', 'Descarga Diaria');
						$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
						echo $Plantilla->MostrarPlantilla('Descargas/NoHayDatos.html', 'GESTION');
					}
				}
				else {
					echo 'Hay Datos Vacios Validar la Informacion';
				}
			}
		}
		
		public function Mensual() {
			
			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('Fecha', 'Seleccione La Fecha Correspondiente');
			$Validacion->Fecha('Fecha', 'El Formato de Fecha debe Ser Año-Mes Ej: '.date("Y-m"));
			$Script[] = $Validacion->MostrarValidacion('Form');
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Descarga Mensual');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
			echo $Plantilla->MostrarPlantilla('Descargas/Mensual.html', 'GESTION');
		}
		
		private static function getUltimoDiaMes($Fecha = false) {
			if($Fecha == true) {
				$Formato = explode("-", $Fecha);
				return $Fecha.'-'.date("d",(mktime(0,0,0,$Formato[1]+1,1,$Formato[0])-1));
			}
		}
		
		public function ProcesarMensual($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == date("Y-m-d")) {
				if(AyudasPost::DatosVacios($_POST) == false) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					$FechaInicio = $DatosPost['Fecha'].'01';
					$FechaFin = self::getUltimoDiaMes($DatosPost['Fecha']);
					$InfoSession = AyudasSessiones::InformacionSessionControlador(true);
					$Consulta = $this->Modelo->Mensual($FechaInicio, $FechaFin);
					if($Consulta['Cantidad']>=1) {
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator($InfoSession['Nombre'])
													->setLastModifiedBy($InfoSession['Nombre'])
													->setTitle("Descarga de La Base del Mes ".$DatosPost['Fecha'])
													->setSubject("Descarga de La Base del Mes ".$DatosPost['Fecha'])
													->setDescription("Descarga de La Base del Mes ".$DatosPost['Fecha'])
													->setKeywords("Base Mensual")
													->setCategory("Base Mensual");
													
						$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue('A1', 'Consecutivo')
									->setCellValue('B1', 'Fecha')
									->setCellValue('C1', 'Hora')
									->setCellValue('D1', 'Asesor')
									->setCellValue('E1', 'Nombres del Asesor')
									->setCellValue('F1', 'Apellidos del Asesor')
									->setCellValue('G1', 'Usuario Experto')
									->setCellValue('H1', 'Nombres del Experto')
									->setCellValue('I1', 'Apellidos del Experto')
									->setCellValue('J1', 'Tipo de Reporte')
									->setCellValue('K1', 'Cuenta')
									->setCellValue('L1', 'MAC')
									->setCellValue('M1', 'Marca')
									->setCellValue('N1', 'Modelo')
									->setCellValue('O1', 'Firmware')
									->setCellValue('P1', 'Sintoma')
									->setCellValue('Q1', 'Observaciones')
									->setCellValue('R1', 'Seguimiento')
									->setCellValue('S1', 'Softswitch')
									->setCellValue('T1', 'Nodo')
									->setCellValue('U1', 'Paquete')
									->setCellValue('V1', 'Aviso')
									->setCellValue('W1', 'CMTS')
									->setCellValue('X1', 'Paso del IIMS');
									
						for ($i=0; $i<$Consulta['Cantidad']; $i++) {
							$Contador = $i+2;
							$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A'.$Contador, self::FormatoDatos($Consulta[$i]['Consecutivo']))
										->setCellValue('B'.$Contador, self::FormatoDatos($Consulta[$i]['Fecha']))
										->setCellValue('C'.$Contador, self::FormatoDatos($Consulta[$i]['Hora']))
										->setCellValue('D'.$Contador, self::FormatoDatos($Consulta[$i]['Asesor']))
										->setCellValue('E'.$Contador, self::FormatoDatos($Consulta[$i]['Nombres_Asesor']))
										->setCellValue('F'.$Contador, self::FormatoDatos($Consulta[$i]['Apellidos_Asesor']))
										->setCellValue('G'.$Contador, self::FormatoDatos($Consulta[$i]['Usuario']))
										->setCellValue('H'.$Contador, self::FormatoDatos($Consulta[$i]['Nombres_Usuario']))
										->setCellValue('I'.$Contador, self::FormatoDatos($Consulta[$i]['Apellidos_Usuarios']))
										->setCellValue('J'.$Contador, self::FormatoDatos($Consulta[$i]['Tipo_Reporte']))
										->setCellValue('K'.$Contador, self::FormatoDatos($Consulta[$i]['Cuenta']))
										->setCellValue('L'.$Contador, self::FormatoDatos($Consulta[$i]['MAC']))
										->setCellValue('M'.$Contador, self::FormatoDatos($Consulta[$i]['Marca']))
										->setCellValue('N'.$Contador, self::FormatoDatos($Consulta[$i]['Modelo']))
										->setCellValue('O'.$Contador, self::FormatoDatos($Consulta[$i]['Firmware']))
										->setCellValue('P'.$Contador, self::FormatoDatos($Consulta[$i]['Sintoma']))
										->setCellValue('Q'.$Contador, self::FormatoDatos($Consulta[$i]['Observaciones']))
										->setCellValue('R'.$Contador, self::FormatoDatos($Consulta[$i]['Seguimiento']))
										->setCellValue('S'.$Contador, self::FormatoDatos($Consulta[$i]['Softswitch']))
										->setCellValue('T'.$Contador, self::FormatoDatos($Consulta[$i]['Nodo']))
										->setCellValue('U'.$Contador, self::FormatoDatos($Consulta[$i]['Paquete']))
										->setCellValue('V'.$Contador, self::FormatoDatos($Consulta[$i]['Aviso']))
										->setCellValue('W'.$Contador, self::FormatoDatos($Consulta[$i]['CMTS']))
										->setCellValue('X'.$Contador, self::FormatoDatos($Consulta[$i]['IIMS_Paso']));
						}
						
						$objPHPExcel->getActiveSheet()->setTitle('Base Mes '.$DatosPost['Fecha']);
						$objPHPExcel->setActiveSheetIndex(0);
						$NombreArchivo = $InfoSession['Usuario'].'_Mes_'.$InfoSession['Fecha']['wday'].'_'.$InfoSession['Fecha']['mday'].'_'.$InfoSession['Fecha']['mon'].'_'.$InfoSession['Fecha']['year'];
						header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
						header("Content-Disposition: attachment;filename=\"$NombreArchivo.xlsx\"");
						header('Cache-Control: max-age=0');
						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('php://output');
						exit();
					}
					else {
						$Plantilla = new NeuralPlantillasTwig;
						$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
						$Plantilla->ParametrosEtiquetas('Titulo', 'Descarga Diaria');
						$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
						echo $Plantilla->MostrarPlantilla('Descargas/NoHayDatos.html', 'GESTION');
					}
				}
				else {
					echo 'Hay Datos Vacios Validar la Informacion';
				}
			}
		}
		
		private function FormatoDatos($Valor) {
			if($Valor == null) {
				return 'NULL';
			}
			elseif(empty($Valor) == true) {
				return 'NULL';
			}
			else {
				return $Valor;
			}
		}
		
		public function Seguimientos() {
			
			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('Fecha', 'Seleccione La Fecha Correspondiente');
			$Validacion->Fecha('Fecha', 'El Formato de Fecha debe Ser Año-Mes Ej: '.date("Y-m"));
			$Script[] = $Validacion->MostrarValidacion('Form');
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Descarga Seguimientos');
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
			echo $Plantilla->MostrarPlantilla('Descargas/Seguimientos.html', 'GESTION');
		}
		
		public function ProcesarSeguimientos($Validacion = false) {
			if($Validacion == true AND AyudasConversorHexAscii::HEX_ASCII($Validacion) == true) {
				if(AyudasPost::DatosVacios($_POST) == false AND isset($_POST) == true) {
					$DatosPost = AyudasPost::FormatoEspacio(AyudasPost::LimpiarInyeccionSQL($_POST));
					$FechaInicio = $DatosPost['Fecha'].'-01';
					$FechaFin = self::getUltimoDiaMes($DatosPost['Fecha']);
					$InfoSession = AyudasSessiones::InformacionSessionControlador(true);
					$Conexion = NeuralConexionBaseDatos::ObtenerConexionBase('GESTION');
					$Consulta = $this->Modelo->Seguimiento($FechaInicio, $FechaFin, $DatosPost['Estado'], $Conexion);
					$Notas = $this->Modelo->Notas($FechaInicio, $FechaFin, $Consulta, $Conexion);
					//Ayudas::print_r($Consulta);
					//Ayudas::print_r($Notas);
					if($Consulta['Cantidad']>=1) {
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator($InfoSession['Nombre'])
													->setLastModifiedBy($InfoSession['Nombre'])
													->setTitle("Descarga de Seguimientos del Mes ".$DatosPost['Fecha'])
													->setSubject("Descarga de Seguimientos del Mes ".$DatosPost['Fecha'])
													->setDescription("Descarga de Seguimientos del Mes ".$DatosPost['Fecha'])
													->setKeywords("Base Seguimientos")
													->setCategory("Base Seguimientos");
						//Seguimientos Notas
						if($Notas['Cantidad']>=1) {
							$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A1', 'Id Nota')
										->setCellValue('B1', 'Registro')
										->setCellValue('C1', 'Notas')
										->setCellValue('D1', 'Fecha')
										->setCellValue('E1', 'Hora')
										->setCellValue('F1', 'Usuario');
							for ($j=0; $j<$Notas['Cantidad']; $j++) {
								$Contador = $j+2;
								$objPHPExcel->setActiveSheetIndex(0)
											->setCellValue('A'.$Contador, self::FormatoDatos($Notas[$j]['Id']))
											->setCellValue('B'.$Contador, self::FormatoDatos($Notas[$j]['Registro']))
											->setCellValue('C'.$Contador, self::FormatoDatos($Notas[$j]['Notas']))
											->setCellValue('D'.$Contador, self::FormatoDatos($Notas[$j]['Fecha']))
											->setCellValue('E'.$Contador, self::FormatoDatos($Notas[$j]['Hora']))
											->setCellValue('F'.$Contador, self::FormatoDatos($Notas[$j]['Usuario']));
							}
							$objPHPExcel->getActiveSheet()->setTitle('Notas Seguimientos');
							$objPHPExcel->setActiveSheetIndex(0);
							$objPHPExcel->createSheet();
						}
						
						$objPHPExcel->setActiveSheetIndex(1)
									->setCellValue('A1', 'Consecutivo Seguimiento')
									->setCellValue('B1', 'Fecha de Inicio')
									->setCellValue('C1', 'Fecha de Finalización')
									->setCellValue('D1', 'Registro')
									->setCellValue('E1', 'Observaciones')
									->setCellValue('F1', 'Tipo de Reporte')
									->setCellValue('G1', 'Estado')
									->setCellValue('H1', 'Usuario Experto')
									->setCellValue('I1', 'Nombre del Experto')
									->setCellValue('J1', 'Apellidos del Experto');
						
						for ($i=0; $i<$Consulta['Cantidad']; $i++) {
							$Contador = $i+2;
							$objPHPExcel->setActiveSheetIndex(1)
										->setCellValue('A'.$Contador, self::FormatoDatos($Consulta[$i]['Consecutivo_Seguimiento']))
										->setCellValue('B'.$Contador, self::FormatoDatos($Consulta[$i]['Fecha_Inicio']))
										->setCellValue('C'.$Contador, self::FormatoDatos($Consulta[$i]['Fecha_Fin']))
										->setCellValue('D'.$Contador, self::FormatoDatos($Consulta[$i]['Registro']))
										->setCellValue('E'.$Contador, self::FormatoDatos($Consulta[$i]['Observaciones']))
										->setCellValue('F'.$Contador, self::FormatoDatos($Consulta[$i]['TipoReporte']))
										->setCellValue('G'.$Contador, self::FormatoDatos($Consulta[$i]['Estado']))
										->setCellValue('H'.$Contador, self::FormatoDatos($Consulta[$i]['Experto']))
										->setCellValue('I'.$Contador, self::FormatoDatos($Consulta[$i]['Nombre']))
										->setCellValue('J'.$Contador, self::FormatoDatos($Consulta[$i]['Apellido']));
						}
						
						$objPHPExcel->getActiveSheet()->setTitle('Base Seguimiento '.$DatosPost['Fecha']);
						$objPHPExcel->setActiveSheetIndex(1);
						
						$NombreArchivo = $InfoSession['Usuario'].'_Seguimientos_'.$InfoSession['Fecha']['wday'].'_'.$InfoSession['Fecha']['mday'].'_'.$InfoSession['Fecha']['mon'].'_'.$InfoSession['Fecha']['year'];
						header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
						header("Content-Disposition: attachment;filename=\"$NombreArchivo.xlsx\"");
						header('Cache-Control: max-age=0');
						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('php://output');
						exit();
					}
					else {
						$Plantilla = new NeuralPlantillasTwig;
						$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
						$Plantilla->ParametrosEtiquetas('Titulo', 'Descarga Seguimientos');
						$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
						echo $Plantilla->MostrarPlantilla('Descargas/NoHayDatos.html', 'GESTION');
					}
				}
				else {
						$Plantilla = new NeuralPlantillasTwig;
						$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
						$Plantilla->ParametrosEtiquetas('Titulo', 'Descarga Seguimientos');
						$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
						echo $Plantilla->MostrarPlantilla('Descargas/NoHayDatos.html', 'GESTION');
				}
			}
		}
	}