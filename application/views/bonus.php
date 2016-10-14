<!-- Aqui e a area do conteudo -->
	<div class="col-md-12 col-xs-12 afastado-1pc vertical-center">
		<div class="col-md-9 col-xs-12 centered">
			<div class="row">
				<table class="centered">					
					<?php
						$j = 1;						
						for ($i=0; $i <= 224; $i++) {					
							if($i==0){
								echo '<tr>';									
									echo '<td>'.$bonus[0][0]->textoBonus[$i].'</td>';								
								$j++;
							} elseif($j == 1){
								echo '</tr>';
								echo '<tr>';									
									echo '<td>'.$bonus[0][0]->textoBonus[$i].'</td>';								
								$j++;
							}elseif ($j == 15){																
									echo '<td>'.$bonus[0][0]->textoBonus[$i].'</td>';
								$j = 1;
							} else {
								if ($i == 224){
									echo '<td>'.$bonus[0][0]->textoBonus[$i].'</td>';	
									$j++;
									echo '</tr>';
								}else {
									echo '<td>'.$bonus[0][0]->textoBonus[$i].'</td>';	
									$j++;
								}								
							}							
						}
					?>
				</table>
			</div>
		</div>