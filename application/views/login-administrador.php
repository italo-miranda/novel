<!-- Aqui e a area do conteudo -->
			<div class="col-md-12 col-xs-12 afastado-1pc">
				<div id="conteudo" class="col-md-6 col-xs-8 centered well" >
					<div class="row">
						<div id="cadastro-palavra" class="centered col-md-12 col-xs-12">
							<h1>Cadastro de palavra</h1>
							<form class="form-inline" role="form">
							  	<div class="form-group">
							    	<label for="enunciado">Enunciado:</label>
							    	<input type="textArea" class="form-control" id="enunciado" name="enunciado">
							  	</div>
							  	<div class="form-group">
							    	<label for="palavraIncompleta">Palavra incompleta:</label>
							   		<input type="text" class="form-control" id="palavraIncompleta" name="palavraIncompleta">
							  	</div>
							  	<div class="form-group">
							    	<label for="gabarito">Gabarito:</label>
							   		<input type="text" class="form-control" id="gabarito" name="gabarito">
							  	</div>
							  	<div class="form-group">
							    	<label for="imagem">Imagem:</label>
							   		<input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
							  	</div>
								<div>
									<button type="submit" class="btn btn-success">Começar</button>
								</div>
								<div id="botao-esqueciSenha">
									<a href="<?php echo base_url('administracao/recuperarSenha'); ?>" class="btn btn-link" role="button">Esqueci a senha</a>
								</div>
							</form>						
						</div>
					</div>
				</div>