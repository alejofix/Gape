<?php
	class Consultas_Modelo extends Modelo {
		
		function __Construct() {
			parent::__Construct();
			AyudasSessiones::ValidarSessionModelo();
		}
		
		public function Consulta() {
			
		}
	}