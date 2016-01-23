<?php
	class Descargas_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();

		}
		
		public function Diario($Fecha = false) {
			if($Fecha == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_general');
				$Consulta->CrearConsulta('tbl_sistema_usuarios');
				$Consulta->CrearConsulta('tbl_gestion_asesores');
				$Consulta->AgregarColumnas('tbl_base_general.Id AS Consecutivo, tbl_base_general.Fecha, tbl_base_general.Hora, tbl_base_general.Asesor');
				$Consulta->AgregarColumnas('tbl_gestion_asesores.Nombres AS Nombres_Asesor, tbl_gestion_asesores.Apellidos AS Apellidos_Asesor');
				$Consulta->AgregarColumnas('tbl_base_general.Usuario');
				$Consulta->AgregarColumnas('tbl_sistema_usuarios.Nombres AS Nombres_Usuario, tbl_sistema_usuarios.Apellidos AS Apellidos_Usuarios');
				$Consulta->AgregarColumnas('tbl_base_general.Tipo_Reporte, tbl_base_general.Cuenta, tbl_base_general.MAC, tbl_base_general.Marca, tbl_base_general.Modelo, tbl_base_general.Firmware, tbl_base_general.Sintoma, tbl_base_general.Observaciones, tbl_base_general.Seguimiento, tbl_base_general.Softswitch, tbl_base_general.Nodo, tbl_base_general.Paquete, tbl_base_general.Aviso, tbl_base_general.CMTS, tbl_base_general.IIMS_Paso');
				$Consulta->AgregarCondicion("tbl_base_general.Fecha = '$Fecha'");
				$Consulta->AgregarCondicion("tbl_base_general.Asesor = tbl_gestion_asesores.Usuario");
				$Consulta->AgregarCondicion("tbl_base_general.Usuario = tbl_sistema_usuarios.Usuario");
				$Consulta->AgregarOrdenar('tbl_base_general.Fecha', 'ASC');
				$Consulta->PrepararCantidadDatos('Cantidad');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function Mensual($FechaInicio = false, $FechaFin = false) {
			if($FechaInicio == true AND $FechaFin == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_general');
				$Consulta->CrearConsulta('tbl_sistema_usuarios');
				$Consulta->CrearConsulta('tbl_gestion_asesores');
				$Consulta->AgregarColumnas('tbl_base_general.Id AS Consecutivo, tbl_base_general.Fecha, tbl_base_general.Hora, tbl_base_general.Asesor');
				$Consulta->AgregarColumnas('tbl_gestion_asesores.Nombres AS Nombres_Asesor, tbl_gestion_asesores.Apellidos AS Apellidos_Asesor');
				$Consulta->AgregarColumnas('tbl_base_general.Usuario');
				$Consulta->AgregarColumnas('tbl_sistema_usuarios.Nombres AS Nombres_Usuario, tbl_sistema_usuarios.Apellidos AS Apellidos_Usuarios');
				$Consulta->AgregarColumnas('tbl_base_general.Tipo_Reporte, tbl_base_general.Cuenta, tbl_base_general.MAC, tbl_base_general.Marca, tbl_base_general.Modelo, tbl_base_general.Firmware, tbl_base_general.Sintoma, tbl_base_general.Observaciones, tbl_base_general.Seguimiento, tbl_base_general.Softswitch, tbl_base_general.Nodo, tbl_base_general.Paquete, tbl_base_general.Aviso, tbl_base_general.CMTS, tbl_base_general.IIMS_Paso');
				$Consulta->AgregarCondicion("tbl_base_general.Fecha BETWEEN '$FechaInicio' AND '$FechaFin'");
				$Consulta->AgregarCondicion("tbl_base_general.Asesor = tbl_gestion_asesores.Usuario");
				$Consulta->AgregarCondicion("tbl_base_general.Usuario = tbl_sistema_usuarios.Usuario");
				$Consulta->AgregarOrdenar('tbl_base_general.Fecha', 'ASC');
				$Consulta->PrepararCantidadDatos('Cantidad');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function Seguimiento($FechaInicio = false, $FechaFin = false, $Estado = false, $Conexion = false) {
			if($FechaInicio == true AND $FechaFin == true AND $Estado == true AND $Conexion == true) {
				return self::ListadoSeguimientos($FechaInicio, $FechaFin, $Estado, $Conexion);
			}
		}
		
		private function ListadoSeguimientos($FechaInicio = false, $FechaFin = false, $Estado = false, $Conexion = false) {
			
			$Consulta = new NeuralBDConsultas;
			$Consulta->CrearConsulta('tbl_gestion_seguimiento');
			$Consulta->CrearConsulta('tbl_sistema_usuarios');
			$Consulta->AgregarColumnas('tbl_gestion_seguimiento.Id AS Consecutivo_Seguimiento, tbl_gestion_seguimiento.Fecha_Inicio, tbl_gestion_seguimiento.Fecha_Fin, tbl_gestion_seguimiento.Registro, tbl_gestion_seguimiento.Observaciones, tbl_gestion_seguimiento.TipoReporte, tbl_gestion_seguimiento.Estado');
			$Consulta->AgregarColumnas('tbl_gestion_seguimiento.Usuario AS Experto, tbl_sistema_usuarios.Nombres AS Nombre, tbl_sistema_usuarios.Apellidos AS Apellido');
			if($Estado == 'ACTIVO' OR $Estado == 'INACTIVO') {
				$Consulta->AgregarCondicion("tbl_gestion_seguimiento.Estado = '$Estado'");
			}
			$Consulta->AgregarCondicion("tbl_gestion_seguimiento.Fecha_Inicio BETWEEN '$FechaInicio' AND '$FechaFin'");
			$Consulta->AgregarCondicion("tbl_gestion_seguimiento.Usuario = tbl_sistema_usuarios.Usuario");
			$Consulta->AgregarOrdenar('tbl_gestion_seguimiento.Fecha_Inicio', 'ASC');
			$Consulta->PrepararCantidadDatos('Cantidad');
			$Consulta->PrepararQuery();
			return $Consulta->ExecuteConsulta($Conexion);
			
		}
		
		public function Notas($FechaInicio = false, $FechaFin = false, $Array = false, $Conexion = false) {
			if($FechaInicio == true AND $FechaFin == true AND $Array == true AND $Conexion == true) {
				if($Array['Cantidad']>=1) {
					for ($App=0; $App<$Array['Cantidad']; $App++) {
						$Data = self::ConsultaNotas($Conexion, $Array[$App]['Registro']);
						if ($Data['Cantidad']>=1) {
							for ($App2=0; $App2<$Data['Cantidad']; $App2++) {
								$Lista[] = $Data[$App2];
							}
						}
					}
					
					if(isset($Lista) == true AND is_array($Lista)) {
						return array_merge(array('Cantidad' => count($Lista)), $Lista);
					}
					else {
						return array('Cantidad' => '0');
					}
				}
			}
		}
		
		private function ConsultaNotas($Conexion = false, $Registro = false) {
			if($Conexion == true AND $Registro == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_gestion_seguimiento_notas');
				$Consulta->AgregarColumnas('tbl_gestion_seguimiento_notas.Id, tbl_gestion_seguimiento_notas.Registro, tbl_gestion_seguimiento_notas.Notas, tbl_gestion_seguimiento_notas.Fecha, tbl_gestion_seguimiento_notas.Hora, tbl_gestion_seguimiento_notas.Usuario');
				$Consulta->AgregarCondicion("tbl_gestion_seguimiento_notas.Registro = '$Registro'");
				$Consulta->AgregarOrdenar('tbl_gestion_seguimiento_notas.Fecha ASC, tbl_gestion_seguimiento_notas.Hora', 'ASC');
				$Consulta->PrepararCantidadDatos('Cantidad');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta($Conexion);
			}
		}
	}