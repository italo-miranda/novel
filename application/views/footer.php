</div>

<!--MODAL DA HISTORIA-->

<div class="modal fade" id="modalHistoria" role="dialog">		
	    <div class="modal-dialog modal-lg">
	      <div class="modal-content" id="conteudoModalHistoria">
	        <div class="modal-header">
	          	<button type="submit" class="close" data-dismiss="modal">&times;</button>	          
	        </div>
	        
	        <div id="corpoModal" class="modal-body">          
							
	        	<div id="carrosselHistoria" class="carousel slide"  data-ride="carousel" data-interval="false">
	        		
				    <!-- Wrapper for slides -->
				    <div class="carousel-inner" role="listbox" >	

				    	<div class="item active">
	        				<img class="historia centered" src="<?php echo base_url('assets/img/historia/'.$abrirModalHistoria[0].'-1.jpg'); ?>">
	        			</div>			    
					    <?php 				    	
					    	for ($i=2; $i <= $abrirModalHistoria[1]; $i++) { 					    					    
					    		echo '<div class="item">';
	        					echo 	'<img class="historia centered" src="'.base_url('assets/img/historia/'.$abrirModalHistoria[0].'-'.$i.'.jpg').'">';
	        					echo $i;
	        					echo '</div>';
					    	}  
					    ?>		    
				    </div>

				    <!-- Left and right controls -->
				    <a class="left carousel-control" href="#carrosselHistoria" role="button" data-slide="prev">
				      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				      <span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#carrosselHistoria" role="button" data-slide="next">
				      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				      <span class="sr-only">Next</span>
				    </a>
				  </div>

	        </div>
		    <div class="row centered">
		    	<div class="modal-footer">
		    			<button type="button" id="sairHistoria" data-dismiss="modal" class="btn btn-default">Fechar</button>		    		
		        </div>
		    </div>
	      </div>
	    </div>
	  </div>
	</div>




<div class="row centered">
	<div class="col-md-12 col-xs-12" well" id="footer" style="padding: 1%;">
		<h5>Novel - Um Software Educativo para a Aprendizagem Autônoma de Ortografia - 2016</h5>	
	</div>
</div>
	

<!-- Fechamentos das divs principais. Não apagar!-->
	</div>
</div>
<!-- Fim do conteudo -->

</body>
</html>

<?php
	if ($abrirModalHistoria != FALSE){
		echo '<script language="javascript">';			
				echo '$("#modalHistoria").modal();';
		echo '</script>';
	}
?>