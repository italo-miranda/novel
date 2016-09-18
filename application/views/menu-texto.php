	<!-- Aqui é a área do conteúdo -->
	<div id="conteudo" class="col-md-12 col-xs-12 well">
		<div class="row">
				<h3 class="titulo-menu">Nível Texto</h3>
		</div>

		<?php
				$tamGrafemasBD = count($grafemasTextos);
				echo '<div class="row afastado-1pc">';

				for($i = 0; $i<$tamGrafemasBD; $i++) {
					if (($i%4)==0){
						echo '</div>';
						echo '<div class="row afastado-1pc">';
					}

					echo '<div class="col-md-3 col-xs-6">';
						echo '<div class="row">';
							$url = 'teste/jogarTeste/'.$grafemasCadastrados[$i]->tipoGrafema;
							echo '<a href="'.base_url($url).'">';
								$url = 'assets/img/grafemas/'.$grafemasCadastrados[$i]->tipoGrafema.'.png';
								echo '<img src="'.base_url($url).'">';		
							echo '</a>';
						echo '</div>';
						echo '<div class="row">';
							for ($j=0; $j < $tamGrafemasJogados; $j++) { 
								if (($grafemasJogados[$j]->tipoGrafema == $grafemasCadastrados[$i]->tipoGrafema) && $grafemasJogados[$j]->pontuacao > 60){
									echo '<span class="glyphicon glyphicon-check" aria-hidden="true"/>';
								}								
							}
							
						echo '</div>';
					echo '</div>';
				}
				echo '</div>';

				
		?>
		<div id="imagens-menu" class="centered" >		
			<div class="row afastado-1pc">
				<div class="col-md-3 col-xs-6">				
					<div class="row">
						<a href="<?php echo base_url("texto/jogarTexto/ch_x&ss_s_ç_z&rr_r");?>">
							<img class="img-texto img-responsive" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
						</a>	
					</div>			
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-texto img-responsive" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>			
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-texto img-responsive" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>				
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-texto img-responsive" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>					
				</div>				
			</div>

			<div class="row afastado-1pc">
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-texto img-responsive" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>			
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-texto img-responsive" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>					
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-texto img-responsive" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>				
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-texto img-responsive" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>				
				</div>				
			</div>
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