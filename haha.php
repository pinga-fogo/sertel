		$linhas = file('/etc/asterisk/kgroupsGsm.conf');
			$rodizio = file('/etc/asterisk/rodizio_chips.conf');
			$lista_rodizio = explode(';', $rodizio[0]);

			foreach($linhas as $linha){
				write_console('Entre_Centrais.php', __LINE__, 'Ligação Entre centrais !!');
				$agi->exec('NOOP', 'LINHA:'.$linha);

				if(strpos($linha, '=') !== FALSE){
					$array = explode('=', $linha);
					if($array[0] == 'Rodizio_chips'){
						chips = explode('+', $array[1]);
						foreach($chips as $chip){
							if(!in_array($chip, $lista_rodizio)){
								$placa_canal = $chip;
								
								$agi->exec('NOOP', 'CHIP:'.$chip);
							   
							    array_push($lista_rodizio, $chip);
							    $lista_rodizio_nova = implode(';', $lista_rodizio );
							    file_put_contents("/etc/asterisk/rodizio_chips.conf", $lista_rodizio_nova);
							}
						}
					}
				}
		
