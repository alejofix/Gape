<?php
	class Ajax_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		// -- Inicio de AsignacionAsesores
		public function AgregarAsesorAsignado($Asesor = false, $Usuario = false) {
			if($Asesor == true AND $Usuario == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_gestion_asesor_asignado');
				$SQL->AgregarSentencia('Asesor', $Asesor);
				$SQL->AgregarSentencia('Usuario', $Usuario);
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->AgregarSentencia('Ubicacion', 'HALL');
				$SQL->InsertarDatos();
			}
		}
		
		public function ActualizarAgregarAsesorAsignado($Asesor = false, $Usuario = false, $Estado = false) {
			if($Asesor == true AND $Usuario == true AND $Estado == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_gestion_asesor_asignado');
				$SQL->AgregarSentencia('Estado', $Estado);
				$SQL->AgregarCondicion('Asesor', $Asesor);
				$SQL->AgregarCondicion('Usuario', $Usuario);
				$SQL->AgregarCondicion('Ubicacion', 'HALL');
				$SQL->ActualizarDatos();
			}
		}
		
		public function AsignarAsesoresDesdeExcel($Array = false, $Usuario = false) {
			if($Array == true AND is_array($Array) == true AND $Usuario == true) {
				$Conexion = NeuralConexionBaseDatos::ObtenerConexionBase('GESTION');
				self::ActualizarGAS($Conexion, 'tbl_gestion_asesor_asignado', array('Estado' => 'INACTIVO'), array('Usuario' => $Usuario));
				foreach ($Array AS $Continuo => $Valor) {
					$Preparacion = $Conexion->prepare("SELECT Id FROM tbl_gestion_asesor_asignado WHERE Asesor = '$Valor[Asesor]' AND Usuario = '$Usuario'");
					$Preparacion->execute();
					if($Preparacion->rowCount() == 1) {
						self::ActualizarGAS($Conexion, 'tbl_gestion_asesor_asignado', array('Estado' => 'ACTIVO'), array('Asesor' => $Valor['Asesor'], 'Usuario' => $Usuario));
					}
					else {
						$Preparacion_2 = $Conexion->prepare("SELECT Usuario FROM tbl_gestion_asesores WHERE Usuario = '$Valor[Asesor]' AND Estado ='ACTIVO'");
						$Preparacion_2->execute();
						if($Preparacion_2->rowCount() == 1) {
							$Agregar = $Conexion->insert('tbl_gestion_asesor_asignado', array('Asesor' => ucwords($Valor['Asesor']), 'Usuario' => ucwords($Usuario), 'Estado' => 'ACTIVO', 'Ubicacion' => 'HALL'));
						}
					}
				}
			}
		}
		
		private function ActualizarGAS($Conexion = false, $Tabla = false, $Datos = false, $Condicion = false) {
			if($Conexion == true AND $Tabla == true AND $Datos == true AND $Condicion == true) {
				$Actualizar = $Conexion->update($Tabla, $Datos, $Condicion);
			}
		}
		
		// -- Fin de AsignacionAsesores
		
		// -- Base Gestion 
		public function ListadoModelos($Marca = false) {
			if($Marca == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_equipo');
				$Consulta->AgregarColumnas('Modelo');
				$Consulta->AgregarCondicion("Marca = '$Marca'");
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListadoFirmware($Marca = false) {
			if($Marca == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_firmware');
				$Consulta->AgregarColumnas('Firmware');
				$Consulta->AgregarCondicion("Marca = '$Marca'");
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Firmware');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListadoPaqueteModelo($Paquete = false) {
			if($Paquete == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_paquete_tv');
				$Consulta->AgregarColumnas('Modelo');
				$Consulta->AgregarCondicion("Paquete = '$Paquete'");
				$Consulta->AgregarOrdenar('Modelo');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function GuardarGestionInternet($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_general');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Tipo_Reporte', 'INTERNET');
				$SQL->InsertarDatos();
			}
		}
		
		public function GuardarGestionTelefonia($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_general');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Tipo_Reporte', 'TELEFONIA');
				$SQL->InsertarDatos();
			}
		}
		
		public function GuardarGestionTelevision($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_general');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Tipo_Reporte', 'TELEVISION');
				$SQL->InsertarDatos();
			}
		}
		
		public function GuardarGestionMiClaro($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_general');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Tipo_Reporte', 'MICLARO');
				$SQL->InsertarDatos();
			}
		}
		
		public function GuardarGestionMasivos($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_general');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Tipo_Reporte', 'MASIVOS');
				$SQL->InsertarDatos();
			}
		}
		
		public function GuardarGestionLLS($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_general');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Tipo_Reporte', 'LLS');
				$SQL->InsertarDatos();
			}
		}
        // fix
        public function GuardarCorreo($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_general');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Tipo_Reporte', 'CORREO');
				$SQL->InsertarDatos();
			}
		}
        //end fix
		
		public function BuscarConsecutivoGestion($Fecha = false, $Hora = false, $Usuario = false, $Gestion = false) {
			if($Fecha == true AND $Hora == true AND $Usuario == true AND $Gestion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_general');
				$Consulta->AgregarColumnas('Id');
				$Consulta->AgregarCondicion("Fecha = '$Fecha'");
				$Consulta->AgregarCondicion("Hora = '$Hora'");
				$Consulta->AgregarCondicion("Usuario = '$Usuario'");
				$Consulta->AgregarCondicion("Tipo_Reporte = '$Gestion'");
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function GuardarSeguimiento($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_gestion_seguimiento');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->InsertarDatos();
			}
		}
		// FIN Base Gestion
		
		//INICIO de Seguimiento
		
		public function ListaNotasSeguimiento($Registro = false) {
			if($Registro == true AND is_numeric($Registro) == true) {
				$Consulta = new NeuralBDConsultas;
        		$Consulta->CrearConsulta('tbl_gestion_seguimiento_notas');
        		$Consulta->AgregarColumnas('tbl_gestion_seguimiento_notas.Notas, tbl_gestion_seguimiento_notas.Fecha, tbl_gestion_seguimiento_notas.Hora');
        		$Consulta->CrearConsulta('tbl_sistema_usuarios');
        		$Consulta->AgregarColumnas('tbl_sistema_usuarios.Nombres, tbl_sistema_usuarios.Apellidos');
        		$Consulta->AgregarCondicion("Registro = '$Registro'");
        		$Consulta->AgregarCondicion("tbl_gestion_seguimiento_notas.Usuario = tbl_sistema_usuarios.Usuario");
        		$Consulta->AgregarOrdenar('Fecha DESC, Hora', 'DESC');
        		$Consulta->PrepararQuery();
        		return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function AgregarNuevaNotaSeguimiento($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_gestion_seguimiento_notas');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->InsertarDatos();
			}
		}
		
		public function ActualizarEstadoRegistroNotas($Registro = false) {
			if($Registro == true) {
				$SQL1 = new NeuralBDGab;
				$SQL1->SeleccionarDestino('GESTION', 'tbl_base_general');
				$SQL1->AgregarSentencia('Seguimiento', 'FINALIZADO');
				$SQL1->AgregarCondicion('Id', $Registro);
				$SQL1->ActualizarDatos();
				
				$SQL2 = new NeuralBDGab;
				$SQL2->SeleccionarDestino('GESTION', 'tbl_gestion_seguimiento');
				$SQL2->AgregarSentencia('Estado', 'INACTIVO');
				$SQL2->AgregarSentencia('Fecha_Fin', date("Y-m-d H:i:s"));
				$SQL2->AgregarCondicion('Registro', $Registro);
				$SQL2->ActualizarDatos();
			}
		}
		// FIN de Seguimiento
	}