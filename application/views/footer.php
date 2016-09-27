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
				    	<?php $avatar = $this->session->userdata('avatar'); ?>
				    	<div class="item active historia">
	        				<img class="historia centered img-responsive" src="<?php echo base_url('assets/img/historia/'.$avatar.'/'.$abrirModalHistoria[0].'-1.png'); ?>">
	        			</div>			    
					    <?php 				    	
					    	
					    	for ($i=2; $i <= $abrirModalHistoria[1]; $i++) { 					    					    
					    		echo '<div class="item historia">';
	        					echo 	'<img class="historia centered img-responsive" src="'.base_url('assets/img/historia/'.$avatar.'/'.$abrirModalHistoria[0].'-'.$i.'.png').'">';	        					
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


<!-- MODAL DA CONQUISTA -->

 <!-- Modal -->
  <div class="modal fade" id="modalConquista" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title titulo">Nova conquista alcançada:</h4>
        </div>
        <div class="modal-body">
         <?php            	
         		echo '<div class="row conquista">';
					echo '<h4 class="titulo">'.$nomeConquista[0]->nomeConquista.'</h4>';	        					
				echo '</div>';				    		    	
	    		echo '<div class="row conquista">';
					echo 	'<img class="historia centered img-responsive" src="'.base_url('assets/img/conquistas/conquista-'.$conquista.'.png').'">';	        					
				echo '</div>';	   
	    ?>		
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

	if ($conquista != 0){
		echo '<script language="javascript">';			
				echo '$("#modalConquista").modal();';
		echo '</script>';
	}

?>