<?php
	class AdminUsuarios_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		public function ListarPermisos($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_sistema_permisos');
				$Consulta->AgregarColumnas('Id, Nombre');
				$Consulta->AgregarCondicion("Nombre <> 'RootAgent'");
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListadoUsuarios($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_sistema_usuarios');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_sistema_usuarios'));
				$Consulta->AgregarCondicion("Estado != 'ELIMINADO'");
				$Consulta->AgregarOrdenar('Permisos ASC, Usuario');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ConsultarDatosUsuario($Id = false) {
			if($Id == true AND is_numeric($Id) == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_sistema_usuarios');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_sistema_usuarios'));
				$Consulta->AgregarCondicion("Id = '$Id'");
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListadoPermisos($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_sistema_permisos');
				$Consulta->AgregarColumnas('Id, Nombre');
				$Consulta->AgregarCondicion("Nombre <> 'RootAgent'");
				$Consulta->AgregarOrdenar('Nombre', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListadoAsesores($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_gestion_asesores');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_asesores'));
				$Consulta->AgregarOrdenar('Estado ASC, Apellidos', 'ASC');
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