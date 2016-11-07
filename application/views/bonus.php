<!-- Aqui e a area do conteudo -->
	<div class="col-md-12 col-xs-12 afastado-1pc vertical-center">
		<div class="col-md-9 col-xs-12 centered">
			<form id="form" role="form" method="post" action="<?php echo base_url('principal/inserirBonus');?>">
			<div class="row">
				<table id="tabela-bonus" class="centered table">					
					<?php																	
						$j = 1;						
						for ($i=0; $i <= 224; $i++) {						
							if($i==0){
								echo '<tr>';									
									echo '<td onclick="clicou(this)">
										<input type="checkbox" class="checkbox-bonus" value="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</td>';
								$j++;
							} elseif($j == 1){
								echo '</tr>';
								echo '<tr>';									
									echo '<td onclick="clicou(this)">
										<input type="checkbox" class="checkbox-bonus" value="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</td>';		
								$j++;
							}elseif ($j == 15){																
									echo '<td onclick="clicou(this)">
										<input type="checkbox" class="checkbox-bonus" value="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</td>';
								$j = 1;
							} else {
								if ($i == 224){
									echo '<td onclick="clicou(this)">
										<input type="checkbox" class="checkbox-bonus" value="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</td>';
									$j++;
									echo '</tr>';
								}else {
									echo '<td onclick="clicou(this)">
										<input type="checkbox" class="checkbox-bonus" value="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</td>';
									$j++;
								}								
							}							
						}
					?>
				</table>
			</div>
			<div class="row">
				<div class="col-xs-2 col-md-2"></div>
				<div class="col-xs-8 col-md-8">
					<input class="btn btn-block btn-success centered" type="submit" name="enviar">
				</div>
				<div class="col-xs-2 col-md-2"></div>
			</div>
		</div>
	</form>
<script type="text/javascript">

	desaparecer();
	function desaparecer(){
		$(".checkbox-bonus").hide();
	}
	function clicou(id){
		if (id.style.background == "yellow"){
			id.style.background = "#ADD8E6";
		} else{
			id.style.background = "yellow";
		}		
	}
</script>