<?php
	class Ajax_AdminContenido_Modelo extends Modelo {
		
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
		
		public function CargarListadoSintomas($Tipo_Reporte = false) {
			if($Tipo_Reporte == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_sintoma');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_sintoma'));
				$Consulta->AgregarCondicion("Tipo_Reporte = '$Tipo_Reporte'");
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Sintoma', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function AgregarSintomaBase($Sintoma = false, $Tipo_Reporte = false) {
			if($Sintoma == true AND $Tipo_Reporte == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_sintoma');
				$SQL->AgregarSentencia('Sintoma', $Sintoma);
				$SQL->AgregarSentencia('Tipo_Reporte', $Tipo_Reporte);
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->AgregarSentencia('Fecha', date("Y-m-d"));
				$SQL->AgregarSentencia('Hora', date("H:i:s"));
				$SQL->InsertarDatos();
			}
		}
		
		public function EliminarSintoma($Id = false) {
			if($Id == true AND is_numeric($Id) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_sintoma');
				$SQL->AgregarSentencia('Estado', 'INACTIVO');
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
		
		public function ActualizarSintoma($Id = false, $Sintoma = false) {
			if($Id == true AND $Sintoma == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_sintoma');
				$SQL->AgregarSentencia('Sintoma', $Sintoma);
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
		
		public function ListarPaqueteTelevision($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_paquete_tv');
				$Consulta->AgregarColumnas('Paquete');
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Paquete', 'ASC');
				$Consulta->AgregarAgrupar('Paquete');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function ListarPaqueteTelevisionTabla($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_paquete_tv');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_paquete_tv'));
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Paquete ASC, Modelo', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function AgregarPaqueteTelevision($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_paquete_tv');
				$SQL->AgregarSentencia('Paquete', $Array['Paquete']);
				$SQL->AgregarSentencia('Modelo', $Array['Modelo']);
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->InsertarDatos();
			}
		}
		
		public function EditarModeloTelevision($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_paquete_tv');
				$SQL->AgregarSentencia('Modelo', $Array['Modelo']);
				$SQL->AgregarCondicion('Id', $Array['Id']);
				$SQL->ActualizarDatos();
			}
		}
		
		public function EliminarModeloTelevision($Id = false) {
			if($Id == true AND is_numeric($Id) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_paquete_tv');
				$SQL->AgregarSentencia('Estado', 'INACTIVO');
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
		
		public function ListarMarCablemodems($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_equipo');
				$Consulta->AgregarColumnas('Marca');
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarAgrupar('Marca');
				$Consulta->AgregarOrdenar('Marca', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function InternetAgregarMarcaModelo($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_equipo');
				$SQL->AgregarSentencia('Marca', $Array['Marca']);
				$SQL->AgregarSentencia('Modelo', $Array['Modelo']);
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->InsertarDatos();
			}
		}
		
		public function ListarModelosCablemodemInternet($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_equipo');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_equipo'));
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Marca ASC, Modelo', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function InternetEditarModelo($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_equipo');
				$SQL->AgregarSentencia('Modelo', $Array['Modelo']);
				$SQL->AgregarCondicion('Id', $Array['Id']);
				$SQL->ActualizarDatos();
			}
		}
		
		public function InternetEliminarModelo($Id = false) {
			if($Id == true AND is_numeric($Id) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_equipo');
				$SQL->AgregarSentencia('Estado', 'INACTIVO');
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
		
		public function InternetAgregarFirmware($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_firmware');
				$SQL->AgregarSentencia('Marca', $Array['Marca']);
				$SQL->AgregarSentencia('Firmware', $Array['Firmware']);
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->InsertarDatos();
			}
		}
		
		public function InternetListadoFirmware($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_firmware');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_firmware'));
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Marca ASC, Firmware', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function InternetEliminarFirmware($Id = false) {
			if($Id == true AND is_numeric($Id) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_firmware');
				$SQL->AgregarSentencia('Estado', 'INACTIVO');
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
		
		public function InternetEditarFirmware($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_firmware');
				$SQL->AgregarSentencia('Firmware', $Array['Firmware']);
				$SQL->AgregarCondicion('Id', $Array['Id']);
				$SQL->ActualizarDatos();
			}
		}
		
		public function LLSagregarServicioAfectado($Sintoma = false) {
			if($Sintoma == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_sintoma');
				$SQL->AgregarSentencia('Sintoma', $Sintoma);
				$SQL->AgregarSentencia('Tipo_Reporte', 'LLS_SA');
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->AgregarSentencia('Fecha', date("Y-m-d"));
				$SQL->AgregarSentencia('Hora', date("H:i:s"));
				$SQL->InsertarDatos();
			}
		}
		
		public function LLSListadoServicioAfectado($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_sintoma');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_sintoma'));
				$Consulta->AgregarCondicion("Tipo_Reporte = 'LLS_SA'");
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Sintoma', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function LLSeliminarServicioAfectado($Id = false) {
			if($Id == true AND is_numeric($Id) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_sintoma');
				$SQL->AgregarSentencia('Estado', 'INACTIVO');
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
		
		public function LLSeditarServicioAfectado($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_sintoma');
				$SQL->AgregarSentencia('Sintoma', $Array['Sintoma']);
				$SQL->AgregarCondicion('Id', $Array['Id']);
				$SQL->ActualizarDatos();
			}
		}
		
		public function ListarSoftswitchTelefoniaTabla($Validacion = false) {
			if($Validacion == true) {
				$Consulta = new NeuralBDConsultas;
				$Consulta->CrearConsulta('tbl_base_softswitch');
				$Consulta->AgregarColumnas(self::ListarColumnasTabla('tbl_base_softswitch'));
				$Consulta->AgregarCondicion("Estado = 'ACTIVO'");
				$Consulta->AgregarOrdenar('Nombre', 'ASC');
				$Consulta->PrepararQuery();
				return $Consulta->ExecuteConsulta('GESTION');
			}
		}
		
		public function AgregarSoftswitchTelefonia($Softswitch = false) {
			if($Softswitch == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_softswitch');
				$SQL->AgregarSentencia('Nombre', $Softswitch);
				$SQL->AgregarSentencia('Estado', 'ACTIVO');
				$SQL->InsertarDatos();
			}
		}
		
		public function TelefoniaSoftswitchEliminar($Id = false) {
			if($Id == true AND is_numeric($Id) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_softswitch');
				$SQL->AgregarSentencia('Estado', 'INACTIVO');
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
		
		public function TelefoniaSoftswitchEditar($Array = false) {
			if($Array == true AND is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_softswitch');
				$SQL->AgregarSentencia('Nombre', $Array['Nombre']);
				$SQL->AgregarCondicion('Id', $Array['Id']);
				$SQL->ActualizarDatos();
			}
		}
	}