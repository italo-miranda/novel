﻿
<div id="conteudo" class="col-md-12 col-xs-12">				
	<form id="form" class="form-inline" role="form" method="post" action="<?php echo base_url('palavra/inserirRodadaPalavra');?>">		
			<div class="row">
				<div>
					<button type="button" id="botaoMostrarRegra" class="btn btn-primary" onclick="mostrarRegra()">Ver os ensinamentos do mestre Exímio</button>
					<button type="button" id="botaoSair" class="btn btn-danger" onclick="mostrarSair()">Sair do treinamento</button>
				</div>
				<div id="carrosselPalavras" class="carousel slide col-md-12 col-xs-12" data-ride="carousel" data-interval="false">
					<div class="row" style="padding: 1%;">
						<div class="col-md-8 col-xs-12 centered">			  				
			  				<div class="centered col-md-12 col-xs-12">
								<p><span class="glyphicon glyphicon-time"></span>
								<input type="text" id="tempo" name="tempo" disabled=""></p>
								<input type="hidden" id="duracao" name="duracao" value="0">
								<input type="hidden" id="abrirModalRegra" value="<?php echo ($abrirModalRegra); ?>">
							</div>							
							<div class="carousel-inner" id="corpoCarrosselPalavras" role="listbox">
							<!-- INICIO DO PREENCHIMENTO DINÂMICO DAS PALAVRAS-->
							<?php									
								$i = 0;
								foreach ($palavras as $p):	
									if ($i == 0) {					   
										echo '<div class="item active">';	
									} else {
										echo '<div class="item">';
									}
											echo '<div class="row">';
									    		echo '<div class="col-md-12 col-xs-12">';
									    			$grafemaDividido = explode("_", $grafema);
									    			$tamanho = count($grafemaDividido);								    			
									    			echo '<h2>Complete com ';
									    				for ($j =0 ; $j<$tamanho; $j++){
									    					echo $grafemaDividido[$j];
									    					if ($j == $tamanho - 1){
									    						echo ":";
									    					} else {
									    						if ($j == $tamanho - 2) {
										    						echo " ou ";
										    					} else{
										    						echo ", ";
									    						}
									    					}
									    				}
									    			echo '</h2>';
										    	echo '</div>';
									    	echo '</div>';														   	
											echo '<div class="row centered">';
												if ($p->imagem != NULL){
													echo '<div class="col-md-4 col-xs-12">';
														echo "<img class="."img-responsive"." src=".base_url('assets/img/palavra-fake.png');">";
													echo '</div>';
													echo '<div class="col-md-8 col-xs-12">';
												} else {
													echo '<div class="col-md-2 col-xs-2"></div>';
													echo '<div class="col-md-8 col-xs-8">';
														echo "<p id="."enunciado"."><h3>". $p->enunciado."</h3></p>";		
												}
													echo '</div>';
													echo '<div class="col-md-2 col-xs-2"></div>';
											echo '</div>';

											echo '<div class="row centered">';
												echo '<div class="col-md-12 col-xs-12">';
													$palavraDividida = explode("_", $p->palavraIncompleta);
													echo '<h1 id="palavraIncompleta">';
														echo $palavraDividida[0];
														echo '<input type="text" id="inputLetra'.$i.'" class="input-sm input-palavra" name="inputLetra'.$i.'" required">';
														echo $palavraDividida[1];
													echo '</h1>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '<input type="hidden" id="gabarito'.$i.'" name="gabarito'.$i.'" value="'.$p->letraGabarito.'" >';
									echo '<input type="hidden" name="justificativa'.$i.'" value="'.$p->justificativa.'">';
									echo '<input type="hidden" name="palavraCompleta'.$i.'" value="'.$p->palavraCompleta.'">';	
									$i++;									
								endforeach;	
								echo '<input type="hidden" name="codGrafema" value="'.$codGrafema.'">';
								echo '<input type="hidden" id="url" value="'.base_url().'">';

							?>							

								<!--FIM DO PREENCHIMENTO DINÂMICO DAS PALAVRAS-->

							<!--Botão responder-->
							<div class="item">
								<div class="row centered">
									<div class="col-md-12 col-xs-12">
										<h3>Clique em Responder para enviar as respostas!</h3>
									</div>
								</div>
								<div class="row centered">
									<div class="col-md-12 col-xs-12">
										<button type="button" class="btn btn-success" onclick="pegarTempoFinal();" name="responder">Responder</button>										
									</div>
								</div>
							</div>							
						</div>	

						<!-- Controles -->
						<a class="left carousel-control" href="#carrosselPalavras" role="button" data-slide="prev">
				      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				      <span class="sr-only">Previous</span>

			  			<div class="row">
							<a class="right carousel-control" href="#carrosselPalavras" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>			  			
					</div>
				</div>
			</div>	
		</div>


