<?php
	class Ajax_BaseGestion_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		public function GuardarIIMS($Array = false) {
			if($Array == true AND  is_array($Array) == true) {
				$SQL = new NeuralBDGab;
				$SQL->SeleccionarDestino('GESTION', 'tbl_base_general');
				foreach ($Array AS $Columna => $Valor) {
					$SQL->AgregarSentencia($Columna, $Valor);
				}
				$SQL->AgregarSentencia('Tipo_Reporte', 'IIMS');
				$SQL->InsertarDatos();
			}
		}
	}