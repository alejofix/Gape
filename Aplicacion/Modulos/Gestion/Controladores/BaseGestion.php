<?php
	class BaseGestion extends Controlador {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
		
		public function Index() {
			
			$Parametros = AyudasSessiones::InformacionSessionControlador(true);
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListarAsesoresAsignados($Parametros['Usuario']));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Asesores');
			$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
			$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Parametro = false) {
				if($Parametro == true) { 
					$Json = json_encode(array_merge(array('Validacion' => date("Y-m-d H:i:s")), $Parametro));
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Json, 'GESTION')); 
				}
			});
			echo $Plantilla->MostrarPlantilla('BaseGestion/Listado_Asesores.html', 'GESTION');
		}
		
		public function Seleccion($Parametro = false) {
			if($Parametro == true) {
				$Array = self::ValidacionParametro($Parametro);
				if(strtotime($Array['Validacion']) < strtotime(date("Y-m-d H:i:s"))) {
					$Parametros = AyudasSessiones::InformacionSessionControlador(true);
					$Plantilla = new NeuralPlantillasTwig;
					$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
					$Plantilla->ParametrosEtiquetas('Informacion', $Array);
					$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Gestión');
					$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
					$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Usuario = false) {
						if($Usuario == true) { return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Usuario, array(date("Y-m-d"), 'GESTION'))); }
					});
					echo $Plantilla->MostrarPlantilla('BaseGestion/SeleccionGestion.html', 'GESTION');
				}
				else {
					header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
					exit();
				}
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
				exit();
			}
		}
		
		public function Internet($UserCod = false) {
			if($UserCod == true) {
				$Asesor = self::ValidarUserCod($UserCod);
				$Parametros = AyudasSessiones::InformacionSessionControlador(true);
				$Validacion = new NeuralJQueryValidacionFormulario;
				$Validacion->Requerido('Cuenta', 'Ingrese el Número de Cuenta');
				$Validacion->CantMaxCaracteres('Cuenta', 10, 'Los Numeros de cuenta Tiene hasta 10 Numeros');
				$Validacion->Numero('Cuenta', 'Debe ingresar Solo Datos Númericos');
				$Validacion->Requerido('Marca', 'Seleccione la Marca del Cablemodem');
				$Validacion->Requerido('Modelo', 'Seleccione el Modelo del Cablemodem');
				$Validacion->Requerido('Firmware', 'Seleccione el Firmware del Cablemodem');
				$Validacion->Requerido('Nodo', 'Ingrese el Nodo Correspondiente');
				$Validacion->CantMaxCaracteres('Nodo', 8, 'Lo Maximo a Ingresar son 8 Caracteres');
				$Validacion->Requerido('Sintoma', 'Seleccione el Sintoma Correspondiente');
				$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form_Internet', 'Form_Internet', NeuralRutasApp::RutaURL('Ajax/BaseGestionInternet/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
				$Script[] = $Validacion->MostrarValidacion('Form_Internet');
				$Script[] = NeuralJQueryAjax::SelectCargarPeticionPOST('Marca', 'Modelo', NeuralRutasApp::RutaURL('Ajax/SelectDependienteListaModelo/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), 'Marca');
				$Script[] = NeuralJQueryAjax::SelectCargarPeticionPOST('Marca', 'Firmware', NeuralRutasApp::RutaURL('Ajax/SelectDependienteListaFirmware/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), 'Marca');
				
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
				$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Gestión');
				$Plantilla->ParametrosEtiquetas('CantidadAsesor', $this->Modelo->ConsultarAsesor($Asesor));
				$Plantilla->ParametrosEtiquetas('Asesor', $Asesor);
				$Plantilla->ParametrosEtiquetas('Marca', $this->Modelo->ListarMarcasCablem(true));
				$Plantilla->ParametrosEtiquetas('Sintomas', $this->Modelo->ListadoSintomas('INTERNET'));
				$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
				$Plantilla->ParametrosEtiquetas('BaseScript', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
				$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION'));
				});
				echo $Plantilla->MostrarPlantilla('BaseGestion/Internet.html', 'GESTION');
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
				exit();
			}
		}
		
		
		public function Telefonia($UserCod = false) {
			if($UserCod == true) {
				$Asesor = self::ValidarUserCod($UserCod);
				$Parametros = AyudasSessiones::InformacionSessionControlador(true);
				$Validacion = new NeuralJQueryValidacionFormulario;
				$Validacion->Requerido('Cuenta', 'Ingrese el Número de Cuenta');
				$Validacion->CantMaxCaracteres('Cuenta', 10, 'Los Numeros de cuenta Tiene hasta 10 Numeros');
				$Validacion->Numero('Cuenta', 'Debe ingresar Solo Datos Númericos');
				$Validacion->Requerido('Marca', 'Seleccione la Marca del Cablemodem');
				$Validacion->Requerido('Modelo', 'Seleccione el Modelo del Cablemodem');
				$Validacion->Requerido('Firmware', 'Seleccione el Firmware del Cablemodem');
				$Validacion->Requerido('Nodo', 'Ingrese el Nodo Correspondiente');
				$Validacion->CantMaxCaracteres('Nodo', 8, 'Lo Maximo a Ingresar son 8 Caracteres');
				$Validacion->Requerido('Sintoma', 'Seleccione el Sintoma Correspondiente');
				$Validacion->Requerido('Softswitch', 'Seleccione el Softswitch Correspondiente');
				$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form_Telefonia', 'Form_Telefonia', NeuralRutasApp::RutaURL('Ajax/BaseGestionTelefonia/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
				$Script[] = $Validacion->MostrarValidacion('Form_Telefonia');
				$Script[] = NeuralJQueryAjax::SelectCargarPeticionPOST('Marca', 'Modelo', NeuralRutasApp::RutaURL('Ajax/SelectDependienteListaModelo/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), 'Marca');
				$Script[] = NeuralJQueryAjax::SelectCargarPeticionPOST('Marca', 'Firmware', NeuralRutasApp::RutaURL('Ajax/SelectDependienteListaFirmware/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), 'Marca');
				
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
				$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Gestión');
				$Plantilla->ParametrosEtiquetas('CantidadAsesor', $this->Modelo->ConsultarAsesor($Asesor));
				$Plantilla->ParametrosEtiquetas('Asesor', $Asesor);
				$Plantilla->ParametrosEtiquetas('Marca', $this->Modelo->ListarMarcasCablem(true));
				$Plantilla->ParametrosEtiquetas('Sintomas', $this->Modelo->ListadoSintomas('TELEFONIA'));
				$Plantilla->ParametrosEtiquetas('Softswitch', $this->Modelo->ListadoSoftswitch(true));
				$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
				$Plantilla->ParametrosEtiquetas('BaseScript', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
				$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION'));
				});
				echo $Plantilla->MostrarPlantilla('BaseGestion/Telefonia.html', 'GESTION');
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
				exit();
			}
		}
		
		public function Television($UserCod = false) {
			if($UserCod == true) {
				$Asesor = self::ValidarUserCod($UserCod);
				$Parametros = AyudasSessiones::InformacionSessionControlador(true);
				$Validacion = new NeuralJQueryValidacionFormulario;
				$Validacion->Requerido('Cuenta', 'Ingrese el Número de Cuenta');
				$Validacion->CantMaxCaracteres('Cuenta', 10, 'Los Numeros de cuenta Tiene hasta 10 Numeros');
				$Validacion->Numero('Cuenta', 'Debe ingresar Solo Datos Númericos');
				$Validacion->Requerido('Nodo', 'Ingrese el Nodo Correspondiente');
				$Validacion->CantMaxCaracteres('Nodo', 8, 'Lo Maximo a Ingresar son 8 Caracteres');
				$Validacion->Requerido('Sintoma', 'Seleccione el Sintoma Correspondiente');
				$Validacion->Requerido('Paquete', 'Seleccione el Paquete Correspondiente');
				$Validacion->Requerido('Modelo', 'Seleccione el Modelo Correspondiente');
				$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form_Television', 'Form_Television', NeuralRutasApp::RutaURL('Ajax/BaseGestionTelevision/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
				$Script[] = $Validacion->MostrarValidacion('Form_Television');
				$Script[] = NeuralJQueryAjax::SelectCargarPeticionPOST('Paquete', 'Modelo', NeuralRutasApp::RutaURL('Ajax/SelectDependienteListaPaqueteModelo/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), 'Paquete');
				
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
				$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Gestión');
				$Plantilla->ParametrosEtiquetas('CantidadAsesor', $this->Modelo->ConsultarAsesor($Asesor));
				$Plantilla->ParametrosEtiquetas('Asesor', $Asesor);
				$Plantilla->ParametrosEtiquetas('Paquete', $this->Modelo->ListarPaqueteTv(true));
				$Plantilla->ParametrosEtiquetas('Sintomas', $this->Modelo->ListadoSintomas('TELEVISION'));
				$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
				$Plantilla->ParametrosEtiquetas('BaseScript', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
				$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION'));
				});
				echo $Plantilla->MostrarPlantilla('BaseGestion/Television.html', 'GESTION');
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
				exit();
			}
		}
		
		public function MiClaro($UserCod = false) {
			if($UserCod == true) {
				$Asesor = self::ValidarUserCod($UserCod);
				$Parametros = AyudasSessiones::InformacionSessionControlador(true);
				$Validacion = new NeuralJQueryValidacionFormulario;
				$Validacion->Requerido('Cuenta', 'Ingrese el Número de Cuenta');
				$Validacion->CantMaxCaracteres('Cuenta', 10, 'Los Numeros de cuenta Tiene hasta 10 Numeros');
				$Validacion->Numero('Cuenta', 'Debe ingresar Solo Datos Númericos');
				$Validacion->Requerido('Sintoma', 'Seleccione el Sintoma Correspondiente');
				$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form_MiClaro', 'Form_MiClaro', NeuralRutasApp::RutaURL('Ajax/BaseGestionMiClaro/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
				$Script[] = $Validacion->MostrarValidacion('Form_MiClaro');
				
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
				$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Gestión');
				$Plantilla->ParametrosEtiquetas('CantidadAsesor', $this->Modelo->ConsultarAsesor($Asesor));
				$Plantilla->ParametrosEtiquetas('Asesor', $Asesor);
				$Plantilla->ParametrosEtiquetas('Sintomas', $this->Modelo->ListadoSintomas('MICLARO'));
				$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
				$Plantilla->ParametrosEtiquetas('BaseScript', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
				$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION'));
				});
				echo $Plantilla->MostrarPlantilla('BaseGestion/MiClaro.html', 'GESTION');
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
				exit();
			}
		}
		public function Masivos($UserCod = false) {
			if($UserCod == true) {
				$Asesor = self::ValidarUserCod($UserCod);
				$Parametros = AyudasSessiones::InformacionSessionControlador(true);
				$Validacion = new NeuralJQueryValidacionFormulario;
				$Validacion->Requerido('Cuenta', 'Ingrese el Número de Cuenta');
				$Validacion->CantMaxCaracteres('Cuenta', 10, 'Los Numeros de cuenta Tiene hasta 10 Numeros');
				$Validacion->Numero('Cuenta', 'Debe ingresar Solo Datos Númericos');
				$Validacion->Requerido('Aviso', 'Ingrese el Número de Aviso');
				$Validacion->CantMaxCaracteres('Aviso', 15, 'Los Numeros de Aviso Tiene hasta 15 Numeros');
				$Validacion->Numero('Aviso', 'Debe ingresar Solo Datos Númericos');
				$Validacion->Requerido('Nodo', 'Ingrese el Nodo Correspondiente');
				$Validacion->CantMaxCaracteres('Nodo', 8, 'Lo Maximo a Ingresar son 8 Caracteres');
		    	$Validacion->Requerido('Sintoma', 'Seleccione el Tipo de Aviso');
				$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form_Masivos', 'Form_Masivos', NeuralRutasApp::RutaURL('Ajax/BaseGestionMasivos/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
				$Script[] = $Validacion->MostrarValidacion('Form_Masivos');
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
				$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Gestión');
				$Plantilla->ParametrosEtiquetas('CantidadAsesor', $this->Modelo->ConsultarAsesor($Asesor));
				$Plantilla->ParametrosEtiquetas('Asesor', $Asesor);
				$Plantilla->ParametrosEtiquetas('Sintomas', $this->Modelo->ListadoSintomas('MASIVOS'));
				$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
				$Plantilla->ParametrosEtiquetas('BaseScript', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
				$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION'));
				});
				echo $Plantilla->MostrarPlantilla('BaseGestion/Masivos.html', 'GESTION');
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
				exit();
			}
		}
		public function LLS($UserCod = false) {
			if($UserCod == true) {
				$Asesor = self::ValidarUserCod($UserCod);
				$Parametros = AyudasSessiones::InformacionSessionControlador(true);
				$Validacion = new NeuralJQueryValidacionFormulario;
				$Validacion->Requerido('Cuenta', 'Ingrese el Número de Cuenta');
				$Validacion->CantMaxCaracteres('Cuenta', 10, 'Los Numeros de cuenta Tiene hasta 10 Numeros');
				$Validacion->Numero('Cuenta', 'Debe ingresar Solo Datos Númericos');
				$Validacion->Requerido('Nodo', 'Ingrese el Nodo Correspondiente');
				$Validacion->CantMaxCaracteres('Nodo', 8, 'Lo Maximo a Ingresar son 8 Caracteres');
		    	$Validacion->Requerido('Paquete', 'Seleccione el Servicio Afectado');
				$Validacion->Requerido('Sintoma', 'Seleccione el Sintoma Correspondiente');
				$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form_LLS', 'Form_LLS', NeuralRutasApp::RutaURL('Ajax/BaseGestionLLS/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
				$Script[] = $Validacion->MostrarValidacion('Form_LLS');
				
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
				$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Gestión');
				$Plantilla->ParametrosEtiquetas('CantidadAsesor', $this->Modelo->ConsultarAsesor($Asesor));
				$Plantilla->ParametrosEtiquetas('Asesor', $Asesor);
				$Plantilla->ParametrosEtiquetas('ServicioAfectado', $this->Modelo->ListadoSintomas('LLS_SA'));
				$Plantilla->ParametrosEtiquetas('Sintomas', $this->Modelo->ListadoSintomas('LLS'));
				$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
				$Plantilla->ParametrosEtiquetas('BaseScript', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
				$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION'));
				});
				echo $Plantilla->MostrarPlantilla('BaseGestion/LLS.html', 'GESTION');
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
				exit();
			}
		}
		//FIX
		public function Correo($UserCod = false) {
			if($UserCod == true) {
				$Asesor = self::ValidarUserCod($UserCod);
				$Parametros = AyudasSessiones::InformacionSessionControlador(true);
				$Validacion = new NeuralJQueryValidacionFormulario;
				$Validacion->Requerido('Cuenta', 'Ingrese el Número de Cuenta');
				$Validacion->CantMaxCaracteres('Cuenta', 10, 'Los Numeros de cuenta Tiene hasta 10 Numeros');
				$Validacion->Numero('Cuenta', 'Debe ingresar Solo Datos Númericos');
				$Validacion->Requerido('Sintoma', 'Seleccione el Sintoma Correspondiente');
				$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form_Correo', 'Form_Correo', NeuralRutasApp::RutaURL('Ajax/BaseGestionCorreo/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
				$Script[] = $Validacion->MostrarValidacion('Form_Correo');
				$Script[] = NeuralJQueryAjax::SelectCargarPeticionPOST('Paquete', 'Modelo', NeuralRutasApp::RutaURL('Ajax/SelectDependienteListaPaqueteModelo/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), 'Paquete');
				
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
				$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Gestión');
				$Plantilla->ParametrosEtiquetas('CantidadAsesor', $this->Modelo->ConsultarAsesor($Asesor));
				$Plantilla->ParametrosEtiquetas('Asesor', $Asesor);
				$Plantilla->ParametrosEtiquetas('Paquete', $this->Modelo->ListarPaqueteTv(true));
				$Plantilla->ParametrosEtiquetas('Sintomas', $this->Modelo->ListadoSintomas('CORREO'));
				$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
				$Plantilla->ParametrosEtiquetas('BaseScript', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
				$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION'));
				});
				echo $Plantilla->MostrarPlantilla('BaseGestion/Correo.html', 'GESTION');
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
				exit();
			}
		}
		//
		public function Iims($UserCod = false) {
			if($UserCod == true) {
				$Asesor = self::ValidarUserCod($UserCod);
				$Parametros = AyudasSessiones::InformacionSessionControlador(true);
				$Validacion = new NeuralJQueryValidacionFormulario;
				$Validacion->Requerido('Sintoma', 'Seleccione la Opción del Arbol');
				$Validacion->Requerido('IIMS_Paso', 'Seleccione el Arbol correspondiente');
				$Validacion->Requerido('IIMS_Paso', 'Seleccione el Número de Paso');
				$Validacion->Requerido('Observaciones', 'Las Observaciones son Necesarias');
				$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form_Iims', 'Form_Iims', NeuralRutasApp::RutaURL('Ajax_BaseGestion/GuardarIIMS/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
				$Script[] = $Validacion->MostrarValidacion('Form_Iims');
				
				for ($i=1; $i<=30; $i++) {
					$Lista[]= $i;
				}
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
				$Plantilla->ParametrosEtiquetas('Titulo', 'Selección de Gestión');
				$Plantilla->ParametrosEtiquetas('CantidadAsesor', $this->Modelo->ConsultarAsesor($Asesor));
				$Plantilla->ParametrosEtiquetas('Asesor', $Asesor);
				$Plantilla->ParametrosEtiquetas('Sintomas', $this->Modelo->ListadoSintomas('IIMS'));
				$Plantilla->ParametrosEtiquetas('Paso', $Lista);
				$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
				$Plantilla->ParametrosEtiquetas('BaseScript', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
				$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto) {
					return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION'));
				});
				echo $Plantilla->MostrarPlantilla('BaseGestion/Iims.html', 'GESTION');
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('BaseGestion'));
				exit();
			}
		}
		//FIX
		private function ValidarUserCod($UserCod = false) {
			if($UserCod == true) {
				return NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($UserCod), array(date("Y-m-d"), 'GESTION'));
			}
		}
		
		private function ValidacionParametro($Parametro = false) {
			if($Parametro == true) {
				$Json = NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Parametro), 'GESTION');
				return json_decode($Json, true);
			}
		}
	}