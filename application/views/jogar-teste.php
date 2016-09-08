
<div id="conteudo" class="col-md-12 col-xs-12 well">				
	<form id="form" class="form-inline" role="form" method="post" action="<?php echo base_url('teste/inserirRodadaTeste');?>">		
			<div class="row">
				<div id="carrosselTestes" class="carousel slide col-md-12 col-xs-12" data-ride="carousel" data-interval="false">
					<div class="row" style="padding: 1%;">
						<div class="col-md-10 col-xs-12 centered">			  				
			  				<div class="centered col-md-12 col-xs-12">
								<p><span class="glyphicon glyphicon-time"></span>
								<input type="text" id="tempo" name="tempo" disabled=""></p>
								<input type="hidden" id="duracao" name="duracao" value="0">
								<input type="hidden" id="abrirModalHistoria" value="<?php echo ($abrirModalHistoria); ?>">
							</div>							
							<div class="carousel-inner" role="listbox">
							<!-- INICIO DO PREENCHIMENTO DINÂMICO DOS TESTES-->
							<?php									
								$i = 0;
								foreach ($testes as $t):	
									if ($i == 0) {					   
										echo '<div class="item active">';	
									} else {
										echo '<div class="item">';
									}
											echo '<div class="row">';
									    		echo '<div class="col-md-12 col-xs-12">';
									    			echo "<h4>". $t->enunciado."</h4>";
										    	echo '</div>';
									    	echo '</div>';														   	
											echo '<div class="row">';
													echo '<div class="col-md-12 col-xs-12">';
														$embaralhadas = array_rand($alternativas, 5);
														echo '<ul class="centered">';
														for ($j=0; $j < 5 ; $j++) {			
															echo '<li><input required type="radio" name="inputJogador'.$i.'" value="'.$alternativas[$embaralhadas[$j]][$i]->alternativa.'">';
															echo $alternativas[$embaralhadas[$j]][$i]->alternativa.'</li><br />';	
															echo '<input type="hidden" name="justificativa'.$i.'" value="'.$alternativas[$embaralhadas[$j]][$i]->justificativa.'">';	
														}
														echo '</ul>';
													echo '</div>';
											echo '</div>';											
										echo '</div>';
									echo '<input type="hidden" id="gabarito'.$i.'" name="gabarito'.$i.'" value="'.$t->gabarito.'" >';									
								$i++;									
								endforeach;	
								echo '<input type="hidden" name="codGrafema" value="'.$codGrafema.'">';			
							?>							

								<!--FIM DO PREENCHIMENTO DINÂMICO DOS TESTES-->

							<!--Botão responder-->
							<div class="item">
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<h3>Clique em Responder para enviar as respostas!</h3>
									</div>
								</div>
								<div class="row centered">
									<div class="col-md-12 col-xs-12">
										<button type="button" class="btn btn-success" onclick="pegarTempoFinal();" name="responder">Responder</button>
										<button type="submit" id="enviarRespostas" class="btn"" name="enviarRespostas"></button>										
									</div>
								</div>
							</div>							
						</div>	

						<!-- Controles -->

			  			<div class="row">
							<a class="right carousel-control" href="#carrosselTestes" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>			  			
					</div>
				</div>
			</div>	
		</div>

<script language="JavaScript">

	var timeCrono; 
	var hor = 0;
	var min = 0;
	var seg = 0;
	var segFinal = 0;
	var segInicio = 0;
	var startTime = new Date(); 
	var start = startTime.getSeconds();

	$("#enviarRespostas").hide();
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
		document.getElementById("enviarRespostas").click();			
	}		


	
</script>
