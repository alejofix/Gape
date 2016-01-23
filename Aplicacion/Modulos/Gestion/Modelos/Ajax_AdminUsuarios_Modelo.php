<?php
	class Ajax_AdminUsuarios_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		public function ConsultarExistenciaUsuario($Usuario = false) {
			if($Usuario == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_sistema_usuarios');
				$Consulta->AgregarColumnas('Usuario');
				$Consulta->AgregarCondicion("Usuario = '$Usuario'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function GuardarNuevoUsuario($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_sistema_usuarios');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Password', sha1($Array['Cedula']));
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->InsertarDatos();
			}
		}
		
		private static function ConsultarCedulaUsuario($Id = false) {
			if($Id == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_sistema_usuarios');
				$Consulta->AgregarColumnas('Cedula');
				$Consulta->AgregarCondicion("Id = '$Id'");
				$Consulta->PrepararQuery();
				$Data = $Consulta->ExecuteConsulta('GESTION');
				return $Data[0]['Cedula'];
			}
		}
		
		public function ResetPassword($ID = false) {
			if($ID == true) {
				$Consulta = self::ConsultarCedulaUsuario($ID);
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_sistema_usuarios');
				$SQL->AgregarCondicion('Id', $ID);
				$SQL->AgregarSentencia('Password', sha1($Consulta));
				$SQL->ActualizarDatos();
			}
		}
		
		public function ActualizarDatosUsuarios($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_sistema_usuarios');
				foreach ($Array AS $Columna => $Valor) {
					if($Columna <> 'Data') {
						$SQL->AgregarSentencia($Columna, $Valor);
					}
				}
				$SQL->AgregarCondicion('Id', $Array['Data']);
				$SQL->ActualizarDatos();
			}
		}
		
		public function EliminarUsuario($Id = false) {
			if($Id == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_sistema_usuarios');
				$SQL->AgregarSentencia('Estado', 'ELIMINADO');
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
		
		public function ConsultarExistenciaAsesorRemote($Usuario = false) {
			if($Usuario == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_gestion_asesores');
				$Consulta->AgregarColumnas('Id');
				$Consulta->AgregarCondicion("Usuario = '$Usuario'");
				$Consulta->AgregarCondicion("Estado != 'ELIMINADO'");
				$Consulta->PrepararCantidadDatos('Cantidad');
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function AgregarAsesor($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_gestion_asesores');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->InsertarDatos();
			}
		}
		
		public function AgregarAsesoresExcel($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$Conexion = NeuralConexionBaseDatos::ObtenerConexionBase('GESTION');
				foreach ($Array AS $Contador => $Valor) {
					if(self::CantidadAsesoresConsulta($Conexion, $Valor['Usuario'])==0) {
						self::InsertarDatosAsesoresConsulta($Conexion, $Valor);
					}
					else { $Lista[] = $Valor; }
				}
				return (isset($Lista) == true) ? $Lista : array();
			}
		}
		
		private function CantidadAsesoresConsulta($Conexion, $Usuario) {
			$Consulta = $Conexion->prepare("SELECT Id FROM tbl_gestion_asesores WHERE Usuario = ? AND Estado = 'ACTIVO'");
			$Consulta->bindValue(1, $Usuario);
			$Consulta->execute();
			return $Consulta->rowCount();
		}
		
		private function InsertarDatosAsesoresConsulta($Conexion, $Array) {
			$Matriz = array_merge($Array, array('Estado' => 'ACTIVO'));
			$Insertar = $Conexion->insert('tbl_gestion_asesores', $Matriz);
		}
		
		public function ActivacionUsuario($Id = false, $Estado = false) {
			if($Id == true AND $Estado == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_gestion_asesores');
				$SQL->AgregarSentencia('Estado', $Estado);
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
	}