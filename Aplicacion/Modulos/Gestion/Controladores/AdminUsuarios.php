<?php
	class AdminUsuarios extends Controlador {
	
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSession();
		}
	
		public function Index() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Admin Usuarios');
			echo $Plantilla->MostrarPlantilla('AdminUsuarios/Menu.html', 'GESTION');
		}
		
		public function NuevoUsuario() {
			
			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('Usuario', 'Ingrese el Usuario Correspondiente');
			$Validacion->Remote('Usuario', NeuralRutasApp::RutaURL('Ajax_AdminUsuarios/ConsultarExistenciaUsuario'), 'POST', ucwords('actualmente el usuario se encuentra en la base de datos'));
			$Validacion->Requerido('Cedula', 'Ingrese la Cedula Correspondiente');
			$Validacion->Numero('Cedula', 'Solo se Aceptan Datos Númericos');
			$Validacion->Requerido('Nombres', 'Ingrese Los Nombres Correspondiente');
			$Validacion->Requerido('Apellidos', 'Ingrese Los Apellidos Correspondiente');
			$Validacion->Requerido('Cargo', 'Ingrese El Cargo Correspondiente');
			$Validacion->Requerido('Permisos', 'Seleccione el Permiso del Usuario');
			$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form', 'Form', NeuralRutasApp::RutaURL('Ajax_AdminUsuarios/GestionNuevoUsuario/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
			$Script[] = $Validacion->MostrarValidacion('Form');
			
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Nuevo Usuario');
			$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
			$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
			$Plantilla->ParametrosEtiquetas('Permisos', $this->Modelo->ListarPermisos(true));
			$Plantilla->AgregarFuncionAnonima('Codificacion', function ($Texto) {
				return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION'));
			});
			$Plantilla->AgregarFuncionAnonima('LlavePublica', function ($Texto) {
				return AyudasConversorHexAscii::ASCII_HEX($Texto);
			});
			echo $Plantilla->MostrarPlantilla('AdminUsuarios/NuevoUsuario.html', 'GESTION');
		}
		
		public function GestionUsuarios() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Gestionar Usuarios');
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListadoUsuarios(true));
			$Plantilla->ParametrosEtiquetas('Fecha', date("Y-m-d"));
			$Plantilla->AgregarFuncionAnonima('Encriptar', function ($Texto) {
				return AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos($Texto, array(date("Y-m-d"), 'GESTION')));
			});
			$Plantilla->AgregarFuncionAnonima('Codificar', function ($Texto) {
				return AyudasConversorHexAscii::ASCII_HEX($Texto);
			});
			echo $Plantilla->MostrarPlantilla('AdminUsuarios/GestionUsuarios.html', 'GESTION');
		}
		
		public function ActualizarUsuario($Id = false) {
			if($Id == true) {
				$Validacion = new NeuralJQueryValidacionFormulario;
				$Validacion->Requerido('Usuario', 'Ingrese Usuario Correspondiente');
				$Validacion->Requerido('Nombres', 'Ingrese los Nombres del Usuario');
				$Validacion->Requerido('Apellidos', 'Ingrese los Apellidos del Usuario');
				$Validacion->Requerido('Cedula', 'Ingrese la Cédula del Usuario');
				$Validacion->Numero('Cedula', 'Debe Ingresar solo Caracteres Númericos');
				$Validacion->Requerido('Permisos', 'Seleccione el Permiso del Usuario');
				$Validacion->Requerido('Cargo', 'Ingrese el Cargo del Usuario');
				$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form', 'Form', NeuralRutasApp::RutaURL('Ajax_AdminUsuarios/ActualizarDatosUsuarios/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
				$Script[] = $Validacion->MostrarValidacion('Form');
				
				$Permisos = $this->Modelo->ListadoPermisos(true);
				$Plantilla = new NeuralPlantillasTwig;
				$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
				$Plantilla->ParametrosEtiquetas('Titulo', 'Editar Usuario');
				$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ConsultarDatosUsuario(NeuralEncriptacion::DesencriptarDatos(AyudasConversorHexAscii::HEX_ASCII($Id), array(date("Y-m-d"), 'GESTION'))));
				$Plantilla->ParametrosEtiquetas('ListadoPermisos', $Permisos);
				$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
				$Plantilla->AgregarFuncionAnonima('Encriptar', function ($Texto) {
					return NeuralEncriptacion::EncriptarDatos($Texto, 'GESTION');
				});
				$Plantilla->AgregarFuncion('NombrePermiso', function ($Array, $Texto) {
					foreach ($Array AS $Columna => $Valor) { if($Valor['Id'] == $Texto) { $Lista = $Valor['Nombre']; } }
					return (isset($Lista) == true) ? $Lista : 'No Hay Permiso Registrado';
				});
				echo $Plantilla->MostrarPlantilla('AdminUsuarios/EditarUsuario.html', 'GESTION');
			}
			else {
				header("Location: ".NeuralRutasApp::RutaURL('AdminUsuarios'));
				exit();
			}
		}
		
		public function NuevoAsesor() {
			
			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('Usuario', 'Ingrese Usuario Correspondiente');
			$Validacion->Requerido('Nombres', 'Ingrese los Nombres del Asesor');
			$Validacion->Requerido('Apellidos', 'Ingrese los Apellidos del Asesor');
			$Validacion->Requerido('Cedula', 'Ingrese la Cédula del Asesor');
			$Validacion->Numero('Cedula', 'Debe Ingresar solo Caracteres Númericos');
			$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form', 'Form', NeuralRutasApp::RutaURL('Ajax_AdminUsuarios/AgregarAsesor/'.AyudasConversorHexAscii::ASCII_HEX(NeuralEncriptacion::EncriptarDatos(date("Y-m-d"), array(date("Y-m-d"), 'GESTION')))), true, 'GESTION'));
			$Script[] = $Validacion->MostrarValidacion('Form');
			
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Nuevo Asesor');
			//$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminUsuarios/NuevoAsesor.html', 'GESTION');
		}
		
		public function NuevosAsesoresExcel() {
			
			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('Excel', 'Debe Ingresar los datos desde Excel');
			$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Form', 'Form', NeuralRutasApp::RutaURL('Ajax_AdminUsuarios/AgregarAsesoresExcel/'.AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d"))), true, 'GESTION'));
			$Script[] = $Validacion->MostrarValidacion('Form');
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Nuevos Asesores');
			$Plantilla->ParametrosEtiquetas('Script', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
			echo $Plantilla->MostrarPlantilla('AdminUsuarios/AsesoresExcel.html', 'GESTION');
		}
		
		public function GestionAsesores() {
			
			$Plantilla = new NeuralPlantillasTwig;
			$Plantilla->ParametrosEtiquetas('InfoSession', AyudasSessiones::InformacionSessionControlador(true));
			$Plantilla->ParametrosEtiquetas('Titulo', 'Gestion Asesores');
			$Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->ListadoAsesores(true));
			$Plantilla->ParametrosEtiquetas('Fecha', AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d")));
			echo $Plantilla->MostrarPlantilla('AdminUsuarios/GestionAsesores.html', 'GESTION');
		}
	}