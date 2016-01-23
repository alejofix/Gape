<?php
	class Ajax_ChangePass_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		public function CambioPassword($Password = false, $Id = false) {
			if($Password == true AND $Id == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_sistema_usuarios');
				$SQL->AgregarSentencia('Password', sha1($Password));
				$SQL->AgregarCondicion('Id', $Id);
				$SQL->ActualizarDatos();
			}
		}
	}