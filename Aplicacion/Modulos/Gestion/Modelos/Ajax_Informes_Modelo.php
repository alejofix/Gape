<?php
	class Ajax_Informes_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		public function ConsolidadoDia($Fecha = false) {
			if($Fecha == true) {
				$Conexion = NeuralConexionBaseDatos::ObtenerConexionBase('GESTION');
				$TipoReporte = self::DiaConsultaTipoReporte($Conexion, $Fecha);
				return array(
					'Tipo_Reporte' => $TipoReporte, 
					'Sintomas' => self::DiaConsultaSintomas($Conexion, $TipoReporte, $Fecha)
				);
			}
		}
		
		private function DiaConsultaSintomas($Conexion = false, $Array = false, $Fecha = false) {
			if($Array['Cantidad']>=1) {
				for ($i=0; $i<$Array['Cantidad']; $i++) {
					$Reporte = $Array[$i]['Tipo_Reporte'];
					$Consulta = $Conexion->fetchAll("SELECT Sintoma, COUNT('Sintoma') AS Cantidad FROM tbl_base_general WHERE Fecha = '$Fecha' AND Tipo_Reporte = '$Reporte' GROUP BY Sintoma");
					$Lista[$Reporte] = $Consulta;
				}
				return $Lista;
			}
		}
		
		private function DiaConsultaTipoReporte($Conexion = false, $Fecha = false) {
			$Datos = $Conexion->fetchAll("SELECT Tipo_Reporte, COUNT('Id') AS Cantidad FROM tbl_base_general WHERE Fecha = '$Fecha' GROUP BY Tipo_Reporte");
			$Cantidad = count($Datos);
			return array_merge(array('Cantidad' => $Cantidad), $Datos);
		}
		
		private static function getUltimoDiaMes($Fecha = false) {
			if($Fecha == true) {
				$Formato = explode("-", $Fecha);
				return date("d",(mktime(0,0,0,$Formato[1]+1,1,$Formato[0])-1));
			}
		}
		
		public function ConsolidadoMes($Fecha = false) {
			if($Fecha == true) {
				$Conexion = NeuralConexionBaseDatos::ObtenerConexionBase('GESTION');
				$FechaInicio = $Fecha.'-01';
				$FechaFin = $Fecha.'-'.self::getUltimoDiaMes($Fecha);
				$ReportesMEs = self::TipoReportesMes($Conexion, $FechaInicio, $FechaFin);
				return array(
					'CantidadDiario' => self::CantidadReportesDiaDia($Conexion, $FechaInicio, $FechaFin),
					'TipoReportesMes' => $ReportesMEs,
					'Sintomas' => self::MesConsultaSintomas($Conexion, $ReportesMEs, $FechaInicio, $FechaFin)
				);
			}
		}
		
		private function MesConsultaSintomas($Conexion = false, $Array = false, $FechaInicio = false, $Fechafin = false) {
			if($Conexion == true AND $Array == true AND $FechaInicio == true AND $Fechafin == true) {
				for ($i=0; $i<$Array['Cantidad']; $i++) {
					$Reporte = $Array[$i]['Tipo_Reporte'];
					$Consulta = $Conexion->fetchAll("SELECT Sintoma, COUNT('Sintoma') AS Cantidad FROM tbl_base_general WHERE Tipo_Reporte = '$Reporte' AND Fecha BETWEEN '$FechaInicio' AND '$Fechafin' GROUP BY Sintoma");
					$Lista[$Reporte] = $Consulta;
				}
				return $Lista;
			}
		}
		
		private function TipoReportesMes($Conexion = false, $FechaInicio = false, $FechaFin = false) {
			if($Conexion == true AND $FechaInicio == true AND $FechaFin == true) {
				$Datos = $Conexion->fetchAll("SELECT Tipo_Reporte, COUNT(id) AS Cantidad FROM tbl_base_general WHERE Fecha BETWEEN '$FechaInicio' AND '$FechaFin' GROUP BY Tipo_Reporte");
				return array_merge(array('Cantidad' => count($Datos)), $Datos);
			}
		}
		
		private function CantidadReportesDiaDia($Conexion = false, $FechaInicio = false, $FechaFin = false) {
			if($Conexion == true AND $FechaInicio == true AND $FechaFin == true) {
				$Datos = $Conexion->fetchAll("SELECT Fecha, COUNT(id) AS Cantidad FROM tbl_base_general WHERE Fecha BETWEEN '$FechaInicio' AND '$FechaFin' GROUP BY Fecha");
				return array_merge(array('Cantidad' => count($Datos)), $Datos);
			}
		}
	}