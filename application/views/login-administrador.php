<!-- Aqui e a area do conteudo -->
			<div class="col-md-12 col-xs-12 afastado-1pc">
				<div id="conteudo" class="col-md-4 col-xs-8 centered well" >
					<div class="row">
						<div id="painel-login" class="centered col-md-12 col-xs-12">
							<h1>Login do administrador</h1>
							<form class="form-inline" role="form">
							  	<div class="form-group">
							    	<label for="login">Login:</label>
							    	<input type="text" class="form-control" id="login">
							  	</div>
							  	<div class="form-group">
							    	<label for="pwd">Senha:</label>
							   		<input type="password" class="form-control" id="senha">
							  	</div>
								<div>
									<button type="submit" class="btn btn-success">Entrar</button>
								</div>
								<div id="botao-esqueciSenha">
									<a href="<?php echo base_url('administracao/recuperarSenha'); ?>" class="btn btn-link" role="button">Esqueci a senha</a>
								</div>
							</form>						
						</div>
					</div>
				</div>