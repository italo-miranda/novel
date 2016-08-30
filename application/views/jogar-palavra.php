
<div id="conteudo" class="col-md-12 col-xs-12 well">
	
			<div class="row">
				<div id="myCarousel" class="carousel slide col-md-12 col-xs-12" data-ride="carousel" data-interval="false">
					<div class="row" style="padding: 1%;">
						<div class="col-md-8 col-xs-12 centered">			  				
			  				<div class="centered col-md-12 col-xs-12">
								<p><span class="glyphicon glyphicon-time"></span>
								<?php //echo($tempo); ?>Tempo</p>
							</div>							
							<div class="carousel-inner" role="listbox">
							<!-- INICIO DO PREENCHIMENTO DINÂMICO DAS PALAVRAS-->
							<!-- Em cada div abaixo irá uma questão-->
								<!-- Questão 1-->
								<div class="item active">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<h3>Complete com <?php //echo($tipoGrafema); ?></h3>
										</div>										
									</div>

									<div class="row centered">
										<div class="col-md-4 col-xs-12">
											<img src="<?php echo base_url('assets/img/palavra-fake.png'); ?>">
										</div>
										<div class="col-md-8 col-xs-12">
											<p><?php //echo($enunciado); ?>Aqui vai o enunciado da questão 1</p>
										</div>
									</div>
									
									<div class="row centered">
										<div class="col-md-12 col-xs-12">
											<p>
											<?php //echo($palavra1_metade1); ?>metade_1
											<input type="text" class="input-sm"name="letra1">
											<?php //echo($palavra1_metade2); ?>metade_2
											</p>
										</div>
									</div>														
								</div>

								<!-- Questão 2-->
								<div class="item">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<h3>Complete com <?php //echo($tipoGrafema); ?></h3>
										</div>										
									</div>

									<div class="row centered">
										<div class="col-md-4 col-xs-12">
											<img src="<?php echo base_url('assets/img/palavra-fake.png'); ?>">
										</div>
										<div class="col-md-8 col-xs-12">
											<p><?php //echo($enunciado); ?>Aqui vai o enunciado da questão 1</p>
										</div>
									</div>
									
									<div class="row centered">
										<div class="col-md-12 col-xs-12">
											<p>
											<?php //echo($palavra1_metade1); ?>metade_1
											<input type="text" class="input-sm"name="letra1">
											<?php //echo($palavra1_metade2); ?>metade_2
											</p>
										</div>
									</div>															
								</div>

								<!-- Questão 3-->
								<div class="item">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<h3>Complete com <?php //echo($tipoGrafema); ?></h3>
										</div>										
									</div>

									<div class="row centered">
										<div class="col-md-4 col-xs-12">
											<img src="<?php echo base_url('assets/img/palavra-fake.png'); ?>">
										</div>
										<div class="col-md-8 col-xs-12">
											<p><?php //echo($enunciado); ?>Aqui vai o enunciado da questão 1</p>
										</div>
									</div>
									
									<div class="row centered">
										<div class="col-md-12 col-xs-12">
											<p>
											<?php //echo($palavra1_metade1); ?>metade_1
											<input type="text" class="input-sm"name="letra1">
											<?php //echo($palavra1_metade2); ?>metade_2
											</p>
										</div>
									</div>														
								</div>

								<!-- Questão 4-->
								<div class="item">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<h3>Complete com <?php //echo($tipoGrafema); ?></h3>
										</div>										
									</div>

									<div class="row centered">
										<div class="col-md-4 col-xs-12">
											<img src="<?php echo base_url('assets/img/palavra-fake.png'); ?>">
										</div>
										<div class="col-md-8 col-xs-12">
											<p><?php //echo($enunciado); ?>Aqui vai o enunciado da questão 1</p>
										</div>
									</div>
									
									<div class="row centered">
										<div class="col-md-12 col-xs-12">
											<p>
											<?php //echo($palavra1_metade1); ?>metade_1
											<input type="text" class="input-sm"name="letra1">
											<?php //echo($palavra1_metade2); ?>metade_2
											</p>
										</div>
									</div>															
								</div>

								<!-- Questão 5-->
								<div class="item">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<h3>Complete com <?php //echo($tipoGrafema); ?></h3>
										</div>										
									</div>

									<div class="row centered">
										<div class="col-md-4 col-xs-12">
											<img src="<?php echo base_url('assets/img/palavra-fake.png'); ?>">
										</div>
										<div class="col-md-8 col-xs-12">
											<p><?php //echo($enunciado); ?>Aqui vai o enunciado da questão 1</p>
										</div>
									</div>
									
									<div class="row centered">
										<div class="col-md-12 col-xs-12">
											<p>
											<?php //echo($palavra1_metade1); ?>metade_1
											<input type="text" class="input-sm"name="letra1">
											<?php //echo($palavra1_metade2); ?>metade_2
											</p>
										</div>
									</div>															
								</div>	
								<!-- FIM DO PREENCHIMENTO DINÂMICO DAS PALAVRAS-->

								<!--Botão responder-->
								<div class="item">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<h3>Clique em Responder para enviar as respostas!</h3>
										</div>
									</div>
									<div class="row centered">
										<div class="col-md-12 col-xs-12">
											<button type="submit" class="btn btn-success" name="letra">Responder</button>
										</div>
									</div>
								</div>							
							</div>	

							<!-- Controles -->
				  			<div class="row">
								<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>			  			
						</div>
					</div>
				</div>	
			</div>


				
<!--

PREENCHIMENTO DINAMICO DO CARROSSEL

<?php
/*
i = 1;
foreach ($palavra as $p):
    if (i==1):
    	echo '<div class="item active">';
    elseif:
		echo '<div class="item">';
	endif;
    	echo '<div class="row">';
    		echo '<div class="col-md-12 col-xs-12">';
    			echo '<h3>"Complete com '$p->tipoGrafema'"</h3>';
    		echo '</div>';
    	echo '</div>';
		echo '<div class="row centered">';
			echo '<div class="col-md-4 col-xs-12">';
				echo '<img src="echo base_url('assets/img/palavra-fake.png')">';
			echo '</div>';
			echo '<div class="col-md-8 col-xs-12">';
				echo "<p> '$p->enunciado'</p>";
			echo '</div>';
		echo '</div>';
		echo '<div class="row centered">';
			echo '<div class="col-md-12 col-xs-12">';
				echo '<p>';
					echo $p->metade1;
					echo '<input type="text" class="input-sm"name="letra1">';
					echo $p->metade2;
				echo '</p>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	i = 0;
endforeach;
*/            
?>

-->