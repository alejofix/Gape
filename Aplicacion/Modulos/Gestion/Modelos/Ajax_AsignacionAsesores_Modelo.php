<?php
	class Ajax_AsignacionAsesores_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
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
		
		public function GestionAsignacionUsuario($Id = false, $Estado = false, $Usuario = false) {
			if($Id == true AND $Estado == true AND $Usuario == true) {
				$DatosAsesor = self::DatosAsesor($Id);
				if($DatosAsesor['Cantidad']>=1) {
					$DatosAsesorAsignacion = self::DatosAsignacion($Usuario, $DatosAsesor[0]['Usuario']);
					if($DatosAsesorAsignacion['Cantidad']>=1) {
						self::ActualizarEstado($DatosAsesorAsignacion[0]['Id'], $Estado);
					}
					else {
						self::AgregarAsesorBase($Usuario, $DatosAsesor[0], $Estado);
					}
				}
			}
		}
		
		private function AgregarAsesorBase($Usuario = false, $DatosAsesor = false, $Estado = false) {
			$SQL = new NeuralBDGab;
			$SQL->SeleccionarDestino('GESTION', 'tbl_gestion_asesor_asignado');
			$SQL->AgregarSentencia('Asesor', $DatosAsesor['Usuario']);
			$SQL->AgregarSentencia('Usuario', $Usuario);
			$SQL->AgregarSentencia('Estado', $Estado);
			$SQL->InsertarDatos();
		}
		
		private function ActualizarEstado($Id = false, $Estado = false) {
			$SQL = new NeuralBDGab;
			$SQL->SeleccionarDestino('GESTION', 'tbl_gestion_asesor_asignado');
			$SQL->AgregarSentencia('Estado', $Estado);
			$SQL->AgregarCondicion('Id', $Id);
			$SQL->ActualizarDatos();
		}
		
		private function DatosAsignacion($Usuario = false, $Asesor = false) {
			$Consulta = new NeuralBDConsultas;
			$Consulta->CrearConsulta('tbl_gestion_asesor_asignado');
			$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_asesor_asignado'));
			$Consulta->AgregarCondicion("Asesor = '$Asesor'");
			$Consulta->AgregarCondicion("Usuario = '$Usuario'");
			$Consulta->PrepararCantidadDatos('Cantidad');
			$Consulta->PrepararQuery();
			return $Consulta->ExecuteConsulta('GESTION');
		}
		
		private function DatosAsesor($Id = false) {
			$Consulta = new NeuralBDConsultas;
			$Consulta->CrearConsulta('tbl_gestion_asesores');
			$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_asesores'));
			$Consulta->AgregarCondicion("Id = '$Id'");
			$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
			$Consulta->PrepararCantidadDatos('Cantidad');
			$Consulta->PrepararQuery();
			return $Consulta->ExecuteConsulta('GESTION');
		}
	}