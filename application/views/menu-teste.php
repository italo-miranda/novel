	<!-- Aqui é a área do conteúdo -->
	<div id="conteudo" class="col-md-12 col-xs-12 well">
		<div class="row">
				<h3 class="titulo-menu">Nível Teste</h3>
		</div>
		<div id="imagens-menu" class="centered" >		
			<div class="row afastado-1pc">
				<div class="col-md-3 col-xs-6">				
					<div class="row">
						<a href="<?php echo base_url("teste/jogarTeste/ch_x");?>">
							<img class="img-teste" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
						</a>	
					</div>			
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-teste" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>			
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-teste" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>				
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-teste" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>					
				</div>				
			</div>

			<div class="row afastado-1pc">
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-teste" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>			
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-teste" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>					
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-teste" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>				
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="row">
						<img class="img-teste" src="<?php echo base_url('assets/img/grafema-fake.png'); ?>">
					</div>				
				</div>				
			</div>
		</div>
		<input type="hidden" id="abrirModalGabarito" value="<?php echo ($abrirModalGabarito); ?>">		
		<input type="hidden" id="abrirModalHistoria" value="<?php echo ($abrirModalHistoria[0]); ?>">		

<!-- Modal -->
  	<div class="modal fade" id="modalGabarito" role="dialog">
	    <div class="modal-dialog modal-sm">
	      <div class="modal-content">
	        <div class="modal-header">
	          	<button type="submit" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Veja seu desempenho!</h4>
	        </div>
	        <input type="hidden" id="inputs" name="inputs" value=""/>
	        <div class="modal-body">          
					<?php																	
						echo '<table class="centered tabela-gabarito" border="1%">';
							echo '<tr>';
								echo '<th> Sua resposta </th>';
								echo '<th> Gabarito </th>';
							echo '<tr>';
							$i = 0;
							foreach ($inputJogador as $input => $value) {
								echo '<tr>';
									echo '<td>'.$value.'</td>';	
									echo '<td>'.$gabarito[$i].'</td>';
								echo '</tr>';
							$i++;
							}
						echo '</table>';
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

<script type="text/javascript">

var abrir = document.getElementById("abrirModalGabarito").value;
	if(abrir){
			mostrarGabarito();	
	} 

	function mostrarGabarito(){		
		$("#modalGabarito").modal();		
	}

</script>