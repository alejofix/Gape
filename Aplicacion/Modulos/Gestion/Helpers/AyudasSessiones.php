<?php
	class AyudasSessiones {
		private static $ConfiguracionAcceso = 'ConfigAcceso.json';
		private static $ConfiguracionSession = 'ConfiguracionSession.json';
		private static $ModuloAplicacion = 'GESTION';
		private static $HashUOAUTH = '4pl1c4c10n3xp3r70';
		private static $HashPOAUTH = '4p71c4c10n4t3nt0';
		
		public static function InformacionSessionControlador($Parametro = false) {
			if($Parametro == true) {
				$ModRewrite = SysNeuralNucleo::LeerURLModReWrite();
				$Lista['Fecha'] = self::CrearFecha(true);
				$Lista['Usuario'] = NeuralEncriptacion::DesencriptarDatos($_SESSION['Usuario'], array(date("Y-m-d"), self::$ModuloAplicacion));
				$Lista['Nombre'] = NeuralEncriptacion::DesencriptarDatos($_SESSION['Nombre'], array(date("Y-m-d"), self::$ModuloAplicacion));
				$Lista['Matriz'] = self::ValidarMatrizPermisos($_SESSION['POAUTH']);
				$Lista['Controlador'] = $ModRewrite[1];
				$Lista['Metodo'] = (isset($ModRewrite[2]) == true) ? $ModRewrite[2] : 'NINGUNO';
				return $Lista;
			}
		}
		
		private static function CrearFecha($Parametro = false) {
			if($Parametro = true) {
				$Mes = array('1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo', '4' => 'Abril', '5' => 'Mayo', '6' => 'Junio', '7' => 'Julio', '8' => 'Agosto', '9' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');
				$Dia = array('0' => 'Domingo', '1' => 'Lunes', '2' => 'Martes', '3' => 'Miercoles', '4' => 'Jueves', '5' => 'Viernes', '6' => 'Sabado');
				$Lista = getdate();
				$Lista['mon'] = $Mes[$Lista['mon']];
				$Lista['wday'] = $Dia[$Lista['wday']];
				return $Lista;
			}
		}
		
		public static function ValidarSessionModelo() {
			self::AccesoLineaComandos();
			if(isset($_SESSION['UOAUTH']) == false AND isset($_SESSION['POAUTH']) == false AND isset($_SESSION['Usuario']) == false AND isset($_SESSION['Nombre']) == false) {
				header("Location: ".NeuralRutasApp::RutaURL('Error/NoPermiso'));
				exit();
			}
		}
		
		public static function ValidarSession() {
			self::AccesoLineaComandos();
			self::ModificarParametros(true);
			NeuralSesiones::Inicializacion();
			if(isset($_SESSION['UOAUTH']) == true AND isset($_SESSION['POAUTH']) == true AND isset($_SESSION['Usuario']) == true AND isset($_SESSION['Nombre']) == true) {
				if(self::ValidarUOAUTH($_SESSION['UOAUTH']) == true) {
					if(self::ValidarPOAUTH($_SESSION['POAUTH']) == true) {
						if(self::ValidarPermiso($_SESSION['POAUTH']) == false) {
							header("Location: ".NeuralRutasApp::RutaURL('Error/NoPermiso'));
							exit();
						}
					}
					else {
						header("Location: ".NeuralRutasApp::RutaURL('LogOut'));
						exit();
					}
				}
				else {
					header("Location: ".NeuralRutasApp::RutaURL('LogOut'));
					exit();
				}
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('LogOut'));
				exit();
			}
		}
		
		private static function ValidarPermiso($Parametro = false) {
			if($Parametro == true) {
				$POAUTH = json_decode(NeuralEncriptacion::DesencriptarDatos($Parametro, self::$ModuloAplicacion), true);
				$Matriz = json_decode(NeuralEncriptacion::DesencriptarDatos($POAUTH['Matriz'], array(date("Y-m-d"), self::$ModuloAplicacion)), true);
				$ModRewrite = SysNeuralNucleo::LeerURLModReWrite();
				$Controlador = $ModRewrite[1];
				if(array_key_exists($Controlador, $Matriz) == true) {
					return ($Matriz[$Controlador] == 'true') ? true : false;
				}
				else {
					return false;
				}
			}
		}
		
		private static function ValidarMatrizPermisos($Parametro = false) {
			if($Parametro == true) {
				$POAUTH = json_decode(NeuralEncriptacion::DesencriptarDatos($Parametro, self::$ModuloAplicacion), true);
				return json_decode(NeuralEncriptacion::DesencriptarDatos($POAUTH['Matriz'], array(date("Y-m-d"), self::$ModuloAplicacion)), true);
			}
		}
		
		private static function ValidarPOAUTH($Parametro = false) {
			if($Parametro == true) {
				$POAUTH = json_decode(NeuralEncriptacion::DesencriptarDatos($Parametro, self::$ModuloAplicacion), true);
				$Usuario = NeuralEncriptacion::DesencriptarDatos(NeuralEncriptacion::DesencriptarDatos($POAUTH['Usuario'], array(date("Y-m-d"), self::$ModuloAplicacion)), self::$ModuloAplicacion);
				$Validacion[] = (NeuralEncriptacion::DesencriptarDatos($POAUTH['OAUTH'], self::$ModuloAplicacion) == self::$HashPOAUTH.'_'.$Usuario.'_'.date("Y-m-d")) ? '0' : '1';
				$Validacion[] = (NeuralEncriptacion::DesencriptarDatos($POAUTH['Tiempo'], self::$ModuloAplicacion) >= strtotime(date("Y-m-d H:i:s"))) ? '0' : '1';
				return (array_sum($Validacion)>=1) ? false : true;
			}
		}
		
		private static function ValidarUOAUTH($Parametro = false) {
			if($Parametro == true) {
				$UOAUTH = json_decode(NeuralEncriptacion::DesencriptarDatos($Parametro, self::$ModuloAplicacion), true);
				$Usuario = NeuralEncriptacion::DesencriptarDatos(NeuralEncriptacion::DesencriptarDatos($UOAUTH['Usuario'], array(date("Y-m-d"), self::$ModuloAplicacion)), self::$ModuloAplicacion);
				$Validacion[] = (NeuralEncriptacion::DesencriptarDatos($UOAUTH['OAUTH'], self::$ModuloAplicacion) == self::$HashUOAUTH.'_'.$Usuario.'_'.date("Y-m-d")) ? '0' : '1';
				$Validacion[] = (NeuralEncriptacion::DesencriptarDatos($UOAUTH['Tiempo'], self::$ModuloAplicacion) >= strtotime(date("Y-m-d H:i:s"))) ? '0' : '1';
				return (array_sum($Validacion)>=1) ? false : true;
			}
			else {
				return false;
			}
		}
		
		public static function RegistrarSession($DatosUsuarios = false, $Permisos = false) {
			if($DatosUsuarios == true AND is_array($DatosUsuarios) == true AND $Permisos == true AND is_array($Permisos) == true) {
				self::AccesoLineaComandos();
				self::ModificarParametros(true);
				NeuralSesiones::Inicializacion();
				NeuralSesiones::AgregarLlave('UOAUTH', NeuralEncriptacion::EncriptarDatos(self::RegistrarUOAUTH($DatosUsuarios), self::$ModuloAplicacion));
				NeuralSesiones::AgregarLlave('POAUTH', NeuralEncriptacion::EncriptarDatos(self::RegistrarPOAUTH($DatosUsuarios, $Permisos), self::$ModuloAplicacion));
				NeuralSesiones::AgregarLlave('Usuario', NeuralEncriptacion::EncriptarDatos($DatosUsuarios['Usuario'], array(date("Y-m-d"), self::$ModuloAplicacion)));
				NeuralSesiones::AgregarLlave('Nombre', NeuralEncriptacion::EncriptarDatos($DatosUsuarios['Nombres'].' '.$DatosUsuarios['Apellidos'], array(date("Y-m-d"), self::$ModuloAplicacion)));
			}
		}
		
		private static function RegistrarPOAUTH($DatosUsuario = false, $Permisos = false) {
			if($Permisos == true AND is_array($Permisos) == true AND $DatosUsuario == true AND is_array($DatosUsuario) == true) {
				$Configuracion = self::Configuracion(self::$ModuloAplicacion);
				$Data['OAUTH'] = NeuralEncriptacion::EncriptarDatos(self::$HashPOAUTH.'_'.$DatosUsuario['Usuario'].'_'.date("Y-m-d"), self::$ModuloAplicacion);
				$Data['Usuario'] = NeuralEncriptacion::EncriptarDatos(NeuralEncriptacion::EncriptarDatos($DatosUsuario['Usuario'], self::$ModuloAplicacion), array(date("Y-m-d"), self::$ModuloAplicacion));
				$Data['Tiempo'] = NeuralEncriptacion::EncriptarDatos(strtotime(date("Y-m-d H:i:s"))+$Configuracion['LifeTime']['Session']['Valor'], self::$ModuloAplicacion);
				$Data['Matriz'] = NeuralEncriptacion::EncriptarDatos(json_encode($Permisos), array(date("Y-m-d"), self::$ModuloAplicacion));
				return json_encode($Data);
			}
		}
		
		private static function RegistrarUOAUTH($DatosUsuario = false) {
			if($DatosUsuario == true AND is_array($DatosUsuario) == true) {
				$Configuracion = self::Configuracion(self::$ModuloAplicacion);
				$Data['OAUTH'] = NeuralEncriptacion::EncriptarDatos(self::$HashUOAUTH.'_'.$DatosUsuario['Usuario'].'_'.date("Y-m-d"), self::$ModuloAplicacion);
				$Data['Usuario'] = NeuralEncriptacion::EncriptarDatos(NeuralEncriptacion::EncriptarDatos($DatosUsuario['Usuario'], self::$ModuloAplicacion), array(date("Y-m-d"), self::$ModuloAplicacion));
				$Data['Tiempo'] = NeuralEncriptacion::EncriptarDatos(strtotime(date("Y-m-d H:i:s"))+$Configuracion['LifeTime']['Session']['Valor'], self::$ModuloAplicacion);
				return json_encode($Data);
			}
		}
		
		private static function ModificarParametros($Activar = false) {
			if($Activar == true) {
				$Parametros = self::Configuracion(self::$ModuloAplicacion);
				foreach ($Parametros['LifeTime'] AS $Nombre => $Array) {
					if($Array['Estado'] == true) {
						ini_set($Array['Parametro'], $Array['Valor']);
					}
				}
			}
		}
		
		private static function Configuracion($Aplicacion = false) {
			if($Aplicacion == true) {
				$Accesos = SysNeuralNucleo::CargarArchivoJsonConfiguracion(self::$ConfiguracionAcceso);
				if(array_key_exists($Aplicacion, $Accesos) == true) {
					if(file_exists(self::RutaConstructor($Accesos[self::$ModuloAplicacion]['Enrutamiento']['Carpeta'], $Accesos[self::$ModuloAplicacion]['Enrutamiento']['Configuracion'])) == true) {
						return json_decode(file_get_contents($Ruta = self::RutaConstructor($Accesos[self::$ModuloAplicacion]['Enrutamiento']['Carpeta'], $Accesos[self::$ModuloAplicacion]['Enrutamiento']['Configuracion'])), true);
					}
				}
			}
		}
		
		private static function RutaConstructor($Carpeta = false, $Configuracion = false) {
			if($Carpeta == true AND $Configuracion == true AND empty($Carpeta) == false AND empty($Configuracion) == false) {
				$Ruta[] = __SysNeuralFileRootModulos__;
				$Ruta[] = $Carpeta;
				$Ruta[] = $Configuracion;
				$Ruta[] = self::$ConfiguracionSession;
				return implode('', $Ruta);
			}
		}
		
		private static function AccesoLineaComandos() {
			if(PHP_SAPI == 'cli') { exit('La Aplicacion es Unicamente Accesible por un Navegador'); }
		}
	}