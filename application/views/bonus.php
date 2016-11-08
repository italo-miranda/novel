<!-- Aqui e a area do conteudo -->
	<div class="col-md-12 col-xs-12 afastado-1pc vertical-center">
		<div class="col-md-9 col-xs-12 centered">
			<form id="form" role="form" method="post" action="<?php echo base_url('principal/inserirBonus');?>">
				<div class="row">
					<table id="tabela-bonus" class="centered table">					
						<?php							
							echo '<input type="hidden" name="codBonus" value="'.$bonus[2][0]->codBonus.'"';
							$j = 1;						
							for ($i=0; $i <= 224; $i++) {						
								if($i==0){
									echo '<tr>';									
										echo '<td id="td'.$i.'" onclick="clicou('.$i.')">
											<input type="checkbox" id="'.$i.'" name="'.$i.'" class="checkbox-bonus" value="'.$i.'"><label for="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</label></td>';
									$j++;
								} elseif($j == 1){
									echo '</tr>';
									echo '<tr>';									
										echo '<td id="td'.$i.'" onclick="clicou('.$i.')">
											<input type="checkbox" id="'.$i.'" name="'.$i.'" class="checkbox-bonus"  value="'.$i.'"><label for="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</label></td>';		
									$j++;
								}elseif ($j == 15){																
										echo '<td id="td'.$i.'" onclick="clicou('.$i.')">
											<input type="checkbox" id="'.$i.'" name="'.$i.'" class="checkbox-bonus" value="'.$i.'"><label for="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</label></td>';
									$j = 1;
								} else {
									if ($i == 224){
										echo '<td id="td'.$i.'" onclick="clicou('.$i.')">
											<input type="checkbox" id="'.$i.'" name="'.$i.'" class="checkbox-bonus" value="'.$i.'"><label for="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</label></td>';
										$j++;
										echo '</tr>';
									}else {
										echo '<td id="td'.$i.'" onclick="clicou('.$i.')">
											<input type="checkbox" id="'.$i.'" name="'.$i.'" class="checkbox-bonus" value="'.$i.'"><label for="'.$i.'">'.$bonus[0][0]->textoBonus[$i].'</label></td>';
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
						<button class="btn btn-block btn-success centered" type="submit">Enviar</button>
					</div>
					<div class="col-xs-2 col-md-2"></div>
				</div>
			</form>
		</div>	

<script type="text/javascript">
	desaparecer();
	function desaparecer(){
		$(".checkbox-bonus").hide();
	}
	function clicou(id){
		td = "td"+id;		
		if (document.getElementById(td).style.background == "yellow"){
			document.getElementById(td).style.background = "#ADD8E6";
			document.getElementById(id).checked = false;
		} else{
			document.getElementById(td).style.background = "yellow";
			document.getElementById(id).checked = true;		
		}		
	}
</script>