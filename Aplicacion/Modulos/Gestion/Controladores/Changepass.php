<?php
	class ChangePass extends Controlador {
		
		function __Construct() {
            parent::__Construct();
            AyudasSessiones::ValidarSession();
			
		}
		
		public function Index() {
			
			$Validacion = new NeuralJQueryValidacionFormulario;
			$Validacion->Requerido('PW_1', 'Ingrese la Nueva Contraseña');
			$Validacion->Requerido('PW_2', 'Ingrese la Confirmación de la Contraseña');
            $Validacion->IgualACampo('PW_1', 'PW_2', 'Las Contraseñas No Coinciden');
            $Validacion->RangoLongitud('PW_1', '8', '20', 'El Campo Debe Tener 8 a 20 caracteres');
			$Validacion->SubmitHandler(NeuralJQueryAjax::EnviarFormularioPOST('Formulario', 'respuesta', NeuralRutasApp::RutaURL('Ajax_ChangePass/CambioPassword/'.AyudasConversorHexAscii::ASCII_HEX(date("Y-m-d"))), true, 'GESTION'));
            $Script[] = $Validacion->MostrarValidacion('Formulario');
            
            $Parametros = AyudasSessiones::InformacionSessionControlador(true);
			$Plantilla = new NeuralPlantillasTwig;
            $Plantilla->ParametrosEtiquetas('InfoSession', $Parametros);
            $Plantilla->ParametrosEtiquetas('Titulo', 'Cambio Contraseña');
            $Plantilla->ParametrosEtiquetas('Consulta', $this->Modelo->InformacionUsuario($Parametros['Usuario']));
            $Plantilla->ParametrosEtiquetas('Scrip', NeuralScriptAdministrador::OrganizarScript(false, $Script, 'GESTION'));
            $Plantilla->AgregarFuncionAnonima('Codificar', function ($Texto) {
            	return NeuralEncriptacion::EncriptarDatos($Texto, array(date("Y-m-d"), 'GESTION'));
            });
         	echo $Plantilla->MostrarPlantilla('CambiosPasswordUsuario/ChangePass.html', 'GESTION');
         	
         	Ayudas::print_r($this->Modelo->InformacionUsuario($Parametros['Usuario']));
		}
	}