<!-- Modal da Regra-->
  	<div class="modal fade" id="modalRegra" role="dialog">
	    <div class="modal-dialog modal-lg">
	      <div class="modal-content" id="conteudoModalRegra">
	        <div class="modal-header">
	          	<button type="submit" class="close" data-dismiss="modal">&times;</button>	          
	        </div>
	        <input type="hidden" id="inputs" name="inputs" value=""/>
	        
	        <div id="corpoModal" class="modal-body">          
							
	        	<div id="carrosselRegra" class="carousel slide"  data-ride="carousel" data-interval="false">

				    <!-- Wrapper for slides -->
				    <div class="carousel-inner" role="listbox" >				    
					    <?php 
				    	
					    	$array[] = $regra[0]->regra;
					    	$array[] = $regra[0]->excecoes;
					    	$array[] = $regra[0]->homonimoParonimo;				    					    	
					    					    	
					    	$tamanhoArray = count($array);				    	
					    	for($l = 0; $l < $tamanhoArray; $l++) {
					    		$item = $array[$l];

					    		if ($item != NULL){
					    			if ($l == 0){
					    				echo '<div class="item regra active">';
					    			} else {
					    				echo '<div class="item regra">';
					    			}					    			
					    			    echo '<div class="col-md-2 col-xs-2">';
					    			    echo '</div>';
					    				echo '<div class="col-md-8 col-xs-8">';
						    				echo '<p class="textoRegra">';
								    			$tamanhoItem = strlen($item);
								    			for($m = 0; $m < $tamanhoItem; $m++){
								    				if (strcmp($item[$m], ":") == 0 ){
								    					echo $item[$m].'<br />';				    					
								    				} elseif (strcmp($item[$m], "|") == 0) {
								    					echo '<br />';
								    				} elseif (strcmp($item[$m], "[") == 0){
								    					echo '<h3 class="titulo centered">';
								    				} elseif (strcmp($item[$m], "]") == 0){
								    					echo '</h3><br />';
								    				} else {
								    					echo $item[$m];
								    				}				    				
								    			}
								    		echo '</p>';
								    	echo '</div>';
								    	echo '<div class="col-md-2 col-xs-2">';
					    			    echo '</div>';
					    			echo '</div>';
					    		}
					    	}					    
					    ?>		    
				    </div>

				    <!-- Left and right controls -->
				    <a class="left carousel-control" href="#carrosselRegra" role="button" data-slide="prev">
				      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				      <span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#carrosselRegra" role="button" data-slide="next">
				      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				      <span class="sr-only">Next</span>
				    </a>
				  </div>

	        </div>
		    <div class="row centered">
		    	<div class="modal-footer">
		    		<button type="button" id="sairGabarito" data-dismiss="modal" class="btn btn-default">Fechar</button>
		        </div>
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

	mostrarRegra();	

	function mostrarRegra(){		
		$("#modalRegra").modal();		
	}

	function mostrarSair(){
		var confirma  =  confirm("Deseja mesmo sair? Sua pontuação não será computada.");
		if (confirma){
			url = document.getElementById("url").value;			
			string = url+"/principal/menu";
			window.location.href = string;
		}
	}
	
</script>


</form>


