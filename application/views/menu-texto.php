	<!-- Aqui é a área do conteúdo -->
	<div id="conteudo" class="col-md-12 col-xs-12 well">
		<div class="row">
				<h3 class="titulo-menu">Nível Texto</h3>
		</div>
		<div id="imagens-menu" class="centered" >
			<?php
					$tamGrafemasBD = count($grafemasTextos);
					$grafemas = array();
					for ($i=1; $i < $tamGrafemasBD; $i++) { 
						if(!array_search($grafemasTextos[$i], $grafemas)){
							$grafemas[] = $grafemasTextos[$i];
						}																
					}																
					echo '<div class="row afastado-1pc">';
						$tamGrafemasUnicos = count($grafemas);
						for($i = 0; $i<$tamGrafemasUnicos; $i++) {
							if ($i==4){
								echo '</div>';
								echo '<div class="row afastado-1pc">';
							}

							echo '<div class="col-md-3 col-xs-6">';
								echo '<div class="row centered">';
									$url = 'texto/jogarTexto/'.$grafemas[$i];
									echo '<a href="'.base_url($url).'">';
										$url = 'assets/img/grafemasTextos/'.$grafemas[$i].'.png';
										echo '<img class="img-texto img-responsive centered" src="'.base_url($url).'">';
									echo '</a>';
								echo '</div>';												
							echo '<div class="row">';
								$tamGrafemasJogados = count($grafemasJogados);
								for ($j=0; $j < $tamGrafemasJogados; $j++) { 
									if (($grafemasJogados[$j] == $grafemas[$i])){
										echo '<span class="glyphicon glyphicon-check" aria-hidden="true"/>';
									}								
								}							
							echo '</div>';		
						echo '</div>';
						}
					echo '</div>';									
			?>
		</div>

		<input type="hidden" id="abrirModalGabarito" value="<?php echo ($abrirModalGabarito); ?>">		
		<input type="hidden" id="erro" value="<?php echo ($erro); ?>">			
		<input type="hidden" id="abrirModalHistoria" value="<?php echo ($abrirModalHistoria[0]); ?>">

<!-- Modal -->
  	<div class="modal fade" id="modalGabarito" role="dialog">
	    <div class="modal-dialog modal-lg">
	      <div class="modal-content">
	        <div class="modal-header">
	          	<button type="submit" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Veja seu desempenho!</h4>
	        </div>	        
	        <div class="modal-body">          
					<?php		
						echo '<div class="table-responsive">';															
							echo '<table class="centered tabela-gabarito table-bordered table-striped">';
								echo '<tr>';
									echo '<th class="titulo"> Sua resposta </th>';
									echo '<th class="titulo"> Gabarito </th>';
								echo '<tr>';
								$i = 0;
								foreach ($inputJogador as $input => $value) {
									echo '<tr>';
										echo '<td>'.$value.'</td>';	
										echo '<td>'.$gabarito[$i]->letraGabarito.'</td>';	
									echo '</tr>';
								$i++;
								}
							echo '</table>';
						echo '</div>';
						echo '<p class="centered" > Sua pontuação foi '.$pontuacao. ' pontos!</p>';						
					?>			
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


<!--Mostrar mensagem de erro se o o jogador ainda não estiver apto a jogar um texto-->
<?php	
	if ($erro){							
		echo '<script language="javascript">';
		echo  'alert("Você ainda não está apto! \nPara jogar este texto você precisa ter jogado os grafemas mostrados nos ícones de cada fase.")';	
		echo '</script>';						
	}
?>	


<script type="text/javascript">

var abrir = document.getElementById("abrirModalGabarito").value;
	if(abrir){
			mostrarGabarito();	
	} 

	function mostrarGabarito(){		
		$("#modalGabarito").modal();		
	}

</script>