<?php
	class AsignacionAsesores_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		/**
		 * Metodo Publico
		 * ListarUsuariosAsignados($Usuario = false)
		 * 
		 * Genera el listado correspondiente de datos
		 */
		public function ListarUsuariosAsignados($Usuario = false) {
			if($Usuario == true) {
				return self::AsesoresAsignadosUsuario($Usuario, self::ListarAsesoresActivos(true, $Usuario));
			}
		}
		
		/**
		 * Metodo Privado
		 * ListarAsesoresActivos($Gestion = false)
		 * 
		 * Lista los Usuarios activos en la base de datos
		 */
		private function ListarAsesoresActivos($Gestion = false, $Usuario = false) {
			if($Gestion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_gestion_asesores');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_asesores'));
				$Consulta->AgregarCondicion("tbl_gestion_asesores.Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('tbl_gestion_asesores.Apellidos', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		/**
		 * Metodo Publico
		 * AsesoresAsignadosUsuario($Usuario = false, $Array = false)
		 * 
		 * Genera el listado correspondiente de usuarios y valida su estado
		 */
		private function AsesoresAsignadosUsuario($Usuario = false, $Array = false) {
			if($Usuario == true AND $Array == true AND is_array($Array) == true) {
				$Conexion = NeuralConexionBaseDatos::ObtenerConexionBase('GESTION');
				$SQL = 'SELECT Id, Estado FROM tbl_gestion_asesor_asignado WHERE Asesor = ? AND Usuario = ?';
				foreach ($Array AS $Columna => $Valor) {
					$Consulta = $Conexion->prepare($SQL);
					$Consulta->bindValue(1, $Valor['Usuario']);
					$Consulta->bindValue(2, $Usuario);
					$Consulta->execute();
					if($Consulta->rowCount() == 1) {
						$Lista[] = array_merge($Valor, array('EstadoAsignado' => $Valor['Estado']));
					}
					else {
						$Lista[] = array_merge($Valor, array('EstadoAsignado' => 'NO EXISTE'));
					}
				}
				return $Lista;
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
		
		public function ListarAsesoresAsignacion($Usuario = false) {
			if($Usuario == true) {
				return self::AsignarAsignacion($Usuario);
			}
		}
		
		private function AsignarAsignacion($Usuario = false) {
			if($Usuario == true) {
				$Conexion = NeuralConexionBaseDatos::ObtenerConexionBase('GESTION');
				
				$consultaEmpresa = $Conexion->prepare('SELECT Empresa FROM tbl_sistema_usuarios WHERE Usuario = ?');
				$consultaEmpresa->bindValue(1, $Usuario);
				$consultaEmpresa->execute();
				$idEmpresa = $consultaEmpresa->fetch(PDO::FETCH_ASSOC);
				
				$consulta = $Conexion->prepare('
					SELECT 
						tbl_gestion_asesores.Id, tbl_gestion_asesores.Usuario, tbl_gestion_asesores.Nombres, 
						tbl_gestion_asesores.Apellidos, tbl_gestion_asesores.Cedula, tbl_gestion_asesores.Estado, 
						tbl_empresas.Nombre AS Empresa, 
						CASE (SELECT COUNT(Id) FROM tbl_gestion_asesor_asignado WHERE Asesor = tbl_gestion_asesores.Usuario AND Usuario = ? AND Estado = ?) 
							 WHEN 1 THEN "ASIGNADO" 
							 WHEN 0 THEN "NO ASIGNADO" 
					 	END AS Asignacion 
						
					FROM 
						tbl_gestion_asesores 
					INNER JOIN 
						tbl_empresas 
					ON 
						tbl_gestion_asesores.Empresa = tbl_empresas.Id 
					WHERE 
						tbl_gestion_asesores.Estado = ? 
					AND 
						tbl_gestion_asesores.Empresa = ?
				');
				$consulta->bindValue(1, $Usuario);
				$consulta->bindValue(2, 'ACTIVO');
				$consulta->bindValue(3, 'ACTIVO');
				$consulta->bindValue(4, $idEmpresa['Empresa']);
				$consulta->execute();
				return $consulta->fetchAll(PDO::FETCH_ASSOC);
			}
		}
		
		private function ListarAsesoresValidacion($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_gestion_asesores');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_gestion_asesores'));
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Usuario', 'ASC');
				$Consulta->PrepararCantidadDatos('Cantidad');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
	}