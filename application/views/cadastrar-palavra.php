﻿<!-- Aqui e a area do conteudo -->
			<div class="col-md-12 col-xs-12 afastado-1pc">
				<div id="conteudo" class="col-md-8 col-xs-12 centered" >
					<div class="row">
						<div id="painel-login" class="col-md-12 col-xs-12">
							<div class="row">
								<h1 class="titulo-menu centered">Cadastro de palavra</h1>
							</div>							
							<form class="form-horizontal" role="form">
							  	<div class="row">
							  		<div class="form-group centered">
							  			<div class="col-md-4 col-xs-4">
							  				<label for="enunciado">Enunciado:</label>
							  			</div>
								    	<div class="col-md-8 col-xs-8">
								    		<textarea  style="width:100%" required="" maxlength= class="form-control" id="enunciado" name="enunciado"></textarea>
								    	</div>								    
							  		</div>
							  	</div>
							  	<div class="row">
								  	<div class="form-group centered">
								  		<div class="col-md-4 col-xs-4">
									    	<label for="palavraIncompleta">Palavra incompleta:</label>
									    </div>
									    <div class="col-md-8 col-xs-8">
								   			<input type="text" class="form-control" required="" size="40" id="palavraIncorreta" name="palavraIncompleta">
								   		</div>
								  	</div>
							  	</div>
							  	<div class="row">
								  	<div class="form-group centered">
								  		<div class="col-md-4 col-xs-4">
								    		<label for="gabarito">Gabarito:</label>
								    	</div>
								   		<div class="col-md-8 col-xs-8">
								   			<input type="text" class="form-control" required=""  size="40" id="gabarito" name="gabarito">
								   		</div>
								  	</div>
							  	</div>
							  	<div class="row">
								  	<div class="form-group centered">
								  		<div class="col-md-4 col-xs-4">
								    		<label for="imagem">Imagem:</label>
								    	</div>
								   		<div class="col-md-8 col-xs-8">
								   			<input type="file" class="form-control" required="" accept="image/*" id="imagem" name="imagem">
								   		</div>
								  	</div>
							  	</div>
							  	<div class="row">
								  	<div class="form-group centered">
								  		<div class="col-md-4 col-xs-4">
								    		<label for="grafema">Selecione o grafema:</label>
								    	</div>
								   		<div class="col-md-8 col-xs-8">
								   			<select name="grafema" id="grafema" class="form-control">
												<option value="<?php echo('$grafema');?>"><?php echo('$grafema');?></option>
												<option value="<?php echo('$grafema');?>"><?php echo('$grafema');?></option>
												<option value="<?php echo('$grafema');?>"><?php echo('$grafema');?></option>
												<option value="<?php echo('$grafema');?>"><?php echo('$grafema');?></option>
											</select>
								   		</div>
								  	</div>
							  	</div>
								<div class="row centered">
									<button type="submit" class="btn btn-success">Cadastrar</button>
								</div>
							</form>																				
						</div>
					</div>
				</div>