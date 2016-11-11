<!-- Aqui e a area do conteudo -->
	<div class="col-md-12 col-xs-12 afastado-1pc vertical-center">
		<div class="col-md-9 col-xs-12 centered">
			<div class="row centered">
				<p><span class="glyphicon glyphicon-time"></span>
				<input type="text" id="tempo" name="tempo" disabled=""></p>
			</div>
			<form id="form" role="form" method="post" action="<?php echo base_url('principal/inserirBonus');?>">
				<div class="row">
					<table id="tabela-bonus" class="centered table">					
						<?php
							
							echo '<input type="hidden" name="codBonus" value="'.$bonus[2][0]->codBonus.'">';
							echo '<input type="hidden" name="nivel" value="'.$nivel.'">';
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
						<button class="btn btn-block btn-success centered" id="enviar" type="submit">Enviar</button>
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

	var timeCrono; 
	var hor = 0;
	var min = 0;
	var seg = 60;
	var startTime = new Date(); 
	var start = startTime.getSeconds();

	iniciarCronometro();

	function iniciarCronometro() {
		if (seg - 1 <= 0) { 
			document.getElementById("enviar").click();
		}

		var time = new Date(); 
		if (time.getSeconds() >= start) {
			seg--;
		} 
		/*else {
			seg = 60 + (time.getSeconds() - start);
		}*/
		timeCrono= (hor < 10) ? "0" + hor : hor;
		timeCrono+= ((min < 10) ? ":0" : ":") + min;
		timeCrono+= ((seg < 10) ? ":0" : ":") + seg;
		document.getElementById("tempo").value = timeCrono;
		setTimeout("iniciarCronometro()",1000);
	} 
</script>