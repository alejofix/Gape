<?php
	class Ajax_Consultas_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
		}
		
		public function ConsultarRegistro($Id = false) {
			if($Id == true AND is_numeric($Id) == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_general');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_general', false, array('Id' => 'Registro', 'Tipo_Reporte' => 'Reporte')));
				$Consulta->AgregarCondicion("Id = '$Id'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ConsultarSeguimiento($Registro = false) {
			if($Registro == true AND is_numeric($Registro) == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_gestion_seguimiento');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_seguimiento', array('Id', 'Estado')));
				$Consulta->AgregarCondicion("Registro = '$Registro'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListadoNotas($Registro = false) {
			if($Registro == true AND is_numeric($Registro) == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_gestion_seguimiento_notas');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_seguimiento_notas', array('Id')));
				$Consulta->CrearConsulta('tbl_sistema_usuarios');
				$Consulta->AgregarColumnas("CONCAT(tbl_sistema_usuarios.Nombres, ' ', tbl_sistema_usuarios.Apellidos) AS Nombre");
				$Consulta->AgregarCondicion("tbl_gestion_seguimiento_notas.Registro = '$Registro'");
				$Consulta->AgregarCondicion("tbl_gestion_seguimiento_notas.Usuario = tbl_sistema_usuarios.Usuario");
				$Consulta->AgregarOrdenar('tbl_gestion_seguimiento_notas.Fecha ASC, tbl_gestion_seguimiento_notas.Hora', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		/**
		 * Metodo Privado
		 * ListarColumnas($Tabla = false, $Omitidos = false)
		 * 
		 * @param $Alias: es un array asociativo
		 * @example array('Columna' => 'Alias')
		 */
		private function ListarColumnasTabla($Tabla = false, $Omitidos = false, $Alias = false) {
			if($Tabla == true) {
				$Consulta = new NeuralBDConsultas;
				$Lista = $Consulta->ExecuteQueryManual('GESTION', "DESCRIBE $Tabla");
				$Cantidad = count($Lista);
				$Matriz = (is_array($Omitidos) == true) ? array_flip($Omitidos) : array();
				$AliasBase = (is_array($Alias) == true) ? $Alias : array();
				for ($i=0; $i<$Cantidad; $i++) {
					if(array_key_exists($Lista[$i]['Field'], $Matriz) == false) {
						if(array_key_exists($Lista[$i]['Field'], $AliasBase) == true) {
							$Columna[] = $Tabla.'.'.$Lista[$i]['Field'].' AS '.$AliasBase[$Lista[$i]['Field']];
						}
						else {
							$Columna[] = $Tabla.'.'.$Lista[$i]['Field'];
						}
					}
				}
				return implode(', ', $Columna);
			}
		}
	}