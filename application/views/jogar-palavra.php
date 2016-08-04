<div id="conteudo" class="col-md-12 col-xs-12 well">
	<div class="row" style="padding: 1%;">
		<div class="col-md-8 col-xs-12 centered">
			<div class="row">
				<div class="col-md-4 col-xs-12">
					<h3>Complete com <?php //echo($tipoGrafema); ?></h3>
				</div>
				<div class="col-md-8 col-xs-12">
					<span class="glyphicon glyphicon-stopwatch"></span>
					<p><?php //echo($tempo); ?>Tempo</p>
				</div>
			</div>
			<div class="row centered">
				<div class="col-md-4 col-xs-12">
					<img src="<?php echo base_url('assets/img/palavra-fake.png'); ?>">
				</div>
				<div class="col-md-8 col-xs-12">
					<p><?php //echo($enunciado); ?>Aqui vai o enunciado da questão</p>
				</div>
			</div>
			<div class="row centered">
			<div class="col-md-12 col-xs-12">
					<p>
						<?php //echo($palavra_metade1); ?>metade_1
						<input type="text" class="input-sm"name="letra">
						<?php //echo($palavra_metade1); ?>metade_2
					</p>
				</div>
			</div>	
			<div class="row centered">
				<div class="col-md-12 col-xs-12">
					<button type="submit" class="btn btn-success" name="letra">Responder</button>
				</div>
			</div>		
		</div>		
	</div>	
