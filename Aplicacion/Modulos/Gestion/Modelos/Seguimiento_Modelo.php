<?php
    class Seguimiento_Modelo extends Modelo {
        
        function __Construct() {
            parent::__Construct();
            AyudasSessiones::ValidarSessionModelo();
        }
        
        public function ListarSeguimientosActivos($Usuario = false) {
            if($Usuario == true) {
                $Consulta = new NeuralBDConsultas;
                $Consulta->CrearConsulta('tbl_gestion_seguimiento');
                $Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_seguimiento', array('Estado', 'Fecha_Fin', 'Usuario')));
                $Consulta->CrearConsulta('tbl_base_general');
                $Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_general', array('Id')));
                $Consulta->AgregarCondicion("tbl_gestion_seguimiento.Estado = 'ACTIVO'");
                $Consulta->AgregarCondicion("tbl_gestion_seguimiento.Usuario = '$Usuario'");
                $Consulta->AgregarCondicion("tbl_gestion_seguimiento.Registro = tbl_base_general.Id");
                $Consulta->AgregarOrdenar('tbl_gestion_seguimiento.Fecha_Inicio', 'ASC');
                $Consulta->PrepararQuery();
                return $Consulta->ExecuteConsulta('GESTION');
            }
        }
        
        public function ConsultarSeguimiento($Id = false, $Usuario = false) {
        	if($Id == true AND $Usuario == true) {
        		$Consulta = new NeuralBDConsultas;
                $Consulta->CrearConsulta('tbl_gestion_seguimiento');
                $Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_seguimiento', array('Estado', 'Fecha_Fin', 'Usuario')));
                $Consulta->CrearConsulta('tbl_base_general');
                $Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_general', array('Id')));
                $Consulta->AgregarCondicion("tbl_gestion_seguimiento.Id = '$Id'");
                //$Consulta->AgregarCondicion("tbl_gestion_seguimiento.Usuario = '$Usuario'");
                $Consulta->AgregarCondicion("tbl_gestion_seguimiento.Registro = tbl_base_general.Id");
                $Consulta->AgregarOrdenar('tbl_gestion_seguimiento.Fecha_Inicio', 'ASC');
                $Consulta->PrepararQuery();
                return $Consulta->ExecuteConsulta('GESTION');
        	}
        }
        
        public function ListarNotas($Id = false) {
        	if($Id == true AND is_numeric($Id) == true) {
        		$Consulta = new NeuralBDConsultas;
        		$Consulta->CrearConsulta('tbl_gestion_seguimiento_notas');
        		$Consulta->AgregarColumnas('tbl_gestion_seguimiento_notas.Notas, tbl_gestion_seguimiento_notas.Fecha, tbl_gestion_seguimiento_notas.Hora');
        		$Consulta->CrearConsulta('tbl_sistema_usuarios');
        		$Consulta->AgregarColumnas('tbl_sistema_usuarios.Nombres, tbl_sistema_usuarios.Apellidos');
        		$Consulta->AgregarCondicion("Registro = '$Id'");
        		$Consulta->AgregarCondicion("tbl_gestion_seguimiento_notas.Usuario = tbl_sistema_usuarios.Usuario");
        		$Consulta->AgregarOrdenar('Fecha DESC, Hora', 'DESC');
        		$Consulta->PrepararQuery();
        		return $Consulta->ExecuteConsulta('GESTION');
        	}
        }
        
        public function ListadoSeguimientoGeneral($Validacion = false) {
        	if($Validacion == true) {
        		$Consulta = new NeuralBDConsultas;
        		$Consulta->CrearConsulta('tbl_gestion_seguimiento');
        		$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_seguimiento'));
        		$Consulta->CrearConsulta('tbl_base_general');
        		$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_general', array('Id')));
        		$Consulta->AgregarCondicion("tbl_gestion_seguimiento.Estado = 'ACTIVO'");
        		$Consulta->AgregarCondicion("tbl_gestion_seguimiento.Registro = tbl_base_general.Id");
        		$Consulta->AgregarOrdenar('tbl_gestion_seguimiento.Fecha_Inicio', 'ASC');
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