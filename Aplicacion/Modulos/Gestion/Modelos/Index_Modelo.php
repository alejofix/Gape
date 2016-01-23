<?php
	
	class Index_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
		}
		
		/**
		 * Metodo Publico
		 * ConsultarUsuario($Usuario = false, $Password = false)
		 * 
		 * @param $Usuario: string
		 * @param $Password: string
		 */
		public function ConsultarUsuario($Usuario = false, $Password = false) {
			if($Usuario == true AND $Password == true AND empty($Usuario) == false AND empty($Password) == false) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_sistema_usuarios');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_sistema_usuarios', array('Id', 'Password'), false));
				$Consulta->AgregarCondicion("Usuario = '$Usuario'");
				$Consulta->AgregarCondicion("Password = '$Password'");
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		/**
		 * Metodo Publico
		 * ConsultarPermisos($Permiso = false)
		 * 
		 * @param $Permiso: numeric
		 */
		public function ConsultarPermisos($Permiso = false) {
			if($Permiso == true AND is_numeric($Permiso) == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_sistema_permisos');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_sistema_permisos', array('Id')));
				$Consulta->AgregarCondicion("Id = '$Permiso'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
			else {
				return array('Cantidad' => '0');
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