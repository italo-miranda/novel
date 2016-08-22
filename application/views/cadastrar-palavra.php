<!-- Aqui e a area do conteudo -->
			<div class="col-md-12 col-xs-12 afastado-1pc">
				<div id="conteudo" class="col-md-8 col-xs-12 centered well" >
					<div class="row">
						<div id="cadastro-palavra" class="centered col-md-12 col-xs-12">
							<div class="row">
								<h1>Cadastro de palavra</h1>
							</div>
							<form class="form-inline" role="form">
							  	<div class="row">
								  	<div class="form-group">
								    	<label class="col-md-4 col-xs-4" for="enunciado">Enunciado:</label>
								    	<input class="col-md-8 col-xs-8" type="textArea" class="form-control" id="enunciado" name="enunciado">
								  	</div>
								</div>
							  	<div class="row">
								  	<div class="form-group">
								    	<label class="col-md-4 col-xs-4" for="palavraIncompleta">Palavra incompleta:</label>
								   		<input class="col-md-8 col-xs-8" type="text" class="form-control" id="palavraIncompleta" name="palavraIncompleta">
								  	</div>
								</div>
								<div class="row">
								  	<div class="form-group">
								    	<label class="col-md-4 col-xs-4" for="gabarito">Gabarito:</label>
								   		<input class="col-md-8 col-xs-8" type="text" class="form-control" id="gabarito" name="gabarito">
								  	</div>
								</div>
								<div class="row">
								  	<div class="form-group">
								    	<label class="col-md-4 col-xs-4" for="imagem">Imagem:</label>
								   		<input class="col-md-8 col-xs-8" type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
								  	</div>
								<div class="row">
								<div class="row">
									<button type="submit" class="btn btn-success">Começar</button>
								</div>
								<div id="botao-esqueciSenha">
									<a href="<?php echo base_url('principal/recuperarSenha'); ?>" class="btn btn-link" role="button">Esqueci a senha</a>
								</div>
							</form>						
						</div>
					</div>
				</div>