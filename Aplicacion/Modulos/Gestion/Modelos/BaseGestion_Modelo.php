<?php
	class BaseGestion_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		public function ListarAsesoresAsignados($Usuario = false) {
			if($Usuario == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_gestion_asesor_asignado');
				$Consulta->CrearConsulta('tbl_gestion_asesores');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_asesores', array('Id', 'Estado')));
				$Consulta->AgregarCondicion("tbl_gestion_asesor_asignado.Usuario = '$Usuario'");
				$Consulta->AgregarCondicion("tbl_gestion_asesor_asignado.Estado = 'ACTIVO'");
				$Consulta->AgregarCondicion('tbl_gestion_asesor_asignado.Asesor = tbl_gestion_asesores.Usuario');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ConsultarAsesor($Asesor = false) {
			if($Asesor == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_gestion_asesores');
				$Consulta->AgregarColumnas('Id');
				$Consulta->AgregarCondicion("Usuario = '$Asesor'");
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListarMarcasCablem($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_equipo');
				$Consulta->AgregarColumnas('Marca');
				$Consulta->AgregarAgrupar('Marca');
				$Consulta->AgregarOrdenar('Marca');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		public function ListadoSintomas($Reporte = false) {
			if($Reporte == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_sintoma');
				$Consulta->AgregarColumnas('Sintoma');
				$Consulta->AgregarCondicion("Tipo_Reporte = '$Reporte'");
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Sintoma');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListadoSoftswitch($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_softswitch');
				$Consulta->AgregarColumnas('Nombre');
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Nombre');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListarPaqueteTv($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_paquete_tv');
				$Consulta->AgregarColumnas('Paquete');
				$Consulta->AgregarAgrupar('Paquete');
				$Consulta->AgregarOrdenar('Paquete');
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