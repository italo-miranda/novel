<div id="conteudo" class="col-md-12 col-xs-12 well">
  <!-- Modal -->
  	<div class="modal fade" id="pop" role="dialog">
	    <div class="modal-dialog modal-sm">
	      <div class="modal-content">
	        <div class="modal-header">
	          <a href="<?php echo base_url('principal/menu');?>">
	          	<button type="submit" class="close">&times;</button>
	          </a>
	          <h4 class="modal-title">Veja seu desempenho!</h4>
	        </div>
	        <input type="hidden" id="inputs" name="inputs" value=""/>
	        <div class="modal-body">          
					<?php						
						echo '<table class="centered tabela-gabarito" border="1%">';
							echo '<tr>';
								echo '<th> Sua resposta </td>';
								echo '<th> Gabarito </td>';
							echo '<tr>';
							$i = 0;
							foreach ($inputJogador as $input => $value) {
								echo '<tr>';
									echo '<td>'.$value.'</td>';	
									echo '<td>'.$gabarito['gabarito'.$i].'</td>';	
								echo '</tr>';
							$i++;
							}
						echo '</table>';
						echo '<p class="centered" > Sua pontuação foi '.$pontuacao. ' pontos!</p>';						
					?>			
	        </div>
		    <div class="row centered">
		    	<div class="modal-footer">
		    		<a href="<?php echo base_url('principal/menu');?>">
		    			<button type="button" id="sairGabarito" class="btn btn-default">Fechar</button>
		    		</a>
		        </div>
		    </div>
	      </div>
	    </div>
	  </div>
	</div>


<script type="text/javascript">
	mostrarGabarito();

	function mostrarGabarito(){		
		$("#pop").modal();		
	}

</script>