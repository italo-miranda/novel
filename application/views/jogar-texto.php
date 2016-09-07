<div id="conteudo" class="col-md-12 col-xs-12 well">
	<form id="form" class="form-inline" role="form" method="post" action="<?php echo base_url('texto/inserirRodadaTexto');?>">	
		<div class="row">
			<div class="col-md-8 col-xs-12 centered">									
				<p><span class="glyphicon glyphicon-time"></span>
				<input type="text" id="tempo" name="tempo" disabled=""></p>
				<input type="hidden" id="duracao" name="duracao" value="0">
				<?php 
					echo '<div class="row">';
						echo '<h3> Preencha os campos com ';
							$grafemasUnderline = explode('&', $grafemas);
							$tamanhoUnderline = count($grafemasUnderline);							
							for ($i = 0; $i < $tamanhoUnderline; $i++) {
								$grafemaSeparado = explode("_", $grafemasUnderline[$i]);
								$tamanhoSeparado = count($grafemaSeparado);
								for($j = 0; $j < $tamanhoSeparado; $j++) {
									if (($i == $tamanhoUnderline - 1) && ($j == $tamanhoSeparado - 1) ){
										echo $grafemaSeparado[$j].':';									
									} elseif (($i == $tamanhoUnderline - 1) && ($j == $tamanhoSeparado - 2)) {
										echo $grafemaSeparado[$j].', ou ';
									} else {
										echo $grafemaSeparado[$j].', ';
									}
								}
							}
						echo'</h3>';
					echo '</div>';
					echo '<p id="paragrafoTexto" ">';	
						$enunciado = explode("_", $texto[0]->textoIncompleto);
						$tamanho = count($enunciado);
						for ($i = 0; $i < $tamanho; $i++){
							$tamanhoString = strlen($enunciado[$i]);
							$string = $enunciado[$i];
							
							for ($j = 0; $j < $tamanhoString; $j++){
								if ((strcmp($string[$j],"-") == 0) && (strcmp($string[$j+1]," ") == 0)){
									echo '<br />';
								}							
								echo $string[$j];
							}
							if ($i != $tamanho -1){
								echo '<input type="text" id="inputLetra'.$i.'" required class="input-sm" name="inputLetra'.$i.'" style="width:8%;">';	
							}
						}
					echo '</p>';
					echo '<input type="hidden" name="grafemas" value="'.$grafemas.'">';								
					echo '<input type="hidden" name="codTexto" value="'.$texto[0]->codTexto.'">';
				?>	
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<button type="button" class="btn btn-success" onclick="pegarTempoFinal();" name="responder">Responder</button>
					</div>
				</div>
																			
			</div>
		</div>
	</form>


	<script language="JavaScript">

	var timeCrono; 
	var hor = 0;
	var min = 0;
	var seg = 0;
	var segFinal = 0;
	var segInicio = 0;
	var startTime = new Date(); 
	var start = startTime.getSeconds();

	iniciarCronometro();

	function iniciarCronometro() {
		if (seg + 1 > 59) { 
			min+= 1;
		}
		if (min > 59) {
			min = 0;
		hor+= 1;
		}
		var time = new Date(); 
		if (time.getSeconds() >= start) {
			seg = time.getSeconds() - start;
		} 
		else {
			seg = 60 + (time.getSeconds() - start);
		}
		timeCrono= (hor < 10) ? "0" + hor : hor;
		timeCrono+= ((min < 10) ? ":0" : ":") + min;
		timeCrono+= ((seg < 10) ? ":0" : ":") + seg;
		document.getElementById("tempo").value = timeCrono;
		setTimeout("iniciarCronometro()",1000);
	} 

	function pegarTempoFinal() {
		
		var finalTime = new Date(); 

		segInicio = (((startTime.getHours()*60) + startTime.getMinutes())*60) + startTime.getSeconds();
		segFinal = (((finalTime.getHours()*60) + finalTime.getMinutes())*60) + finalTime.getSeconds();

		var duracao = segFinal - segInicio;
		document.getElementById("duracao").value = duracao - 1;		
		document.getElementById("form").submit();
	}	
	
</script>